<?php

namespace Controllers;

use Classes\DatabaseHandler;
use Classes\Request;

class CartController
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
        $this->request = new Request();
    }

    public function checkout ($request)
    {
        $cart = $this->getCartItems();
        $request->view('views.cart.checkout', [$cart]);
    }

    public function show($request)
    {
        $cart = $this->getCartItems();
        $request->view('views.cart.cart', [$cart]);
    }

    public function handle($request)
    {
        if (key_exists('add', $_GET)) {
            $this->addToCart($request->query('add'));
        } else if (key_exists('remove', $_GET)) {
            $this->removeItem($request->query('remove'));
        } else if (key_exists('update', $_GET)) {
            if (!key_exists('amount', $_GET)) return $request->respondWithStatusCode(500, 'Missing Amount');
            $this->updateCart($request->query('update'), $request->query('amount'));
        }
    }

    private function addToCart($id)
    {
        if (!key_exists('cart', $_SESSION)) {
            $_SESSION['cart'] = array();
            $_SESSION['cart']['items'] = array();
        }
        $cart = $_SESSION['cart']['items'];
        $product = $this->con->query('SELECT * FROM products WHERE id = ?', [$id])[0];
        if (key_exists($product['id'], $cart)) {
            $this->updateCart($product['id'], 1);
        } else if ($product['sale']) {
            $_SESSION['cart']['items'][$product['id']] = ['sale_precentage' => $product['sale_percentage'], 'count' => 1];
        } else {
            $_SESSION['cart']['items'][$product['id']] = ['count' => 1];
        }
        $this->request->back();
    }

    private function removeItem($id)
    {
        if (!key_exists($id, $_SESSION['cart']['items'])) return;
        unset($_SESSION['cart']['items'][$id]);
        $this->request->back();
    }

    private function updateCart($id, $amount)
    {
        $item = $_SESSION['cart']['items'][$id];
        if ($item['count'] + $amount < 1 || !$item['count']) return $this->removeItem($id);
        $_SESSION['cart']['items'][$id] = ['count' => intval($item['count']) + $amount];
        $this->request->back();
    }

    private function getCartItems()
    {
        $result = array();
        if (!isset($_SESSION['cart']['items'])) return null;
        foreach ($_SESSION['cart']['items'] as $key => $value) {
            $current = $this->con->query('SELECT * FROM products WHERE id = ?', [$key])[0];
            array_push($result, [$current, 'count' => $_SESSION['cart']['items'][$key]['count']]);
        }
        return $result;
    }
}