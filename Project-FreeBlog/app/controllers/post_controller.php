<?php

namespace App\Controllers;

use PDO;

class PostController
{
    protected string $tplDir = 'app/view';

    public function __construct(
        protected PDO $conn,
        protected string $layout = 'layout/layout-tpl.php',
        protected string $content = ''
    ) {}

    public function show(int $postId = null)
    {
        if ($postId === null) {
            $query = 'SELECT * FROM posts';
            $stm = $this->conn->query($query, PDO::FETCH_OBJ);
        } else {
            $query = 'SELECT * FROM posts WHERE id = :id';
            $stm = $this->conn->prepare($query);
            $stm->bindParam(':id', $postId, PDO::PARAM_INT);
            $stm->execute();
        }

        $posts = $stm->fetchAll(PDO::FETCH_OBJ);

        ob_start();
        require $this->tplDir . '/post-tpl.php';
        $this->content = ob_get_contents();
        ob_end_clean();
    }

    public function display()
    {
        require $this->layout;
    }
}
