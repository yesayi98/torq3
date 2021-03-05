<?php


namespace Core\App;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Response extends HttpResponse
{
  public static function createResponse(): Response
  {
      return new self(
          'Content',
          Response::HTTP_OK,
          ['content-type' => 'text/html']
      );
  }
}