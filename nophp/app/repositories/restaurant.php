<?php

namespace SessionsRepo;
require_once("app/repositories/repo.php");

class Restaurants extends Repository {
    
    function getAll()
    {
        
        $sql = "SELECT * FROM restaurant";
        $restaurants = sql_query($this->conn, $sql);

        return $restaurants;
    }
    
    function getByID($id) 
    {
        $sql = "SELECT * FROM restaurant WHERE id=?";
        $restaurants = sql_query_sane($this->conn, $sql, [$id]);

        return $restaurants[0];
    }
    
    function createRestaurant($name, $price, $starsAmount, $header, $description, $pageid, $amountOfSeats)
    {
        $sql = "INSERT INTO restaurant (name, price, starsAmount, header, description, pageid, amountOfSeats) VALUES (?, ?, ?, ?, ?, ?, ?)";
        return sql_commit_sane($this->conn, $sql, [$name, $price, $starsAmount, $header, $description, $pageid, $amountOfSeats]);
    }
    
    function updateRestaurant($name, $price, $starsAmount, $header, $description, $pageid, $amountOfSeats, $id)
    {
        $sql = "UPDATE restaurant SET name = ? , price = ? , starsAmount = ? , header = ? , description = ? , pageid = ? , amountOfSeats = ? WHERE id = ?";
        return sql_commit_sane($this->conn, $sql, [$name, $price, $starsAmount, $header, $description, $pageid, $amountOfSeats, $id]);
    }

    function deleteRestaurant($id)
    {
        $sql = "DELETE FROM restaurant WHERE id = ?";
        return sql_commit_sane($this->conn, $sql, [$id]);
    }
}

