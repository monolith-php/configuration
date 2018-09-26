<?php namespace spec\Monolith\Configuration;

use Monolith\DependencyInjection\Container;
use PhpSpec\ObjectBehavior;

class ConfigurationBootstrapSpec extends ObjectBehavior
{
    function let() {
        $this->bind(new Container);
    }

    function it_can_load_environment_variables() {
        expect(getenv('EXAMPLE_VARIABLE'))->shouldBe('123');
    }
}