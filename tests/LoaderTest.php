<?php namespace tests\Monolith\Configuration;

use PHPUnit\Framework\TestCase;
use Monolith\Configuration\Loader;
use Monolith\Configuration\BadConfigurationDeclaration;

final class LoaderTest extends TestCase
{
    function testCanLoadEnvironmentVariables()
    {
        $dict = Loader::fromFile('tests/.env');
        $this->assertSame($dict->get('DB_DSN'), 'mysql:host=localhost;dbname=development');
    }

    function testThrowsOnDirectionWithoutEqualsSign()
    {
        $this->expectException(BadConfigurationDeclaration::class);
        Loader::fromFile('tests/.env.broken1');
    }

    function testThrowsOnDirectiveWithoutKey()
    {
        $this->expectException(BadConfigurationDeclaration::class);
        Loader::fromFile('tests/.env.broken2');
    }

    function testStripsQuotesFromValues()
    {
        $dict = Loader::fromFile('tests/.env');
        $this->assertSame('root', $dict->get('PERSONAL_DATA_STORE_USERNAME'));
    }

    function testOnlyStripsOneQuoteFromEachSide()
    {
        $dict = Loader::fromFile('tests/.env');
        $this->assertSame('"hi', $dict->get('ONLY_ONE_SIDE'));
    }
}