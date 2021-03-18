<?php


namespace Torq\Controllers\Frontend;


use Torq\Core\Components\Controller;
use Torq\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function index(){
        $entityManager = Container()->get('db')->getManager();
        $product = new Product();
        $product->setName('product');

        $product->save();

        dd($product);
        $this->view(['gago' => '123']);
    }
}