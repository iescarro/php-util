<?php

use PHPUnit\Framework\TestCase;
use function Util\e;
use function Util\load_env;
use function Util\print_pre;

class HelpersTest extends TestCase
{
    /** @test */
    public function e_function_escapes_html_special_chars()
    {
        $input = '<script>alert("xss")</script>';
        $escaped = e($input);

        $this->assertSame(
            '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;',
            $escaped
        );
    }

    /** @test */
    public function e_function_handles_null_values()
    {
        $this->assertSame('', e(null));
    }

    /** @test */
    public function load_env_function_loads_env_file()
    {
        // Create a temporary .env file
        $tmpFile = __DIR__ . '/.env.test';
        file_put_contents($tmpFile, "APP_NAME=MyApp\n# Comment line\nDEBUG=true");

        // Ensure the variables aren’t set yet
        putenv('APP_NAME');
        putenv('DEBUG');
        unset($_ENV['APP_NAME'], $_ENV['DEBUG'], $_SERVER['APP_NAME'], $_SERVER['DEBUG']);

        load_env($tmpFile);

        // Verify that variables were loaded
        $this->assertSame('MyApp', getenv('APP_NAME'));
        $this->assertSame('true', getenv('DEBUG'));
        $this->assertSame('MyApp', $_ENV['APP_NAME']);
        $this->assertSame('true', $_SERVER['DEBUG']);

        unlink($tmpFile);
    }

    /** @test */
    public function load_env_function_skips_missing_file()
    {
        $this->expectNotToPerformAssertions();
        load_env(__DIR__ . '/nonexistent.env');
    }

    /** @test */
    public function print_pre_function_outputs_preformatted_text()
    {
        ob_start();
        print_pre(['foo' => 'bar']);
        $output = ob_get_clean();

        $this->assertStringContainsString('<pre>', $output);
        $this->assertStringContainsString('</pre>', $output);
        $this->assertStringContainsString('foo', $output);
        $this->assertStringContainsString('bar', $output);
    }
}
