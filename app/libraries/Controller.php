<?php
/*
 * Base Controller
 * Load the models and view
 */

class Controller{
    //Load model
    public function model($model){
        //Require Model
        require_once '../app/models/'.$model. '.php';
        //Instacieted model
        return new $model();
    }

    //Render view
    public function view($view, $data=[]){
        //check for view
        if(file_exists('../app/views/'.$view. '.php')){
            require_once '../app/views/'.$view. '.php';
        }else{
            //view not exist
            die('View does not exist');
        }
    }

}