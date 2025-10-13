<?php

use PHPUnit\Framework\TestCase;
use Util\Str;

class StrTest extends TestCase
{
    /** @test */
    public function it_generates_a_random_hex_string_of_expected_length()
    {
        $random = Str::random(8);
        // 8 bytes = 16 hex characters
        $this->assertMatchesRegularExpression('/^[a-f0-9]{16}$/', $random);
    }

    /** @test */
    public function it_generates_different_random_strings_each_time()
    {
        $r1 = Str::random(8);
        $r2 = Str::random(8);
        $this->assertNotEquals($r1, $r2);
    }

    /** @test */
    public function it_converts_text_to_slug()
    {
        $slug = Str::slug('Hello World!');
        $this->assertEquals('hello-world', $slug);
    }

    /** @test */
    public function it_removes_special_characters_from_slug()
    {
        $slug = Str::slug('Hello @#$% World!');
        $this->assertEquals('hello-world', $slug);
    }

    /** @test */
    public function it_supports_custom_slug_separator()
    {
        $slug = Str::slug('Hello World', '_');
        $this->assertEquals('hello_world', $slug);
    }

    /** @test */
    public function it_detects_if_string_contains_substring()
    {
        $this->assertTrue(Str::contains('The quick brown fox', 'brown'));
    }

    /** @test */
    public function it_detects_if_string_contains_any_from_array()
    {
        $this->assertTrue(Str::contains('Hello there!', ['hi', 'there']));
        $this->assertFalse(Str::contains('Hello there!', ['foo', 'bar']));
    }

    /** @test */
    public function it_returns_false_if_no_match()
    {
        $this->assertFalse(Str::contains('The quick brown fox', 'dog'));
    }

    /** @test */
    public function it_generates_a_valid_guid()
    {
        $guid = Str::guid();

        // Basic UUID v4 pattern: xxxxxxxx-xxxx-4xxx-[89ab]xxx-xxxxxxxxxxxx
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            $guid
        );
    }

    /** @test */
    public function it_generates_unique_guids_each_time()
    {
        $g1 = Str::guid();
        $g2 = Str::guid();
        $this->assertNotEquals($g1, $g2);
    }
}
