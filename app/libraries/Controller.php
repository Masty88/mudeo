<?php
/*
 * Base Controller
 * Load the models and view
 */

class Controller{
    /**
     * Load the model
     * @param $model
     * @return mixed
     */
    public function model($model){
        //Require Model
        require_once '../app/models/'.$model. '.php';
        //Instacieted model
        return new $model();
    }

    /**
     * Render the view
     * @param $view
     * @param array $data
     */
    public function view($view, $data=[]){
        //check for view
        if(file_exists('../app/views/'.$view. '.php')){
            require_once '../app/views/'.$view. '.php';
        }else{
            //view not exist
            http_response_code('404');
           require_once '../app/views/pages/404.php';
        }
    }



}