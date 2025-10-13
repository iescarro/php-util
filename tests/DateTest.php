<?php

use PHPUnit\Framework\TestCase;
use Util\Date;

class DateTest extends TestCase
{
    public function testToStringReturnsFormattedDateTime()
    {
        $date = new Date('2025-01-01 00:00:00');
        $this->assertEquals('2025-01-01 00:00:00', (string) $date);
    }

    public function testToHumanShowsAgoForPastDates()
    {
        $yesterday = (new Date('yesterday'))->toHuman();
        $this->assertStringContainsString('ago', $yesterday);
    }

    public function testToHumanShowsInForFutureDates()
    {
        $tomorrow = (new Date('tomorrow'))->toHuman();
        $this->assertStringContainsString('in ', $tomorrow);
    }

    public function testYearsFromNow()
    {
        $date = new Date('2020-01-01 00:00:00');
        $expected = date('Y-m-d H:i:s', strtotime('+3 years', strtotime('2020-01-01 00:00:00')));
        $this->assertEquals($expected, $date->years_from_now(3));
    }

    public function testYearsAgo()
    {
        $date = new Date('2020-01-01 00:00:00');
        $expected = date('Y-m-d H:i:s', strtotime('-3 years', strtotime('2020-01-01 00:00:00')));
        $this->assertEquals($expected, $date->years_ago(3));
    }

    public function testDaysFromNow()
    {
        $date = new Date('2025-01-01 00:00:00');
        $expected = date('Y-m-d H:i:s', strtotime('+5 days', strtotime('2025-01-01 00:00:00')));
        $this->assertEquals($expected, $date->days_from_now(5));
    }

    public function testDaysAgo()
    {
        $date = new Date('2025-01-01 00:00:00');
        $expected = date('Y-m-d H:i:s', strtotime('-5 days', strtotime('2025-01-01 00:00:00')));
        $this->assertEquals($expected, $date->days_ago(5));
    }

    public function testChainedFromNow()
    {
        $now = new Date('2025-01-01 00:00:00');
        $result = $now->days(2)->from_now();
        $expected = date('Y-m-d H:i:s', strtotime('+2 days', strtotime('2025-01-01 00:00:00')));
        $this->assertEquals($expected, (string) $result);
    }

    public function testChainedAgo()
    {
        $now = new Date('2025-01-10 00:00:00');
        $result = $now->days(2)->ago();
        $expected = date('Y-m-d H:i:s', strtotime('-2 days', strtotime('2025-01-10 00:00:00')));
        $this->assertEquals($expected, (string) $result);
    }

    public function testStaticNowReturnsDateInstance()
    {
        $now = Date::now();
        $this->assertInstanceOf(Date::class, $now);
    }

    public function testStaticTomorrow()
    {
        $tomorrow = Date::tomorrow();
        $this->assertInstanceOf(Date::class, $tomorrow);
        $this->assertGreaterThan(time(), strtotime((string) $tomorrow));
    }

    public function testStaticYesterday()
    {
        $yesterday = Date::yesterday();
        $this->assertInstanceOf(Date::class, $yesterday);
        $this->assertLessThan(time(), strtotime((string) $yesterday));
    }
}
