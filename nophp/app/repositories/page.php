<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
namespace PagesRepo;
require_once("app/repositories/repo.php");

class PagesRepo extends Repository {
    // Get all with a given author
    function getAll($id)
    {
            $sql = "SELECT * FROM pages WHERE author=?";
            $pages = sql_query_sane($this->conn, $sql, [$id]);

            return $pages;
    }

    function getAllPublic($id)
    {
            $sql = "SELECT * FROM pages WHERE author=? AND visibility='public'";
            $pages = sql_query_sane($this->conn, $sql, [$id]);

            return $pages;
    }

    function getAllPublicLatest()
    {
            $sql = "SELECT * FROM pages WHERE visibility='public' ORDER BY created_date DESC LIMIT 10;";
            $pages = sql_query($this->conn, $sql);

            return $pages;
    }


    function getOne($id)
    {
            $sql = "SELECT * FROM pages WHERE pageid=?";
            $pages = sql_query_sane($this->conn, $sql, [$id]);
            $num = count($pages);

            if ($num == 0) {
                return null;
            } 
            return $pages[0];
    }

    function saveOne($id, $userid, $title, $content)
    {
            $sql = "UPDATE pages SET title=?, content=? WHERE pageid=? AND author=?;";
            $pages = sql_commit_sane($this->conn, $sql, [$title, $content, $id, $userid]);
    }

    function changevisOne($id, $userid) 
    {
            $sql = `UPDATE pages 
            SET visibility = CASE WHEN visibility = 'public' THEN 'private' 
            ELSE 'public' END 
            WHERE pageid=? AND author=?;`;
            $pages = sql_commit_sane($this->conn, $sql, [$id, $userid]);
    }

    // Public
    function getOnePublic($id) 
    {
        $sql = "SELECT * FROM pages WHERE pageid=? AND visibility='public'";
        $pages = sql_query_sane($this->conn, $sql, [$id]);
        $num = count($pages);

        if ($num == 0) {
                return null;
        } 

        return $pages[0];

    }

    public function newOne($userid) {
        $title = 'Untitled Document';
        $content = 'This is the beginning of your wonderful page.';
        $visibility = 'private';
        $sql = "INSERT INTO pages (author, title, content, visibility) VALUES (?, ?, ?, ?)";
        // sql_commit_sane (DBSANECOMMIT of DBCOMMON) returns a last_rowid, null (Nil) if failed 
        return sql_commit_sane($this->conn, $sql, [$userid, $title, $content, $visibility]);
    }

    public function deletePage($id, $userid) {
        $sql = "DELETE FROM pages WHERE pageid = ? AND author = ?;";
        sql_commit_sane($this->conn, $sql, [$id, $userid]);
        // Nothing to return
    }
}

?>