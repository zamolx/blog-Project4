<?php
function getPosts()
{
    $bd = dbConnect();
    $answer = $bd->query('SELECT DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, id,title,post FROM posts ORDER BY date_creation_fr DESC');

    return $answer;
}

function getPost($postId)
{
    $bd = dbConnect();
    $answer = $bd->prepare('SELECT DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, id,title,post FROM posts WHERE id = ?');
    $answer->execute(array($postId));
    $post = $answer->fetch();

    return $post;
}

function getComments($postId)
{
    $bd = dbConnect();
    $comments = $bd->prepare('SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id_post = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments(id_post,author,comment,comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
}