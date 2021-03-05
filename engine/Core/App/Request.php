<?php
namespace Core\App;

use Symfony\Component\HttpFoundation\Request as HttpRequest;
class Request extends HttpRequest
{
    /**
     * @return HttpRequest
     */
    public static function createBaseRequest(): HttpRequest
    {
        static::enableHttpMethodParameterOverride();

        return HttpRequest::createFromGlobals();
    }
}