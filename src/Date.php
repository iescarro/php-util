<?php

/**
 * Util\Date
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
 * @package    Util\Date
 * @author     Ian Escarro <ian.escarro@gmail.com>
 * @copyright  Copyright (c) 2025, Ian Escarro
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/iescarro/php-util
 * @since      Version 1.0.0
 */

namespace Util;

class Date
{
    const DEFAULT_DATETIME_FORMAT = 'Y-m-d H:i:s';
    const DEFAULT_DATE_FORMAT = 'Y-m-d';

    var $date;
    var $time;

    function __construct($date)
    {
        $this->date = $date;
    }

    function __toString()
    {
        return date(self::DEFAULT_DATETIME_FORMAT, strtotime($this->date));
    }

    function toHuman()
    {
        $now = new \DateTime();
        $datetime = new \DateTime($this->date);
        $diff = $now->diff($datetime);

        // Determine past or future
        $isPast = $datetime < $now;
        $prefix = $isPast ? '' : 'in ';
        $suffix = $isPast ? ' ago' : '';

        // Build the human string
        if ($diff->y > 0) return $prefix . $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . $suffix;
        if ($diff->m > 0) return $prefix . $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . $suffix;
        if ($diff->d > 0) return $prefix . $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . $suffix;
        if ($diff->h > 0) return $prefix . $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . $suffix;
        if ($diff->i > 0) return $prefix . $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . $suffix;
        if ($diff->s > 0) return $prefix . $diff->s . ' second' . ($diff->s > 1 ? 's' : '') . $suffix;

        return 'just now';
    }

    static function tomorrow($format = self::DEFAULT_DATETIME_FORMAT)
    {
        return self::now($format)->days(1)->from_now();
    }

    static function yesterday($format = self::DEFAULT_DATETIME_FORMAT)
    {
        return self::now($format)->days(1)->ago();
    }

    static function now($format = self::DEFAULT_DATETIME_FORMAT)
    {
        $date = new Date(date($format));
        return $date;
    }

    function years_from_now($years, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("+$years years", strtotime($this->date)));
    }

    function years_ago($years, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("-$years years", strtotime($this->date)));
    }

    function months_from_now($months, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("+$months months", strtotime($this->date)));
    }

    function months_ago($months, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("-$months months", strtotime($this->date)));
    }

    function days_from_now($days, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("+$days days", strtotime($this->date)));
    }

    function days_ago($days, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("-$days days", strtotime($this->date)));
    }

    function hours_from_now($hours, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("+$hours hours", strtotime($this->date)));
    }

    function hours_ago($hours, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("-$hours hours", strtotime($this->date)));
    }

    function minutes_from_now($minutes, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("+$minutes minutes", strtotime($this->date)));
    }

    function minutes_ago($minutes, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("-$minutes minutes", strtotime($this->date)));
    }

    function seconds_from_now($seconds, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("+$seconds seconds", strtotime($this->date)));
    }

    function seconds_ago($seconds, $format = self::DEFAULT_DATETIME_FORMAT)
    {
        return date($format, strtotime("-$seconds seconds", strtotime($this->date)));
    }

    // Experimental, more expressive such as years(3)->from_now() function!
    function years($years)
    {
        $this->time = "$years years";
        return $this;
    }

    function months($months)
    {
        $this->time = "$months months";
        return $this;
    }

    function days($days)
    {
        $this->time = "$days days";
        return $this;
    }

    function hours($hours)
    {
        $this->time = "$hours hours";
        return $this;
    }

    function minutes($minutes)
    {
        $this->time = "$minutes minutes";
        return $this;
    }

    function seconds($seconds)
    {
        $this->time = "$seconds seconds";
        return $this;
    }

    function from_now($format = self::DEFAULT_DATETIME_FORMAT)
    {
        $this->date = date($format, strtotime("+{$this->time}", strtotime($this->date)));
        return $this;
    }

    function ago($format = self::DEFAULT_DATETIME_FORMAT)
    {
        $this->date = date($format, strtotime("-{$this->time}", strtotime($this->date)));
        return $this;
    }
}
