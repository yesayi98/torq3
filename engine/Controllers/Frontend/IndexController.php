<?php


namespace Torq\Controllers\Frontend;


use Torq\Core\Components\Controller;
use Torq\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function index(){
//        $product = Product::find(1);
//        $product->setName('Abranq');
//        $product->setPrice(4000);
//        $product->setDiscountedPrice(4001);
//
//        $product->save();
        $products = Product::where("name", 'in', ['product','Abranq'])->getQuery()->execute();
        $this->view()->assign('products', $products);
    }
}