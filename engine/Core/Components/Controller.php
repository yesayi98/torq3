<?php


namespace Torq\Core\Components;


use Torq\Core\App\View;
use Torq\Core\Components\Modules\Widget;
use Torq\Core\Interfaces\Controller as ControllerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Torq\Core\Components\Traits\DocReader;
use Symfony\Component\HttpFoundation\Response;
use Torq\Core\App\Response as AppResponse;

abstract class Controller implements ControllerInterface
{
    use DocReader;

    /**
     * @var Request
     */
    protected $request;

    protected $responseParams;

    protected $view;

    public function __construct()
    {
        $this->view = new View($this);
    }

    public function __invoke(Request $request)
    {
        $this->request = $request;
        $this->{$request->attributes->get('_action')}();

        if ($request->attributes->get('_module') instanceof Widget){
            return $this->generateJsonResponse();
        }

        return $this->generateResponse();
    }

    public function view(){
        return $this->view;
    }

    /**
     * @return Response
     */
    protected function generateResponse(): Response
    {
        return Response::create(new AppResponse($this));
    }

    protected function generateJsonResponse(): JsonResponse
    {
        return JsonResponse::create($this->responseParams);
    }

    /**
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }
}