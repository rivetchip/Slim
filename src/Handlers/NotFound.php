<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/codeguy/Slim
 * @copyright Copyright (c) 2011-2015 Josh Lockhart
 * @license   https://github.com/codeguy/Slim/blob/master/LICENSE (MIT License)
 */

namespace Slim\Handlers;

use Slim\Handlers\Interfaces\HandlerInterface;
use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

/**
 * Default not found handler
 *
 * This is the default Slim application not found handler. All it does is output
 * a clean and simple HTML page with diagnostic information.
 */
class NotFound implements HandlerInterface
{

    /**
     * Invoke not found handler
     *
     * @param  RequestInterface  $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke( Request $request, Response $response )
    {
        $output = sprintf(
            '<html>
                <head>
                    <title>Page Not Found</title>
                    <style>
                        body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}
                        h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}
                        strong{display:inline-block;width:65px;}
                    </style>
                </head>
                <body>
                    <h1>Page Not Found</h1>
                    <p>
                        The page you are looking for could not be found. Check the address bar
                        to ensure your URL is spelled correctly. If all else fails, you can
                        visit our home page at the link below.
                    </p>
                    <a href="%s">Visit the Home Page</a>
                </body>
            </html>',
            $request->getRootUri()
        );

        return $response->status(404)
                        ->header('Content-Type', 'text/html')
                        ->write($output);
    }


}