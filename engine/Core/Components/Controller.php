<?php


namespace Core\Components;


use Core\Interfaces\Controller as ControllerInterface;
use Symfony\Component\HttpFoundation\Request;
use Core\Components\Traits\DocReader;

abstract class Controller implements ControllerInterface
{
    use DocReader;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    private $params = [];

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

}