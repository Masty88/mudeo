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

    public function addToWatchList(int $id)
    {
        $entity = $this->entitiesModel->getEntityById($id);
        $data = [
            'entity' => $entity,
            'entityId' => $entity->id,
            'userId' => $_SESSION['user_id'],
            'liked' => "",
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->entitiesModel->preventDoubleInWatchList($data)) {
                $data['liked'] = true;
            } else {
                echo json_encode($data);
                $this->entitiesModel->addToWatchList($data);
            }
        }
    }

    /**
     * Remove media to user watch list with fetch api
     * @param integer $id
     */

    public function removeFromWatchList(int $id)
    {
        $entity = $this->entitiesModel->getEntityById($id);
        $watch_list = $this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $data = [
            'entity' => $entity,
            'watch_list' => $watch_list,
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($entity->id) {
                $this->entitiesModel->removeFromWatchList($id);
                flash('media_message', 'Media delete', 'ml-5 has-text-white');
                header('location: ' . URLROOT . '/medias/index');
            }
        } else {
            header('location: ' . URLROOT . '/medias/index');
        }
    }

    /**
     * Add media to user like list with fetch api
     * @param integer $id
     */

    public function addToLikedList(int $id)
    {
        $entity = $this->entitiesModel->getEntityById($id);
        $data = [
            'entity' => $entity,
            'entityId' => $entity->id,
            'userId' => $_SESSION['user_id'],
            'liked' => "",
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->entitiesModel->preventDoubleInLikeList($data)) {
                $data['liked'] = true;
            } else {
                echo json_encode($data);
                $this->entitiesModel->addToLikeList($data);
            }
        } else {
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Remove media to user like list with fetch api
     * @param integer $id
     */

    public function removeFromLikeList(int $id)
    {
        $entity = $this->entitiesModel->getEntityById($id);
        $like_list = $this->entitiesModel->getFromLikeList($_SESSION['user_id']);
        $data = [
            'entity' => $entity,
            'like_list' => $like_list,
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($entity->id) {
                echo json_encode($data);
                $this->entitiesModel->removeFromLikeList($id);
            }
        } else {
            header('location: ' . URLROOT . '/medias/index');
        }
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