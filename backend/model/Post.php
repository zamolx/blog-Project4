<?php
class Post
{
    public $id;
    public $title;
    public $date_creation;
    public $post;
    public $date_modify;

    public function __construct($sql_data)
    {
        $this->id = $sql_data["id"];
        $this->title = $sql_data["title"];
        $this->date_creation = $sql_data["date_creation_fr"];
        $this->post = $sql_data["post"];
        $this->date_modify = $sql_data["date_modify_fr"];
    }
    
    public function isNew()
    {
        return empty($this->id);
    }
}