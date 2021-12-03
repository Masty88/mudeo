<?php
class Pages extends Controller {
    private $entitiesModel;
    private $categoriesContainers;

    public function __construct(){
        if(!isLoggedIn()){
            header('location: '.URLROOT.'/users/login');
        }
        $this->entitiesModel = $this->model('Entities');
        $this->categoriesContainers = $this->model('categoriesContainers');
        $this->createArrayList();
        $this->createArrayListLiked();
    }

    public function index(){
        $preview = $this->entitiesModel->getRandomEntity();
        $list= $this->entitiesModel->getEntities();
        $categories=$this->categoriesContainers->getCategories();
        $data=[
            'title'=> "Saeflix",
            'preview' => $preview,
            'categories'=>$categories,
            'list'=> $list,
            ];
            $this->view("pages/index", $data);

    }

    public function show($id){
        $entity = $this->entitiesModel->getEntityById($id);
        $next_video=$this->entitiesModel->getRandomEntity();
        $data = [
            'entity'=>$entity,
            'next_video'=>$next_video,
        ];
        if($id){

            if($entity->id){

               if($this->entitiesModel->preventDoubleInViewsCount($id)){
                   $this->entitiesModel->countUniqueViews($id);
                   $this->entitiesModel->countViews($id);
               }

                $this->view('pages/show', $data);
            }else{
                header('location: '.URLROOT.'/pages/index');
            }
        }else{
            header('location: '.URLROOT.'/pages/index');
        }
    }

    public function about(){
        $data=[
            'title'=> "About Us",
            'description' => "Lorem Ipsum"
         ];
        $this->view("pages/about", $data);
    }

    protected function createArrayList(){
        $watch_list=$this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $added=[];
        $_SESSION['array_watch']=[];
        foreach ($watch_list as $add){
            array_push($_SESSION['array_watch'],$add->entity_id);
        }
    }

    protected function createArrayListLiked(){
        $watch_list=$this->entitiesModel->getFromLikeList($_SESSION['user_id']);
        $_SESSION['array_like']=[];
        foreach ($watch_list as $add){
            array_push($_SESSION['array_like'],$add->entity_id);
        }
    }

    public function viewSearch(){
        $search_list= $this->entitiesModel->search( $_SESSION['query']);
        $data=[
            'search_list'=>$search_list
        ];
            if(empty($data['search_list'])){
                flash('search_message', 'Nothing to show');
                $this->view("medias/search", $data);
            }else{
                flash('search_message',"We found"." ". count($data['search_list']) , "has-text-white");
                $this->view("medias/search", $data);
            }
    }

    public function error(){
        $data=[
            'title'=> "BAD REQUEST",
        ];
        $this->view("pages/404", $data);
    }
}