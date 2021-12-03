<?php
class Posts extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            header('location: '.URLROOT.'/users/login');
        }

        $this->postModel = $this->model('Post');
    }
   public function index(){
        $posts = $this->postModel->getPosts();
       $data=[
           'posts' => $posts,
       ];
       $this->view('posts/index', $data);
   }

   public function add(){
        if($_SERVER['REQUEST_METHOD'] =='POST'){
         //Sanitize Post
         $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
                'title' => trim($_POST['title']),
                'body' =>trim($_POST['body']),
                'user_id'=> $_SESSION['user_id'],
                'title_err'=> '',
                'body_err'=> '',
            ];
            //Validate Title
            if(empty($data['title'])){
                $data['title_err']= 'Please enter title';
            }
            //Validate Body
            if(empty($data['body'])){
                $data['body_err']= 'Please a message';
            }

            //Make sure no errors
            if(empty($data['title_err'] && $data['body_err'])){
                //Validated
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    header('location: '.URLROOT.'/posts');
                }else{
                    die('something went wrong');
                }
            }else{
                //Load the view with errors
                $this->view('posts/add', $data);
            }

        }else{
            $data=[
                'title' => '',
                'body' =>'',
                'title_err'=> '',
                'body_err'=> '',
            ];
            $this->view('posts/add', $data);
        }


   }
}
