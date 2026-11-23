#!/usr/bin/env sh
# Applies the edge-cache rule described in DEPLOY.md.
#
# Requires a token with Zone -> Cache Rules -> Edit, scoped to this zone:
#   CLOUDFLARE_API_TOKEN=... CLOUDFLARE_ZONE_ID=... scripts/cache-rule.sh
#
# Writes the http_request_cache_settings entrypoint ruleset, which holds every
# cache rule for the zone, so it refuses to run when it would clobber rules it
# does not manage.
set -eu

: "${CLOUDFLARE_API_TOKEN:?CLOUDFLARE_API_TOKEN is not set}"
: "${CLOUDFLARE_ZONE_ID:?CLOUDFLARE_ZONE_ID is not set}"

HOST="${BLOG_HOST:-blog.albo.ar}"
API="https://api.cloudflare.com/client/v4/zones/$CLOUDFLARE_ZONE_ID/rulesets/phases/http_request_cache_settings/entrypoint"

payload=$(cat <<JSON
{"rules":[{
  "action":"set_cache_settings",
  "description":"Cache pages",
  "expression":"(http.host eq \"$HOST\" and not http.request.uri.path in {\"/\" \"/index.html\" \"/rss.xml\" \"/sitemap.xml\"})",
  "action_parameters":{
    "cache":true,
    "edge_ttl":{"mode":"override_origin","default":86400},
    "browser_ttl":{"mode":"respect_origin"}
  }
}]}
JSON
)

existing=$(curl -s "$API" -H "Authorization: Bearer $CLOUDFLARE_API_TOKEN" || true)
if ! printf '%s' "$existing" | python3 -c '
import json, sys

try:
    body = json.load(sys.stdin)
except ValueError:
    sys.exit(0)  # no ruleset yet

rules = (body.get("result") or {}).get("rules") or []
foreign = [r for r in rules if r.get("description") != "Cache pages"]
for rule in foreign:
    print("  unmanaged rule:", rule.get("description") or rule.get("id"), file=sys.stderr)
sys.exit(1 if foreign else 0)
'; then
    echo "Refusing to overwrite cache rules this script does not manage." >&2
    exit 1
fi

response=$(curl -sS -X PUT "$API" \
    -H "Authorization: Bearer $CLOUDFLARE_API_TOKEN" \
    -H 'Content-Type: application/json' \
    --data "$payload")

printf '%s' "$response" | python3 -c '
import json, sys
body = json.load(sys.stdin)
for error in body.get("errors") or []:
    print("error:", error.get("code"), error.get("message"), file=sys.stderr)
sys.exit(0 if body.get("success") else 1)
' || exit 1

echo "Cache rule applied to $HOST."
