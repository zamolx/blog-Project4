<?php
require_once(__DIR__ . '/Manager.php');
require_once(__DIR__ . "/Post.php");

class PostManager extends Manager
{

    public function getPosts($page1, $split_pages)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, post, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, DATE_FORMAT(date_modify, \'%d/%m/%Y à %Hh%imin%ss\') AS date_modify_fr FROM posts ORDER BY date_creation DESC LIMIT ' . $page1 . ',' . $split_pages;
        $req = $db->query($sql);
        $posts = array();
        while ($post = $req->fetch())
            $posts[] = new Post($post);
        $req->closeCursor();

        return $posts;
    }

    public function getNumberRows($split_pages)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS no FROM posts';
        $req = $db->query($sql);
        $records_pages = $req->fetch();
        $row = $records_pages['no'] / $split_pages;
        $row = ceil($row);

        return $row;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, post, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr , DATE_FORMAT(date_modify, \'%d/%m/%Y à %Hh%imin%ss\') AS date_modify_fr  FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return new Post($post);
    }

    public function Array()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM posts ');
        $ids_array = array();
        while ($row = $req->fetch())
            $ids_array[] = $row['id'];

        return $ids_array;
    }

}
