<?php namespace Monolith\Configuration;

final class ConfigurationBootstrap implements \Monolith\ComponentBootstrapping\ComponentBootstrap
{
    /** @var string */
    private $envFilePath;
    private $environmentName;

    public function __construct($envFilePath = '.', $environmentName = false)
    {
        $this->envFilePath = $envFilePath;
        $this->environmentName = $environmentName;
    }

    public function bind(\Monolith\DependencyInjection\Container $container): void
    {
        $filename = '.env' . (!$this->environmentName ? '' : '.' . $this->environmentName);
        $dotenv = new \Dotenv\Dotenv($this->envFilePath, $filename);
        $dotenv->load();
    }

    public function init(\Monolith\DependencyInjection\Container $container): void
    {
    }
}
