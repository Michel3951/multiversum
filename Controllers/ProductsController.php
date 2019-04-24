<?php

namespace Controllers;

use Classes\DatabaseHandler;
use Classes\Request;

class ProductsController
{
    public function __construct()
    {
        $request = new Request();
        if (!$request->getRole()) {
            $request->respondWithStatusCode(403, 'U moet ingelogd zijn als admin om deze pagina te bekijken.');
            exit;
        } else if ($request->getRole() < 5) {
            $request->respondWithStatusCode(403, 'U moet admin zijn om deze pagina te bekijken.');
            exit;
        }
        $this->con = new DatabaseHandler();
    }

    public function delete($request)
    {
        if (!$this->query('id')) {
            $request->respondWithStatusCode(400, 'Missing ID');
            return;
        }
        $this->con->query('DELETE FROM products WHERE id = ?', [$request->query('id')]);
    }

    public function showAll($request)
    {
        $count = $this->con->count('SELECT * FROM products');
        if ($request->query('page')) {
            $current = 6 * intval($request->query('page'));
            $products = $this->con->query("SELECT * FROM products LIMIT $current,  6");
            $request->view('views.products.all', [$products, $request, $count]);
            return;
        }
        $products = $this->con->query('SELECT * FROM products LIMIT 6');
        $request->view('views.products.all', [$products, $request, $count]);
    }

    public function showNewProduct($request)
    {
        $request->view('views.products.create');
    }

    public function createNewProduct($request)
    {
        $name = $request->input('name');
        $sku = $request->input('sku');
        $price = $request->input('price');
        $description = $request->input('description') ?? null;
        $stock = $request->input('stock');
        $color = $request->input('color') ?? null;
        $connections = $request->input('connections') ?? null;
        $audio = $request->input('audio') ?? null;
        $platform = $request->input('platform') ?? null;
        $refresh_rate = $request->input('refresh_rate') ?? null;
        $resolution = $request->input('resolution') ?? null;
        $brand = $request->input('brand') ?? null;
        $image = $request->input('photo') ?? null;
        $sale = $request->input('sale');
        $sale_percentage = $request->input('sale-percentage') ?? 0;

        $this->con->create('INSERT INTO products (name, sku, price, description, stock, image, sale, sale_percentage) VALUES (?, ?, ?, ?, ?, ?, ? ,?)', [
            $name,
            $sku,
            $price,
            $description,
            $stock,
            $image,
            $sale,
            $sale_percentage
        ]);

        $id = $this->con->getLatestEntry('products');

        foreach ($id as $i) {
            $id = $i['id'];
        }

        $code = '870' . str_pad(3874, 9, '0');
        $weightflag = true;
        $sum = 0;
        for ($i = strlen($code) - 1; $i >= 0; $i--) {
            $sum += (int)$code[$i] * ($weightflag ? 3 : 1);
            $weightflag = false;
        }
        $code .= (10 - ($sum % 10)) % 10;

        $this->con->create('INSERT INTO product_details (product_id, color, ean, connections, audio, platform, refresh_rate, resolution, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $color,
            $code,
            $connections,
            $audio,
            $platform,
            $refresh_rate,
            $resolution,
            $brand
        ]);
        $request->redirect('/admin/dashboard');
    }

    public function viewProduct($request)
    {
        $product = $this->con->query('SELECT * FROM products WHERE id = ?', [$request->query('id')])[0];
        $details = $this->con->query('SELECT * FROM product_details WHERE product_id = ?', [$request->query('id')])[0] ?? null;
        if (!$product) {
            $request->respondWithStatusCode(404, 'Dit product is niet gevonden.');
            return;
        }
        $request->view('views.products.update', [$product, $details]);
    }

    public function updateProduct($request)
    {
        $id = $request->query('id');
        if (!$id) {
            $request->respondWithStatusCode(400, 'Missing ID parameter.');
            return;
        }
        $name = $request->input('name');
        $sku = $request->input('sku');
        $price = $request->input('price');
        $stock = $request->input('stock');
        $description = $request->input('description');
        $image = $request->input('photo');
        $sale = $request->input('sale');
        $sale_percentage = $request->input('sale-percentage');
        $this->con->create('UPDATE products SET name = ?, sku = ?, price = ?, description = ?, stock = ?, image = ?, sale = ?, sale_percentage = ? WHERE id = ?', [
            $name,
            $sku,
            $price,
            $description,
            $stock,
            $image,
            $sale,
            $sale_percentage,
            $id,
        ]);
        $this->con->create('UPDATE product_details SET color = ?, connections = ?, audio = ?, platform = ?, refresh_rate = ?, resolution = ?, brand = ? WHERE product_id = ?', [
            $request->input('color'),
            $request->input('connections'),
            $request->input('audio'),
            $request->input('platform'),
            $request->input('refresh_rate'),
            $request->input('resolution'),
            $request->input('brand'),
            $id,
        ]);
        $request->redirect('/admin/dashboard');
    }
}