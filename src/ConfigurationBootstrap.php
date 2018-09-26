<?php namespace Monolith\Configuration;

final class ConfigurationBootstrap implements \Monolith\ComponentBootstrapping\ComponentBootstrap
{

    public function bind(\Monolith\DependencyInjection\Container $container): void
    {
        $dotenv = new \Dotenv\Dotenv('.');
        $dotenv->load();
    }

    public function init(\Monolith\DependencyInjection\Container $container): void
    {

    }
}
