<?php

namespace Bankin\Model;

abstract class Resources implements \Countable, \ArrayAccess
{
    /**
     * @var array
     */
    protected $resources;

    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * Resources constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['pagination'])) {
            $this->pagination = new Pagination($data['pagination']);
        }
    }

    /**
     * @return Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->resources);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->resources);
    }

    /**
     * @return int|string|null
     */
    public function key()
    {
        return key($this->resources);
    }

    public function count()
    {
        return \count($this->resources);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->resources;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return $this->resources;
    }

    public function get($key)
    {
        return $this->resources[$key] ?? null;
    }

    public function offsetSet($offset, $value) : void
    {
        if ($offset === null) {
            $this->add($value);
            return;
        }

        $this->set($offset, $value);
    }

    public function offsetUnset($offset) : void
    {
        $this->remove($offset);
    }

    public function remove($key)
    {
        if (! isset($this->resources[$key]) && ! array_key_exists($key, $this->resources)) {
            return null;
        }
        $removed = $this->resources[$key];
        unset($this->resources[$key]);
        return $removed;
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetExists($offset) : bool
    {
        return $this->containsKey($offset);
    }

    public function containsKey($key) : bool
    {
        return isset($this->resources[$key]) || array_key_exists($key, $this->resources);
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return get_class($this);
    }
}