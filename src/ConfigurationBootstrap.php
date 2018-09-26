<?php namespace Monolith\Configuration;

final class ConfigurationBootstrap implements \Monolith\ComponentBootstrapping\ComponentBootstrap
{

    /** @var string */
    private $envFilePath;

    public function __construct($envFilePath = '.')
    {
        $this->envFilePath = $envFilePath;
    }

    public function bind(\Monolith\DependencyInjection\Container $container): void
    {
        $dotenv = new \Dotenv\Dotenv($this->envFilePath);
        $dotenv->load();
    }

    public function init(\Monolith\DependencyInjection\Container $container): void
    {

    }
}
