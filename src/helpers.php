<?php

/**
 * Util\helpers
 *
 * A simple utility class for handling date and time in PHP.
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2024, Ian Escarro
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    Util\helpers
 * @author     Ian Escarro <ian.escarro@gmail.com>
 * @copyright  Copyright (c) 2025, Ian Escarro
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/iescarro/php-util
 * @since      Version 1.0.0
 */

namespace Util;

if (! function_exists('e')) {
    function e($value, $doubleEncode = true)
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8', $doubleEncode);
    }
}

if (!function_exists('load_env')) {
    function load_env($file_path = '.env')
    {
        $env_file = $file_path;
        if (!file_exists($env_file)) {
            return;
        }

        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Split key and value
            list($key, $value) = explode('=', $line, 2);

            // Remove any quotes around the value
            $value = trim($value, '"\' ');

            // Set environment variable if not already set
            if (!isset($_ENV[$key]) && !isset($_SERVER[$key])) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}

if (!function_exists('print_pre')) {
    function print_pre($obj)
    {
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    }
}
