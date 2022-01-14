<!doctype html>
<html lang="es">
<head>
  <title><?= (isset($title) ? "$title - " : "") . getenv('BLOG_TITLE') ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($description)): ?>
  <meta name="description" content="<?= $description ?>">
<?php endif; ?>
  <link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20100%20100%22%3E%3Ctext%20y=%22.9em%22%20font-size=%2290%22%3E<?= getenv('BLOG_LOGO') ?: BLOG_DEFAULT_LOGO ?>%3C/text%3E%3C/svg%3E">
  <style><?php echo file_get_contents(__DIR__ . '/../public/u.css') ?>article img{display:block;width:100%;max-width:800px; margin:auto}</style>
  <script>
      !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.async=!0,p.src=s.api_host+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],u.toString=function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e},u.people.toString=function(){return u.toString(1)+".people (stub)"},o="capture identify alias people.set people.set_once set_config register register_once unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled onFeatureFlags".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
      posthog.init('phc_2wfqvWVgyogXIhMHYrvb2Lxf9hR2fUgX3YVJyAXokzf',{api_host:'https://app.posthog.com'})
  </script>
</head>
<body>
