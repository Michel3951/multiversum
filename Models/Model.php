<?php

namespace Models;

use Classes\DatabaseHandler;
use Classes\Request;

class Model
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
        $this->request = new Request();
    }

    public function getAll()
    {
        $result = $this->con->query("SELECT * FROM $this->table");
        return $result;
    }

    public function count()
    {
        $result = $this->con->query("SELECT * FROM $this->table")->rowCount();
        return $result;
    }

    public function where($column, $value, $limit = null)
    {
        $sql = "SELECT * FROM $this->table WHERE $column = ?";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $result = $this->con->query($sql, [$value]);
        return $result;
    }

    public function like ($column, $value, $limit = null)
    {
        $sql = "SELECT * FROM $this->table WHERE $column LIKE ?";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $result = $this->con->query($sql, [$value]);
        return $result;
    }

    public function between ($column, $start, $end, $limit = null)
    {
        $sql = "SELECT * FROM $this->table WHERE $column BETWEEN ? AND ?";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $result = $this->con->query($sql, [$start, $end]);
        return $result;
    }
}