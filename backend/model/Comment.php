<?php
class Comment
{
    public $id;
    public $id_post;
    public $author;
    public $comment;
    public $comment_date;
    public $marked;

    public function __construct($sql_data)
    {
        $this->id = $sql_data["id"];
        $this->id_post = $sql_data["id_post"];
        $this->author= $sql_data["author"];
        $this->comment = $sql_data["comment"];
        $this->comment_date = $sql_data["comment_date_fr"];
        $this->marked = $sql_data["marked"];
    }

}
    