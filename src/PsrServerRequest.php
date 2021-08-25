<?php
declare(strict_types=1);

namespace PayNL\Http\Psr\ServerRequest;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ServerRequestInterface;

final class PsrServerRequest
{
    /**
     * @return ServerRequestInterface
     */
    public static function create(): ServerRequestInterface
    {
        $psr17Factory = new Psr17Factory();
        $serverRequestCreator = new ServerRequestCreator(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $request = $serverRequestCreator->fromGlobals();

        # This is to mitigate a bug where the Host header is set twice by the ServerRequestCreator.
        # When the bug is resolved, this code is obsolete.
        # @see https://github.com/Nyholm/psr7-server/issues/48
        # @see https://github.com/Nyholm/psr7-server/pull/49
        if ($request->hasHeader('Host')) {
            $request = $request->withHeader('Host', $request->getHeader('Host')[0]);
        }

        return $request;
    }
}
