<?php
require_once('Manager.php');
require_once('Comment.php');
class CommentManagerBackend extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, marked FROM comments WHERE id_post = ? ORDER BY marked DESC, comment_date DESC';
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
        $sql ='SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, marked FROM comments WHERE id = ?';
        $req = $db->prepare($sql);
        $req->execute(array($commentId));
        $comment = $req->fetch();
        return new Comment($comment);
    }

    public function deleteComment($comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($comment->id));
    }

    public function updateComment($marked,$Id)
    {
        $db = $this->dbConnect();
        $sql = 'UPDATE comments SET marked=? WHERE id= ?';
        $req = $db ->prepare($sql);
        $affectedLines = $req->execute(array($marked,$Id));
        return $affectedLines;
    }

}