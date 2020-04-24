<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;
/**
 * Posts controller
 *
 * PHP version 7.4.3
 */
class Posts extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        // echo 'Hello from the index action in the Posts controller!';
        $post = new Post;
        $posts = $post->getAll();
        View::renderTemplate('Posts/index.html', [
            'posts'=> $posts
        ]);
    }

    /**
     * Show the add new page
     *
     * @return void
     */
    public function addNewAction()
    {
        echo 'Hello from the addNew action in the Posts controller!';
        $post = new Post;

    }
    
    /**
     * Show the edit page
     *
     * @return void
     */
    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
            $post = new Post;
            $abc = $post->getById(1);
            //do something
    }
}







        // $forth = $post->deleteById(22);
        // $forth = $post->create("posts",
        // [
        //     "title" => "111 post", 
        //     "content" => "This is really really really is doin it", 
        //     "created_at" => "2020-03-21 10:08:91"
        // ]);
        //echo $forth;
        // $forth = $post->update("posts","15",
        // [
        //     "title" => "15nth post", 
        //     "content" => "This is really really really is doin it", 
        //     "created_at" => "2020-03-21 10:08:91"
        // ]);