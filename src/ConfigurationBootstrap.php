<?php namespace Monolith\Configuration;

final class ConfigurationBootstrap implements \Monolith\ComponentBootstrapping\ComponentBootstrap
{
    /** @var string */
    private $envFilePath;
    /** @var null */
    private $environmentName;

    public function __construct($envFilePath = '.', $environmentName = null)
    {
        $this->envFilePath = $envFilePath;
        $this->environmentName = $environmentName;
    }

    public function bind(\Monolith\DependencyInjection\Container $container): void
    {
        $filename = '.env' . (is_null($this->environmentName) ? '' : '.' . $this->environmentName);
        $dotenv = new \Dotenv\Dotenv($this->envFilePath, $filename);
        $dotenv->load();
    }

    public function init(\Monolith\DependencyInjection\Container $container): void
    {
    }
}
