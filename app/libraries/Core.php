<?php

 /*
  * App Core Class
  * Create URL & loads core controller
  * URL FORMAT -/controller/method/params
  */
class Core{

    protected $currentController="Pages";
    protected $currentMethod="index";
    protected $params=[];

    public function __construct(){
        //print_r($this->getUrl());
        $url= $this->getUrl();


        //Check controller for first value
        if(file_exists('../app/controllers/'. ucwords($url[0]) . '.php')){

            //if exist set as controller
            $this->currentController= ucwords($url[0]);
            //Unset 0
            unset($url[0]);

        } else{
            //TODO check if is a good way
            $this->currentController= 'PageError';
        }
        //Require controller
        require_once '../app/controllers/'.$this->currentController.'.php';

        //Instace controller class
         $this->currentController = new $this->currentController;

         //Check for second part of URL
        if(isset($url[1])){

            //check if method exist in controllers
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //unset url
                unset($url[1]);
            }else{
                $this->currentMethod = 'error';
            }
        }

        $this->params= $url ? array_values($url) : [null];

        //Callback
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url= filter_var($url, FILTER_SANITIZE_URL);
            $url= explode('/',$url);
            return $url;
        }
        //Default
        return ['pages'];

    }
}