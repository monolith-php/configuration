<?php namespace tests\Monolith\Configuration;

use PHPUnit\Framework\TestCase;
use Monolith\Configuration\Config;
use Monolith\DependencyInjection\Container;
use Monolith\Configuration\ConfigurationBootstrap;
use Monolith\ComponentBootstrapping\ComponentLoader;

final class ConfigurationBootstrapTest extends TestCase
{
    public function testCanResolveConfigThroughBootstrap()
    {
        $components = new ComponentLoader(new Container);
        $components->register(new ConfigurationBootstrap('tests/.env'));
        $container = $components->load();

        /** @var Config $config */
        $config = $container->get(Config::class);

        $this->assertTrue($config->has('WEB_SESSIONS_REDIS_PORT'));
        $this->assertFalse($config->has('CLEARLY_NOT_REAL'));
    }

    public function test_changes_env_file_based_on_environment_variable()
    {
        $originalEnvironment = getenv('ENVIRONMENT');
        
        putenv('ENVIRONMENT=example');
        
        $components = new ComponentLoader(new Container);
        $components->register(new ConfigurationBootstrap('tests/.env'));
        $container = $components->load();

        /** @var Config $config */
        $config = $container->get(Config::class);

        $this->assertTrue($config->has('TESTING_MODE'));
        
        putenv('ENVIRONMENT=' . $originalEnvironment);
    }
}