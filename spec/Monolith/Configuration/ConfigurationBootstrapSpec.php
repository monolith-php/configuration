<?php namespace spec\Monolith\Configuration;

use Monolith\DependencyInjection\Container;
use PhpSpec\ObjectBehavior;

class ConfigurationBootstrapSpec extends ObjectBehavior
{
    function it_can_load_environment_variables()
    {
        $this->beConstructedWith('./spec');
        $this->bind(new Container);

        expect(getenv('EXAMPLE_VARIABLE'))->shouldBe('123');
    }

    function it_can_load_alternate_environment_configurations()
    {
        $this->beConstructedWith('./spec', 'testing');
        $this->bind(new Container);

        expect(getenv('TESTING_STRING'))->shouldBe('hi');
    }
}