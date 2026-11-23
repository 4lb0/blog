# Deploy

Every push to `main` runs `.github/workflows/build.yml`: it installs the
dependencies, runs `php build.php` and publishes `public/` to the
`static-pages` branch. GitHub Pages serves that branch at `blog.albo.ar`,
behind Cloudflare.

There is no test suite; `php build.php` exiting 0 is the check.

## Cloudflare caching

GitHub Pages hardcodes `Cache-Control: max-age=600` on HTML and ignores
`_headers`, so the edge TTL can only be set in Cloudflare.

**Caching → Cache Rules → "Cache pages"**

```
(http.host eq "blog.albo.ar" and not http.request.uri.path in {"/" "/index.html" "/rss.xml" "/sitemap.xml"})
```

Apply it from the dashboard, or re-apply it from a shell (token with
`Zone → Cache Rules → Edit`, scoped to the zone):

```sh
CLOUDFLARE_API_TOKEN=... CLOUDFLARE_ZONE_ID=... scripts/cache-rule.sh
```

| setting            | value                                      |
| ------------------ | ------------------------------------------ |
| Cache eligibility  | Eligible for cache                         |
| Edge TTL           | Ignore cache-control header, use 1 day     |
| Browser TTL        | Use origin cache-control                   |

### Why these exclusions

- `/` and `/index.html` — the page looked at right after publishing.
- `/rss.xml`, `/sitemap.xml` — small, and staleness there is visible to
  subscribers and crawlers.

Everything else (posts, tag pages, `robots.txt`) is cached for at most a day.

### There is no purge

By design. The TTL *is* the freshness budget, so no deploy step can leave the
cache in an unknown state:

| object         | staleness ceiling |
| -------------- | ----------------- |
| `/`            | none, excluded    |
| a new post     | none, never cached |
| an edited post | ≤ 24 h            |
| tag pages      | ≤ 24 h            |

If instant propagation is ever needed, lower the Edge TTL to 1 hour rather
than adding a purge.

### Browser TTL stays short

`Caching → Configuration → Browser Cache TTL` must stay on
`Respect Existing Headers`, so browsers keep GitHub's `max-age=600`.

It must not be raised: a browser copy lives on the visitor's disk and cannot be
invalidated from the server. A week there means someone who read a post on
Monday still sees it uncorrected the following Wednesday, with no way to fix
it for that visitor.

## Verify

```sh
curl -sI https://blog.albo.ar/panaderias-de-codigo.html | grep -iE 'cf-cache-status|age'
```

`cf-cache-status: HIT` with `age` climbing toward `86400`. `/` and `rss.xml`
must stay `DYNAMIC`.
