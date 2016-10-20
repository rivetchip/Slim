<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/slimphp/Slim
 * @copyright Copyright (c) 2011-2015 Josh Lockhart
 * @license   https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */
namespace Slim;

use Slim\Interfaces\CollectionInterface;

use ArrayIterator;

/**
 * Collection
 *
 * This class provides a common interface used by many other
 * classes in a Slim application that manage "collections"
 * of data that must be inspected and/or manipulated
 */
class Collection implements CollectionInterface
{

    /**
     * The source data
     * @var array
     */
    protected $data = [];

    /**
     * Create new collection
     *
     * @param array $items Pre-populate collection with this key-value array
     */
    public function __construct( array $items = [] )
    {
        $this->add($items);
    }


    /********************************************************************************
     * Collection interface
     *******************************************************************************/


    /**
     * Set collection item
     *
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function set( $key, $value )
    {
        $this->data[$key] = $value;
    }

    public function __set($key, $value )
    {
        return $this->set($key, $value);
    }

    /**
     * Get collection item for key
     *
     * @param string $key     The data key
     * @param mixed  $default The default value to return if data key does not exist
     *
     * @return mixed The key's value, or the default value
     */
    public function get( $key, $default = null )
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    public function __get( $key )
    {
        return $this->get($key);
    }

    /**
     * Does this collection have a given key?
     *
     * @param string $key The data key
     *
     * @return bool
     */
    public function has( $key )
    {
        return isset($this->data[$key]);
    }

    public function __isset( $key )
    {
        return $this->has($key);
    }

    /**
     * Add item to collection
     *
     * @param array $items Key-value array of data to append to this collection
     */
    public function add( array $data )
    {
        foreach( $data as $key => $value )
        {
            $this->set($key, $value);
        }
    }

    /**
     * Get all items in collection
     *
     * @return array The collection's source data
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Get collection keys
     *
     * @return array The collection's source data keys
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * Remove item from collection
     *
     * @param string $key The data key
     */
    public function remove( $key )
    {
        unset($this->data[$key]);
    }

    /**
     * Remove all items from collection
     */
    public function clear()
    {
        $this->data = [];
    }


    /********************************************************************************
     * ArrayAccess interface
     *******************************************************************************/


    /**
     * Does this collection have a given key?
     *
     * @param  string $key The data key
     *
     * @return bool
     */
    public function offsetExists( $key )
    {
        return $this->has($key);
    }

    /**
     * Get collection item for key
     *
     * @param string $key The data key
     *
     * @return mixed The key's value, or the default value
     */
    public function offsetGet( $key )
    {
        return $this->get($key);
    }

    /**
     * Set collection item
     *
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function offsetSet( $key, $value )
    {
        $this->set($key, $value);
    }

    /**
     * Remove item from collection
     *
     * @param string $key The data key
     */
    public function offsetUnset( $key )
    {
        $this->remove($key);
    }

    /**
     * Get number of items in collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }


    /********************************************************************************
     * IteratorAggregate interface
     *******************************************************************************/


    /**
     * Get collection iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }


}