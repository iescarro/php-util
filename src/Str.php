<?php

/**
 * Util\Str
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
 * @package    Util\Str
 * @author     Ian Escarro <ian.escarro@gmail.com>
 * @copyright  Copyright (c) 2025, Ian Escarro
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/iescarro/php-util
 * @since      Version 1.0.0
 */

namespace Util;

class Str
{
    public static function random($length_in_bytes = 32)
    {
        return bin2hex(random_bytes($length_in_bytes));
    }

    public static function slug($title, $separator = '-')
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9\s' . preg_quote($separator) . ']/i', '', $slug);

        $slug = preg_replace('/\s+/', $separator, $slug);
        $slug = trim(preg_replace('/' . preg_quote($separator) . '+/', $separator, $slug), $separator);

        return $slug;
    }

    public static function contains($haystack, $needles)
    {
        if (!is_array($needles)) {
            $needles = [$needles];
        }

        foreach ($needles as $needle) {
            if ($needle !== '' && strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    public static function guid()
    {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
