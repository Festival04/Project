<?php

namespace SessionsRepo;
require_once("app/repositories/repo.php");

class Sessions extends Repository {
    
    //since session is a keyword, is it going to affect somehow?
    //CREATE, READ, UPDATE, DELETE
    function getByID($id) 
    {
        $sql = "SELECT * FROM session WHERE id=?";
        $sessions = sql_query_sane($this->conn, $sql, [$id]);

        return $sessions[0];
    }
    
    function getByRestaurant($restaurantID)
    {
        
        $sql = "SELECT * FROM session WHERE id=?";
        $sessions = sql_query_sane($this->conn, $sql, [$restaurantID]);

        return $sessions;
    }

    function createSession($restaurantID, $timeStart, $timeEnd) 
    {
        $sql = "INSERT INTO session (restaurantID, timeStart, timeEnd) VALUES (?, ?, ?)";
        return sql_commit_sane($this->conn, $sql, [$restaurantID, $timeStart, $timeEnd]);
    }
    
    function updateSession($restaurantID, $timeStart, $timeEnd, $id)
    {
        $sql = "UPDATE session SET restaurantID = ? , timeStart = ? , timeEnd = ? WHERE id = ?"; /* changed \'?\' */
        return sql_commit_sane($this->conn, $sql, [$restaurantID, $timeStart, $timeEnd, $id]);
    }

    function deleteSession($id)
    {
        $sql = "DELETE FROM session WHERE id = ?";
        return sql_commit_sane($this->conn, $sql, [$id]);
    }

}

