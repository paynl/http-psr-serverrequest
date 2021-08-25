<?php
use PayNL\Http\Psr\ServerRequest\PsrServerRequest;
use Psr\Http\Message\ServerRequestInterface;

if ( ! function_exists('get_psr_request')) {
    function get_psr_request(): ServerRequestInterface
    {
        return PsrServerRequest::create();
    }
}
