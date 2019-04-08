<?php
require_once('model/Manager.php');
require_once('Comment.php');

class CommentManager extends Manager
{
    public function getComments($postId, $page1, $split_pages)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, marked FROM comments WHERE id_post = ? ORDER BY comment_date DESC LIMIT ' . $page1 . ',' . $split_pages;
        $req = $db->prepare($sql);
        $req->execute(array($postId));
        $comments = array();
        while ($comment = $req->fetch())
            $comments[] = new Comment($comment);
        $req->closeCursor();

        return $comments;
    }

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, marked FROM comments WHERE id = ?';
        $req = $db->prepare($sql);
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return new Comment($comment);
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(id_post, author, comment, comment_date, marked) VALUES(?, ?, ?, NOW(),1)');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getNumberRows($split_pages, $postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS no FROM comments  WHERE id_post = ' . $postId;
        $req = $db->query($sql);
        $records_pages = $req->fetch();
        $row = $records_pages['no'] / $split_pages;
        $row = ceil($row);

        return $row;
    }

    public function updateComment($marked, $Id)
    {
        $db = $this->dbConnect();
        $sql = 'UPDATE comments SET marked=? WHERE id= ?';
        $req = $db->prepare($sql);
        $affectedLine = $req->execute(array($marked, $Id));

        return $affectedLine;
    }

}