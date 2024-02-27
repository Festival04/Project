<?php
// 02.2024 Artur Z (HUSKI3@GitHub)

class PagesController {

    public function __construct() 
    {
        require_once("app/models/page.php");
        require_once("app/repositories/page.php");
        $this->repo = new PagesRepo();
    }

    public function savepage($id, $userid, $title, $content) {
        $repo->saveOne($id, $userid, $title, $content);
    }

    public function changevispage($id, $userid) {
        $repo->changevisOne($id, $userid);
    }

    public function createpage($userid) {
        $id = $repo->newOne($userid);
        if ($id == null) {
            return null;
        } 
        $_page = $this->getpage($id, $userid);
        return $_page;
    }

    public function getpagePublic($id) {
        $page = $repo->getOnePublic($id);
        if ($page == null) {
            return null;
        } 
        return new page(
            $page[0],
            $page[1],
            $page[2],
            $page[3],
            $page[4],
            $page[5]
        );
    }

    public function getPublicLatest() {
        $Pages = $repo->getAllPublicLatest();
        $PagesObjs = [];

        foreach($Pages as $page) {
            array_push($PagesObjs, // TODO: Implement array_push
            new page(
                $page[0],
                $page[1],
                $page[2],
                $page[3],
                $page[4],
                $page[5]
            ) // TODO: Make sure this constructor works properly
        );
        }

        return $PagesObjs;
    }

    public function getpage($id) {
        $page = $repo->getOne($id);
        if ($page == null) {
            return null;
        } 
        return new Page(
            $page[0],
            $page[1],
            $page[2],
            $page[3],
            $page[4],
            $page[5]
        );
    }
    
    public function deletepage($id, $userid) {
        $repo->deletepage($id, $userid);
    }

    public function getAllPages($id) {
        $Pages = $repo->getAll($id);
        $PagesObjs = [];

        foreach($Pages as $page) {
            array_push($PagesObjs, // TODO: Implement array_push
            new page(
                $page[0],
                $page[1],
                $page[2],
                $page[3],
                $page[4],
                $page[5]
            )
        );
        }

        return $PagesObjs;
    }

    public function getAllPublicPages($id) {
        $Pages = $repo->getAllPublic($id);
        $PagesObjs = [];

        foreach($Pages as $page) {
            array_push($PagesObjs, // TODO: Implement array_push
            new page(
                $page[0],
                $page[1],
                $page[2],
                $page[3],
                $page[4],
                $page[5]
            ) // TODO: Make sure this constructor works properly
        );
        }

        return $PagesObjs;
    }
}

?>