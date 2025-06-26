<?php

namespace App\Controllers;

class PostController
{

    protected string $tplDir = 'app/view';


    public function __construct(protected string $layout = 'layout/layout-tpl.php', protected string $content = '') {}

    public function display()
    {
        require $this->layout;
    }

    public function show(int $postId)
    {
        /*$message = 'This is my first post';
        ob_start();
        require $this->tplDir . '/post-tpl.php';
        $this->content = ob_get_contents();
        ob_end_clean();*/
    }
}
