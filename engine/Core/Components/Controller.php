<?php


namespace Torq\Core\Components;


use Torq\Core\App\View;
use Torq\Core\Components\Modules\Widget;
use Torq\Core\Components\Traits\Getter;
use Torq\Core\Interfaces\Controller as ControllerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Torq\Core\Components\Traits\DocReader;
use Torq\Core\App\Response;

abstract class Controller implements ControllerInterface
{
    use DocReader, Getter;

    /**
     * @var Request
     */
    protected $request;

    protected $reflect;

    protected $responseParams;

    protected $view;

    public function __invoke(Request $request)
    {
        $this->request = $request;
        $this->reflect = new \ReflectionClass(get_called_class());
        $this->view = new View($this);
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
        $this->view->render();
        $response = new Response($this);
        $response->prepare($this->request);
        return $response;
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