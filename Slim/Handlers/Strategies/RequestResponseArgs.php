<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/codeguy/Slim
 * @copyright Copyright (c) 2011-2015 Josh Lockhart
 * @license   https://github.com/codeguy/Slim/blob/master/LICENSE (MIT License)
 */
namespace Slim\Handlers\Strategies;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

/**
 * Route callback strategy with route parameters as individual arguments.
 */
class RequestResponseArgs implements InvocationStrategyInterface
{

    /**
     * Invoke a route callable with request, response and all route parameters
     * as individual arguments.
     *
     * @param array|callable         $callable
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return mixed
     */
    public function __invoke(callable $callable, ServerRequestInterface $request, ResponseInterface $response)
    {
        $arguments = [$request, $response];
        foreach ($request->getAttribute('routeArguments') as $k => $v) {
            array_push($arguments, $v);
        }
        return call_user_func_array($callable, $arguments);
    }
}
