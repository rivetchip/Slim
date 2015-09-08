<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/codeguy/Slim
 * @copyright Copyright (c) 2011-2015 Josh Lockhart
 * @license   https://github.com/codeguy/Slim/blob/master/LICENSE (MIT License)
 */

namespace Slim\Interfaces;

use ArrayAccess;
use Countable;
use IteratorAggregate;


interface CollectionInterface extends ArrayAccess, Countable, IteratorAggregate
{

    public function has( $key );

    public function get( $key );

    public function set( $key, $value );

    public function remove( $key );


    public function all();

    public function add( array $data );

    public function clear();


}