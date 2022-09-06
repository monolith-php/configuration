<?php namespace Monolith\Configuration;

use ArrayAccess;
use Monolith\Collections\Dictionary;

final class Config implements ArrayAccess
{
    private Dictionary $values;

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

    public function has($key): bool 
    {
        return $this->values->has($key);
    }

    public function all(): Dictionary
    {
        return $this->values;
    }
    
    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return $this->values->has($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->values->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new CanNotModifyConfigObjectWithArrayAccess();
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new CanNotModifyConfigObjectWithArrayAccess();
    }

    public static function fromDictionary(Dictionary $dictionary): Config
    {
        return new Config($dictionary);
    }
}