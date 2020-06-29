<?php namespace Monolith\Configuration;

use Monolith\DependencyInjection\Container;
use Monolith\ComponentBootstrapping\ComponentBootstrap;

final class ConfigurationBootstrap implements ComponentBootstrap
{
    /** @var string */
    private $envFilePath;

    public function __construct($envFilePath = '.')
    {
        $this->envFilePath = $envFilePath;
    }

    public function bind(Container $container): void
    {
        $container->singleton(
            Config::class, function ($container) {
            
            $envFilePath = $this->envFilePath;
            
            if (isset($_ENV['ENVIRONMENT'])) {
                $envFilePath .= '.' . strtolower($_ENV['ENVIRONMENT']);
            }
            
            return Config::fromDictionary(
                Loader::fromFile($envFilePath)
            );
        });
    }

    public function init(Container $container): void
    {
    }
}
