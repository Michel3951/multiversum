<?php

namespace Controllers;

use Classes\DatabaseHandler;
use Models\Product;

class HomeController
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
        $this->product = new Product();
    }

    public function showHomepage($request)
    {
        $products = $this->product->getSaleProducts(3);
        $request->view('views.index', [$products]);
    }

    public function filter($request)
    {
        $products = $this->product->between('price', $request->input('price-start'), $request->input('price-end'));
        $request->view('views.products.index', [$request, $products]);
    }

    public function search($request)
    {
        $value = $request->query('search');
        if (!$value) {
            return $request->respondWithStatusCode(400, 'Missing Search parameter');
        }
        $result = $this->product->like('name', "%$value%");
        $request->view('views.search', [$result]);
    }

    public function viewProduct($request, $sku)
    {
        $product = $this->product->where('sku', $sku, 1)[0];
        $details = $this->product->getDetails($product['id']);
        $request->view('views.products.view', [$product, $details]);
    }

    public function showProducts($request)
    {
        $count = $this->con->count('SELECT * FROM products WHERE active = 1');
        if ($request->query('page')) {
            $current = 6 * intval($request->query('page'));
            $products = $this->con->query("SELECT * FROM products WHERE active = 1 ORDER BY id DESC LIMIT $current, 6");
            $request->view('views.products.index', [$request, $products, $count]);
            return;
        }
        $products = $this->con->query('SELECT * FROM products WHERE active = 1 ORDER BY id DESC LIMIT 6');
        $request->view('views.products.index', [$request, $products, $count]);
    }
}