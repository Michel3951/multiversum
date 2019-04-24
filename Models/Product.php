<?php

namespace Models;

use Classes\Request;
use Classes\DatabaseHandler;

class Product extends Model
{
    protected $table = 'products';

    public function __construct()
    {
        $this->con = new DatabaseHandler();
        $this->request = new Request();
    }

    public function getActiveProducts()
    {
        $result = $this->con->query("SELECT * FROM $this->table WHERE active = ?", [1]);
        return $result;
    }

    public function getSaleProducts($limit = null)
    {
        $sql = "SELECT * FROM $this->table WHERE sale = ? AND active = 1";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $result = $this->con->query($sql, [1]);
        return $result;
    }

    public function getDetails($id)
    {
        $result = $this->con->query("SELECT * FROM `product_details` WHERE id = ?", [$id])[0];
        return $result;
    }

    public function getProduct($id = false)
    {
        if (!$id) {
            $this->request->respondWithStatusCode(400, 'Missing ID');
        }
        $result = $this->con->query("SELECT * FROM $this->table WHERE sale = ? AND active = 1", [1]);
        return $result;
    }
}