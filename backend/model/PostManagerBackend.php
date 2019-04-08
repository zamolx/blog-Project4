<?php
require_once('Manager.php');
require_once('Post.php');
require_once('CommentManagerBackend.php');

class PostManagerBackend extends Manager
{

    public function getPostsBackend()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, post, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, DATE_FORMAT(date_modify, \'%d/%m/%Y à %Hh%imin%ss\') AS date_modify_fr FROM posts ORDER BY date_creation DESC ' ;
        $req = $db->query($sql);
        $posts = array();
        while ($post = $req->fetch())
            $posts[] = new Post($post);
        $req->closeCursor();
        return $posts;  
    }

    public function getPostBackend($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, post, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, DATE_FORMAT(date_modify, \'%d/%m/%Y à %Hh%imin%ss\') AS date_modify_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return new Post($post);
    }

    public function createPost($newTitle,$newPost)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title,post,date_creation) VALUES(?,?,NOW())');
        $affectedLines = $req->execute(array($newTitle,$newPost));
        return $affectedLines;
    }

    public function deletePost($post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($post->id));  
    }

    public function deleteComments($post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id_post = ?');
        $req->execute(array($post->id));
    }

    public function updatePost($postId,$newTitle,$newPost)
    {
        $db =$this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title=?, post=?, date_modify=NOW() WHERE id= ?');
        $affectedLines=$req->execute(array($newTitle,$newPost,$postId));
        return $affectedLines;
    }
}
