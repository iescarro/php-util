<?php

require('vendor/autoload.php');

use Util\Date;

echo Date::now()->minutes(20)->from_now() . "\n";
echo Date::now()->years(20)->from_now() . "\n";
echo Date::now()->years(20)->ago() . "\n";
echo Date::yesterday() . "\n";
echo Date::tomorrow() . "\n";
