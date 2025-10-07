<?php

require('vendor/autoload.php');

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
