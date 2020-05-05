<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;
use App\Utility\Redirect;
use App\Utility\Session;
use App\Utility\Flash;
use App\Models\User;

/**
 * Posts controller
 *
 * PHP version 7.4.3
 */
class Posts extends \Core\Controller
{

    /**
     *  Constructor:
     * 
     * @return void
     */
    public function __construct($route_params)
    {
        Session::init();
        $this->route_params = $route_params;
    }

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        if(!Session::exists('user_id')){
            Redirect::to('users/login');
        }
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //
    }


    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $post = new Post;
        $posts = $post->getAll();
        $feedback = [
            'success' => Flash::success(),
            'danger' => Flash::danger(),
            'info' => Flash::info(),
            'warning' => Flash::warning()
        ];
        View::renderTemplate('Posts/index.html', [
            'posts'=> $posts,
            'feedback'=> $feedback
        ]);
    }

    /**
     * Add: POST REQUEST page
     *
     * @redirect
     */
    public function addAction()
    {
        $title = "Add New";

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title'=> trim($_POST['title']),
                'content'=> trim($_POST['content']),
                'user_id'=> $_SESSION['user_id']
            ];
            $errors = [
                'title'=>'',
                'content'=>''
            ];

            if(empty($data['title'])){
                $errors['title'] = 'Please enter a title';
            }
            if(empty($data['content'])){
                $errors['content'] = 'Post is empty';
            }
            // if no errors 
            if(!empty($errors['content']) || !empty($errors['title'] )){
                //with errors
                View::renderTemplate('Posts/add.html', [
                    'data'=> $data,
                    'title'=> $title,
                    'errors' => $errors
                ]);
            } else {
               //but actually make a post
                $post = new Post;
                $time = date('Y-m-d') . " " . date("h-m-s");
                $post->createNewPost([
                    'title'=> $data['title'],
                    'content'=> $data['content'],
                    'created_at'=> $time,
                    'post_user_id'=> $_SESSION['user_id']
                    ]);
                //success
                Flash::success('Post created successfully!');
                Redirect::to("posts/index");
            }
        }
    }



    /**
     * Show: {id}/show
     * post view with edit and delete buttons 
     * 
     * @return void
     */
    public function viewAction()
    {
        $post = new Post;
        $result = $post->getById($this->route_params['id'])->first();

        $user = new User;
        $id = (int)$result['post_user_id'];
        $user = $user->getById($id)->first();

        $title = 'Show';
        $post = [
            'id' => $result['id'],
            'title' => $result['title'],
            'content' => $result['content'],
            'created_at' => $result['created_at'],
            'created_by_id' => $result['post_user_id'],
            'created_by' => $user['forename'] . " " . $user['surname'],
        ];
        $data =[
            'user_id'=> $_SESSION['user_id']
        ];

        View::renderTemplate('Posts/show.html', [
            'post'=> $post,
            'data'=> $data,
            'title'=> $title
        ]);
    }


    /**
     * Show the add new page
     *
     * @return void
     */
    public function addNewAction()
    {
        $title = "Add New";
        $data = [
            'title' => '',
            'content' => ''
        ];
        $errors = [
            'title' => '',
            'content' => ''
        ];
        View::renderTemplate('Posts/add.html', [
            'data'=> $data,
            'title'=> $title,
            'errors' => $errors
        ]);

        
        // $post = new Post;
        // $post->createNewPost(['title'=>'ay','content'=>'aa','created_at'=>'123']);

    }
    
    /**
     * Show the edit page:
     * Redirects if not post creator
     * 
     *
     * @return void
     */
    public function editAction()
    {
        //post request first
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id'=> trim($_POST['id']),
                'title'=> trim($_POST['title']),
                'content'=> trim($_POST['content']),
                'user_id'=> $_SESSION['user_id'],
                'created_by' => trim($_POST['created_by']),
                'created_at' => trim($_POST['created_at'])
            ];
            $errors = [
                'title'=>'',
                'content'=>''
            ];

            if(empty($data['title'])){
                $errors['title'] = 'Please enter a title';
            }
            if(empty($data['content'])){
                $errors['content'] = 'Post is empty';
            }
            // if no errors 
            if(!empty($errors['content']) || !empty($errors['title'] )){
                //with errors render back
                View::renderTemplate('Posts/edit.html', [
                    'post'=> $data,
                    'title'=> 'Edit',
                    'errors' => $errors
                ]);
            } else {
               // else we edit post
                $post = new Post;
                $time = date('Y-m-d') . " " . date("h-m-s");


                $post->updateById($data['id'],[
                    'title'=> $data['title'],
                    'content'=> $data['content'],
                    'created_at'=> $time
                    ]);
                //success
                Flash::success('Post updated successfully!');
                Redirect::to("posts/index");
            }
        } else {
            //first load or [not post request]
            $post = new Post;
            $post = $post->getById($this->route_params['id'])->first();
            // getting user data
            $user = new User;
            $id = (int)$post['post_user_id'];
            $user = $user->getById($id)->first();
            //checking owner
            if($_SESSION['user_id'] != $post['post_user_id']){
                Redirect::to('posts/index');
            }
            // all checks out then render
            $title = "Edit";
            $data = [
                'id' => $post['id'],
                'title' => $post['title'],
                'content' => $post['content'],
                'created_by' => $user['forename'] . " " . $user['surname'],
                'created_by_id' => $post['post_user_id'],
                'created_at' => $post['created_at']
            ];
            $errors = [
                'title' => '',
                'content' => '',
            ];
            View::renderTemplate('Posts/edit.html', [
                'post'=> $data,
                'title'=> $title,
                'errors' => $errors
            ]);
        }
    }

    /**
     * [id]/delete
     * can't be anything else than a post request
     * @return void
     */
    public function deleteAction()
    {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            try {
                $post = new Post;
                $post = $post->deleteById($this->route_params['id']);
    
                Flash::success('Post Removed!');
                Redirect::to("posts/index");
            } catch (Exception $e) {
                throw new \Exception("Couldn't delete");
                Flash::success('Something went wrong');
                Redirect::to("posts/index");
            }



        } else {
            Redirect::to("posts/index");
        }
    }
}






/** quick use */
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