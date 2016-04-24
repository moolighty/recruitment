<?php
$base = require("/opt/lib/env.php");
$env = _merge($base, [
    'debug' => true,
]);
return $env;
