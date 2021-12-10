<?php
class Pages extends Controller
{
    private $entitiesModel;
    private $categoriesContainers;

    public function __construct()
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/users/login');
        }
        $this->entitiesModel = $this->model('Entities');
        $this->categoriesContainers = $this->model('categoriesContainers');
        $this->createArrayList();
        $this->createArrayListLiked();
    }

    public function index()
    {
        $preview = $this->entitiesModel->getRandomEntity();
        $list = $this->entitiesModel->getEntities();
        $categories = $this->categoriesContainers->getCategories();
        $data = [
            'title' => "Saeflix",
            'preview' => $preview,
            'categories' => $categories,
            'list' => $list,
        ];
        $this->view("pages/index", $data);
    }

    /**
     * Show media and count unique view for video
     * @param $id
     */
    public function show($id)
    {
        $entity = $this->entitiesModel->getEntityById($id);
        $next_video = $this->entitiesModel->getRandomEntity();
        $data = [
            'entity' => $entity,
            'next_video' => $next_video,
            'userId' => $_SESSION['user_id'],
        ];
        if ($id) {
            if ($entity->id) {
                if ($this->entitiesModel->preventDoubleInViewsCount($id)) {
                    $this->entitiesModel->countUniqueViews($id);
                    $this->entitiesModel->countViews($id);
                }

                $this->view('pages/show', $data);
            } else {
                header('location: ' . URLROOT . '/pages/index');
            }
        } else {
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Show page about
     */
    public function about()
    {
        $data = [
            'title' => "About Us",
            'description' => "Lorem Ipsum",
        ];
        $this->view("pages/about", $data);
    }

    /**
     * Hydrate array for user watch list
     */
    protected function createArrayList()
    {
        $watch_list = $this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $added = [];
        $_SESSION['array_watch'] = [];
        foreach ($watch_list as $add) {
            array_push($_SESSION['array_watch'], $add->entity_id);
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
     * No method found
     */
    public function error()
    {
        $data = [
            'title' => "BAD REQUEST",
        ];
        http_response_code(404);
        $this->view("pages/404", $data);
    }
}
