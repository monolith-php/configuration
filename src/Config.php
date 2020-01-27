<?php namespace Monolith\Configuration;

use ArrayAccess;
use Monolith\Collections\Dictionary;

final class Config implements ArrayAccess
{
    /** @var Dictionary */
    private $values;

    private function __construct(Dictionary $values)
    {
        $this->values = $values;
    }

    public function get($key)
    {
        if ( ! $this->values->has($key)) {
            throw new ConfigValueNotFound("Can not find config value '{$key}'.");
        }
        return $this->values->get($key);
    }

    public function has($key)
    {
        return $this->values->has($key);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return $this->values->has($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->values->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        throw new CanNotModifyConfigObjectWithArrayAccess();
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        throw new CanNotModifyConfigObjectWithArrayAccess();
    }

    public static function fromDictionary(Dictionary $dictionary): Config
    {
        return new static($dictionary);
    }
}