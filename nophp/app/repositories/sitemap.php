<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
namespace SiteMapRepo;
require_once("app/repositories/repo.php");

class SiteMapRepo extends Repository {

    function getOne($route)
    {
        $sql = "SELECT * FROM sitemap WHERE route=?";
        $pages = sql_query_sane($this->conn, $sql, [$route]);
        $num = count($pages);

        if ($num == 0) {
            return null;
        } 
        return $pages[0];
    }

    public function newOne($route, $id) {
        $visibility = 'private';
        $sql = "INSERT INTO sitemap (route, pageid, visibility) VALUES (?, ?, ?)";
        // sql_commit_sane (DBSANECOMMIT of DBCOMMON) returns a last_rowid, null (Nil) if failed 
        return sql_commit_sane($this->conn, $sql, [$route, $id, $visibility]);
    }

    public function deleteRoute($route) {
        $sql = "DELETE FROM sitemap WHERE route = ?";
        sql_commit_sane($this->conn, $sql, [$route]);
        // Nothing to return
    }
}

?>