<?php
class PageError extends Controller {
    public function __construct(){

    }
    public function index(){
        $data=[
            'title'=> "BAD REQUEST",
        ];
        http_response_code(404);
        $this->view("pages/404", $data);
    }

    public function error(){
        $data=[
            'title'=> "BAD REQUEST",
        ];
        http_response_code(404);
        $this->view("pages/404", $data);
    }

}
