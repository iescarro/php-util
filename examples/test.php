<?php

require('vendor/autoload.php');

use function Util\print_pre;
use function Util\load_env;
use function Util\e;
use Util\Date;
use Util\Str;

echo Date::now()->minutes(20)->from_now() . "\n";
echo Date::now()->years(20)->from_now() . "\n";
echo Date::now()->years(20)->ago() . "\n";
echo Date::yesterday() . "\n";
echo Date::tomorrow() . "\n";
echo Date::now()->toHuman() . "\n";
echo Date::now()->minutes(2)->ago()->toHuman() . "\n";

echo Str::random() . "\n";
echo Str::contains('Hello World', 'World') ? 'true' : 'false';
echo "\n";
echo Str::guid() . "\n";
echo Str::slug('Hello World! This is a test.') . "\n";

print_pre(array('name' => 'John', 'age' => 30, 'city' => 'New York'));

load_env();
echo getenv('APP_NAME');

echo e('Hello World!') . "\n";
echo e('<script>alert("XSS")</script>') . "\n";
echo e('"double quotes" & \'single quotes\'') . "\n";
echo e(null) . "\n";
echo e('Hello <b>World</b>') . "\n";
