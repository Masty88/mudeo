<?php

class Search extends Controller
{
    private $entitiesModel;

    public function __construct()
{
    if (!isLoggedIn()) {
        header('location: ' . URLROOT . '/users/login');
    }

    $this->entitiesModel = $this->model('Entities');
    $this->createArrayListLiked();
    $this->createArrayList();
}

    public function index(){
        header('location: ' . URLROOT . '/pages/index');
    }
    /**
     * Hydrate array for user liked list
     */
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //Sanitize Post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'query' => trim($_POST['query']),
                'query_err' => "",
            ];

            if (empty($_POST['query'])) {
                $data['query_err'] = "Please enter a word";
            }
            if (!empty($data["query_err"])) {
                $data['success'] = false;
            } else {
                $data['success'] = true;
                $_SESSION['query'] = $data['query'];
            }
            echo json_encode($data);
        } else {
            header('location: ' . URLROOT . '/medias/index');
        }
    }

    public function viewSearch()
    {
        $search_list = $this->entitiesModel->search($_SESSION['query']);
        $data = [
            'search_list' => $search_list,
        ];
        if (empty($data['search_list'])) {
            flash('search_message', 'Nothing to show');
        } else {
            flash('search_message', "We found" . " " . count($data['search_list']), "has-text-white");
        }
        $this->view("search/search", $data);
    }

    /**
     * Hydrate array for user liked list
     */

    protected function createArrayListLiked()
    {
        $watch_list = $this->entitiesModel->getFromLikeList($_SESSION['user_id']);
        $_SESSION['array_like'] = [];
        foreach ($watch_list as $add) {
            array_push($_SESSION['array_like'], $add->entity_id);
        }
    }

    /**
     * Hydrate array for user watch list
     */

    protected function createArrayList()
    {
        $watch_list = $this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $_SESSION['array_watch'] = [];
        foreach ($watch_list as $add) {
            array_push($_SESSION['array_watch'], $add->entity_id);
        }
    }

}