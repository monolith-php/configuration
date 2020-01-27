<?php namespace tests\Monolith\Configuration;

use PHPUnit\Framework\TestCase;
use Monolith\Configuration\Config;
use Monolith\Collections\Dictionary;
use Monolith\Configuration\ConfigValueNotFound;

final class ConfigTest extends TestCase
{
    function testCanGetValues()
    {
        $config = Config::fromDictionary(
            Dictionary::of(
                [
                    'key' => 'value',
                    'ham' => 123,
                ])
        );

        $this->assertSame('value', $config->get('key'));
        $this->assertSame(123, $config->get('ham'));
    }

    function testCanQueryAvailableOfKey()
    {
        $config = Config::fromDictionary(
            Dictionary::of(
                [
                    'key' => 'value',
                    'ham' => 123,
                ])
        );

        $this->assertTrue($config->has('key'));
        $this->assertFalse($config->has('clams'));
    }

    function testThrowsWhenRetrievingNonexistentValue()
    {
        $this->expectException(ConfigValueNotFound::class);

        $config = Config::fromDictionary(Dictionary::empty());
        $config->get('hams');
    }

    function testCanAccessFieldsWithArrayAccess()
    {
        $config = Config::fromDictionary(
            Dictionary::of(
                [
                    'key' => 'value',
                    'ham' => 123,
                ])
        );

        $this->assertSame('value', $config['key']);
        $this->assertSame(123, $config['ham']);
    }
}