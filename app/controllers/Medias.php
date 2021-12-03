<?php

class Medias extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            header('location: '.URLROOT.'/users/login');
        }

        $this->entitiesModel = $this->model('Entities');
        $this->createArrayListLiked();
        $this->createArrayList();
    }
    public function index(){
        $list= $this->entitiesModel->getEntitiesForUser($_SESSION['user_id']);
        $watch_list=$this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $data=[
            'user_id'=> $_SESSION['user_id'],
            'list'=>$list,
            'watch_list'=>$watch_list,
        ];
        $this->view('medias/index', $data);
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            //Sanitize Post
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data=[
                'title' => trim($_POST['title']),
                'body' =>trim($_POST['body']),
                'user_id'=> $_SESSION['user_id'],
                'category_id'=> '',
                'thumbnail'=>'',
                'media'=>'',
                'title_err'=> '',
                'body_err'=> '',
                'cover_err'=>'',
                'category_err'=>'',
                'media_err'=>'',
            ];

            //Validate Title
            if(empty($data['title'])){
                $data['title_err']= 'Please enter title';
            }
            //Validate Body
            if(empty($data['body'])){
                $data['body_err']= 'Please a message';
            }

            //Validate Category
            //condition for category
            if($_POST['category_id'] === "Chose type of media") {
                $data['category_err']= "please select a category";
            }
            else{
                if($_POST['category_id'] === "Feature Films"){
                    $data['category_id'] = 1;
                }
                if($_POST['category_id'] === "Short Films"){
                    $data['category_id'] = 14;
                }
                if($_POST['category_id'] === "Documentary"){
                    $data['category_id'] = 20;
                }
                if($_POST['category_id'] === "Commercials"){
                    $data['category_id'] = 13;
                }
                if($_POST['category_id'] === "VFX"){
                    $data['category_id'] = 18;
                }
                if($_POST['category_id'] === "Game Art Animation"){
                    $data['category_id'] = 3;
                }
                if($_POST['category_id'] === "Music Tracks"){
                    $data['category_id'] = 2;
                }
                if($_POST['category_id'] === "Music videos"){
                    $data['category_id'] = 17;
                }
                if($_POST['category_id'] === "Music Bases"){
                    $data['category_id'] = 4;
                }
                if($_POST['category_id'] === "Interviews"){
                    $data['category_id'] = 10;
                }
                if($_POST['category_id'] === "Others"){
                    $data['category_id'] = 19;
                }
            }

            //Validate cover Image
            if(!isset($_FILES['picture']) || $_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
                $data['cover_err'] = 'Please choose an image';

            }
            else {
                $valid_extensions = [ 'jpg', 'jpeg','png' ];
                $valid_mimes = [ 'image/jpeg', 'image/png' ];
                $max_size = 1280;


                $filename = explode('.', $_FILES['picture']['name']);
                $name = array_shift($filename);
                $ext = strtolower(implode('.', $filename));

                if (in_array($ext, $valid_extensions)) {
                    if (in_array($_FILES['picture']['type'], $valid_mimes)) {
                        if ($_FILES['picture']['size'] < 3000000) {
                            // $sizes[0] = width, $sizes[1] = height
                            $sizes = getimagesize($_FILES['picture']['tmp_name']);

                            if ($sizes[0] > $max_size || $sizes[1] > $max_size) {
                                switch ($ext) {
                                    case 'jpg':
                                    case 'jpeg':
                                        $image = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                        break;

                                    case 'png':
                                        $image = imagecreatefrompng($_FILES['picture']['tmp_name']);
                                        break;
                                }

                                $width = $max_size;
                                $height = $max_size;

                                if ($sizes[0] > $sizes[1]) {
                                    $height = round($sizes[1] / $sizes[0] * $max_size);
                                } else {
                                    $width = round($sizes[0] / $sizes[1] * $max_size);
                                }

                                $final = imagecreatetruecolor($width, $height);
                                imagesavealpha($final, true);
                                imagealphablending($final, false);
                                imagecopyresampled($final, $image, 0, 0, 0, 0, $width, $height, $sizes[0], $sizes[1]);


                                $final_name = uniqid() . '.' . $ext;

                                switch ($ext) {
                                    case 'jpg':
                                    case 'jpeg':
                                        imagejpeg($final, UPLROOT.'\public\entities\thumbnails'."\\". $final_name);
                                        break;

                                    case 'gif':
                                        imagegif($final, UPLROOT.'\public\entities\thumbnails'."\\". $final_name);
                                        break;

                                    case 'png':
                                        imagepng($final, UPLROOT.'\public\entities\thumbnails'."\\". $final_name);
                                        break;
                                }
                                $data['thumbnail']= 'entities/thumbnails/'.$final_name;
                            }
                            else {
                                $final_name = uniqid() . '.' . $ext;
                                move_uploaded_file($_FILES['picture']['tmp_name'],  UPLROOT.'\public\entities\thumbnails'."\\".$final_name );
                                $data['thumbnail']= 'entities/thumbnails/'.$final_name;
                            }
                        }
                        else {
                            $data['cover_err'] = 'File exceed maximum size of 3mb';
                        }
                    }
                    else {
                        $data['cover_err'] = 'Mime type invalid';
                    }
                }
                else {
                    $data['cover_err'] = 'Extension invalid';
                }
            }

            //Validate Media Uploader
            if(!isset($_FILES['media']) || $_FILES['media']['error'] == UPLOAD_ERR_NO_FILE) {
                $data['media_err'] = 'Please upload a media';
            }
            else {
                $media = $_FILES['media'];
                $valid_extensions = ["mp3", "mp4", "wma", "webm"];
                $valid_mimes = ["audio/mpeg", "audio/wma", "video/mp4", "video/webm"];

                $filename = explode('.', $_FILES['media']['name']);
                $name = array_shift($filename);
                $ext = strtolower(implode('.', $filename));

                if (in_array($ext, $valid_extensions)) {
                    if (in_array($_FILES['media']['type'], $valid_mimes)) {
                        if ($_FILES['media']['size'] < 1000000000 &&
                            empty($data['title_err'])
                            && empty($data['body_err'])
                            && empty($data['cover_err'])
                            && empty($data['category_err'])
                            ) {

                            if($_FILES['media']['type'] == "video/mp4" || $_FILES['media']['type'] == "video/webm" ){
                                $file_temp=$_FILES['media']['tmp_name'];
                                $ff= APPROOT."/libraries/FFmpeg/bin/ffmpeg";
                                $ff=str_replace('\\', '/', $ff);
                                $final_name = uniqid() . '.' . "mp4";
                                $final_directory=UPLROOT . '\public\entities\videos' . "\\" . $final_name;
                                $final_directory_preview=UPLROOT . '\public\entities\previews' . "\\" . $final_name;
                                //compress and resize video
                                $cmd="$ff -i $file_temp  -s 1920:1080  $final_directory";
                                //create preview
                                $cmd_prew="$ff -i $file_temp  -vcodec  copy  -ss 00:00:05 -t 00:00:05   $final_directory_preview";
                                system($cmd);
                                system($cmd_prew);
                                $data['media_preview'] = 'entities/previews/' . $final_name;
                                $data['media_full'] = 'entities/videos/' . $final_name;
                            }
                             elseif($_FILES['media']['type'] == "audio/wma" || $_FILES['media']['type'] == "audio/mpeg" ){
                                $file_temp=$_FILES['media']['tmp_name'];
                                $ff= APPROOT."/libraries/FFmpeg/bin/ffmpeg";
                                $ff=str_replace('\\', '/', $ff);
                                $final_name = uniqid() . '.' . "mp4";
                                $final_directory=UPLROOT . '\public\entities\videos' . "\\" . $final_name;
                                $final_directory_preview=UPLROOT . '\public\entities\previews' . "\\" . $final_name;
                                //creat waveform video
                                $filter="[0:a]showwaves=colors=blueviolet:s=1280x720:mode=cline,format=yuv420p[v]";
                                $map="[v]";
                                $cmd="$ff  -i $file_temp -filter_complex $filter -map $map -map 0:a -c:v libx264 -c:a copy $final_directory";
                                system($cmd);
                                $data['media_preview'] = 'entities/videos/' . $final_name;
                                $data['media_full'] = 'entities/videos/' . $final_name;
                            }
                        } else {
                            $data['media_err'] = 'there is a problem';
                        }
                    } else {
                        $data['media_err'] = 'Mime type invalid';
                    }
                } else {
                    $data['media_err'] = 'Extension invalid';
                }
            }



            //Make sure no errors
            if(empty($data['title_err'])
                && empty($data['body_err'])
                && empty($data['cover_err'])
                && empty($data['media_err'])
                && empty($data['category_err'])){
                //Check if user has uploaded less tha 3 Media
                if(($this->entitiesModel->countMediaForUsers($data['user_id']))){
                    //Validated

                    if($this->entitiesModel->addMedia($data)){
                        $data['success']= true;
                        flash('media_message', 'Media Added', "ml-5 has-text-white");
                        // header('location: '.URLROOT.'/medias');
                        //$this->view('medias/add', $data);

                    }else{
                        die('something went wrong');
                    }
                }else{
                    flash('media_error', 'You have already reach the maximum upload allowed!','has-text-white mb-6');
                    header('location: '.URLROOT.'/medias/add');
                }

            }else{
                //Load the view with errors
                // $this->view('medias/add', $data);
                $data['success']= false;
            }
            echo json_encode($data);
        }else{
            $data=[
                'title' => '',
                'body' =>'',
                'title_err'=> '',
                'body_err'=> '',
                'cover_err'=>'',
                'category_err'=>'',
                'media_err'=>'',
            ];
            $this->view('medias/add', $data);
        }

    }

   /*
    * Check media owner
    * Delete media from folder
    * Delete from bdd
    */
    public function delete($id){
        $entity= $this->entitiesModel->getEntityById($id);
        $data=[
            'entity'=> $entity,
        ];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_SESSION['user_id']===$data['entity']->userId){
                if($entity->id){
                    $this->entitiesModel->deleteMedia($id);
                    $file_to_delete= UPLROOT . '\public' . "\\" . $data['entity']->preview;
                    $file_to_delete_full= UPLROOT . '\public' . "\\" . $data['entity']->full_media;
                    $thumb_to_delete=UPLROOT . '\public' . "\\" . $data['entity']->thumbnail;
                    if(!unlink($thumb_to_delete)){
                        die("error");
                    }
                    if(!unlink($file_to_delete_full)){
                        die("error");
                    }
                    if(file_exists($file_to_delete)){
                        if(!unlink($file_to_delete) ){
                            die("error");
                        }
                    }
                    flash('media_message', 'Media delete',"ml-5 has-text-white");
                    header('location: '.URLROOT.'/medias/index');
                }
            }else{
                header('location: '.URLROOT.'/medias/index');
            }
        }
        else{header('location: '.URLROOT.'/medias/index');}
    }

    public function modify($id){
        $entity = $this->entitiesModel->getEntityById($id);
            if($id){
                if($entity->id){
                    if($_SESSION['user_id']===$entity->userId){
                            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                                echo "here";
                                $data = [
                                    'entity'=>$entity,
                                    'entityId'=>$entity->id,
                                    'title' => trim($_POST['title']),
                                    'body' =>trim($_POST['body']),
                                    'user_id'=> $_SESSION['user_id'],
                                    'category_id'=> '',
                                    'thumbnail'=>$entity->thumbnail,
                                    'media'=>'',
                                    'title_err'=> '',
                                    'body_err'=> '',
                                    'cover_err'=>'',
                                    'category_err'=>'',
                                    'media_err'=>'',
                                ];
                                //Validate Title
                                if(empty($data['title'])){
                                    $data['title_err']= 'Please enter title';
                                }
                                //Validate Body
                                if(empty($data['body'])){
                                    $data['body_err']= 'Please a message';
                                }

                                //Validate Category
                                //condition for category
                                if($_POST['category_id'] === "Chose type of media") {
                                    $data['category_err']= "please select a category";
                                }
                                else{
                                    if($_POST['category_id'] === "Feature Films"){
                                        $data['category_id'] = 1;
                                    }
                                    if($_POST['category_id'] === "Short Films"){
                                        $data['category_id'] = 14;
                                    }
                                    if($_POST['category_id'] === "Documentary"){
                                        $data['category_id'] = 20;
                                    }
                                    if($_POST['category_id'] === "Commercials"){
                                        $data['category_id'] = 13;
                                    }
                                    if($_POST['category_id'] === "VFX"){
                                        $data['category_id'] = 18;
                                    }
                                    if($_POST['category_id'] === "Game Art Animation"){
                                        $data['category_id'] = 3;
                                    }
                                    if($_POST['category_id'] === "Music Tracks"){
                                        $data['category_id'] = 2;
                                    }
                                    if($_POST['category_id'] === "Music videos"){
                                        $data['category_id'] = 17;
                                    }
                                    if($_POST['category_id'] === "Music Bases"){
                                        $data['category_id'] = 4;
                                    }
                                    if($_POST['category_id'] === "Interviews"){
                                        $data['category_id'] = 10;
                                    }
                                    if($_POST['category_id'] === "Others"){
                                        $data['category_id'] = 19;
                                    }
                                }

                                //Validate cover Image
                                if(!isset($_FILES['picture']) || $_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
                                    $data['cover_err'] = 'Please choose an image';
                                }
                                else {
                                    $valid_extensions = [ 'jpg', 'jpeg','png' ];
                                    $valid_mimes = [ 'image/jpeg', 'image/png' ];
                                    $max_size = 1280;

                                    $filename = explode('.', $_FILES['picture']['name']);
                                    $name = array_shift($filename);
                                    $ext = strtolower(implode('.', $filename));

                                    if (in_array($ext, $valid_extensions)) {
                                        if (in_array($_FILES['picture']['type'], $valid_mimes)) {
                                            if ($_FILES['picture']['size'] < 3000000) {
                                                // $sizes[0] = width, $sizes[1] = height
                                                $sizes = getimagesize($_FILES['picture']['tmp_name']);

                                                if ($sizes[0] > $max_size || $sizes[1] > $max_size) {
                                                    switch ($ext) {
                                                        case 'jpg':
                                                        case 'jpeg':
                                                            $image = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                                            break;

                                                        case 'png':
                                                            $image = imagecreatefrompng($_FILES['picture']['tmp_name']);
                                                            break;
                                                    }

                                                    $width = $max_size;
                                                    $height = $max_size;

                                                    if ($sizes[0] > $sizes[1]) {
                                                        $height = round($sizes[1] / $sizes[0] * $max_size);
                                                    } else {
                                                        $width = round($sizes[0] / $sizes[1] * $max_size);
                                                    }

                                                    $final = imagecreatetruecolor($width, $height);
                                                    imagesavealpha($final, true);
                                                    imagealphablending($final, false);
                                                    imagecopyresampled($final, $image, 0, 0, 0, 0, $width, $height, $sizes[0], $sizes[1]);


                                                    $final_name = uniqid() . '.' . $ext;

                                                    switch ($ext) {
                                                        case 'jpg':
                                                        case 'jpeg':
                                                            imagejpeg($final, UPLROOT.'\public\entities\thumbnails'."\\". $final_name);
                                                            break;

                                                        case 'gif':
                                                            imagegif($final, UPLROOT.'\public\entities\thumbnails'."\\". $final_name);
                                                            break;

                                                        case 'png':
                                                            imagepng($final, UPLROOT.'\public\entities\thumbnails'."\\". $final_name);
                                                            break;
                                                    }
                                                    $data['thumbnail']= 'entities/thumbnails/'.$final_name;
                                                }
                                                else {
                                                    $final_name = "test" . '.' . $ext;
                                                    move_uploaded_file($_FILES['picture']['tmp_name'],  UPLROOT.'\public\entities\thumbnails'."\\".$final_name );
                                                    $data['thumbnail']= 'entities/thumbnails/'.$final_name;
                                                }
                                            }
                                            else {
                                                $data['cover_err'] = 'File exceed maximum size of 3mb';
                                            }
                                        }
                                        else {
                                            $data['cover_err'] = 'Mime type invalid';
                                        }
                                    }
                                    else {
                                        $data['cover_err'] = 'Extension invalid';
                                    }
                                }

                                //Make sure no errors
                                if(empty($data['title_err'])
                                    && empty($data['body_err'])
                                    && empty($data['category_err'])){
                                    //Validated
                                    if($this->entitiesModel->modifyMedia($data)){
                                        flash('media_message', 'Media modify',"has-text-white ml-5");
                                        header('location: '.URLROOT.'/medias/index');
                                    }else{
                                        die('something went wrong');
                                    }
                                }
                                else{
                                    //Load the view with errors
                                    $this->view('medias/modify', $data);
                                }
                            }
                            else{
                                $data=[
                                    'entity'=>$entity,
                                    'title' => '',
                                    'body' =>'',
                                    'title_err'=> '',
                                    'body_err'=> '',
                                    'cover_err'=>'',
                                    'category_err'=>'',
                                    'media_err'=>'',
                                ];

                                $this->view('medias/modify', $data);
                            }
                    }else{
                        header('location: '.URLROOT.'/medias/index');
                    }
                }else{
                    header('location: '.URLROOT.'/medias/index');
                }
            }else{
                header('location: '.URLROOT.'/pages/index');
            }

    }

    public function addToWatchList($id){
        $entity= $this->entitiesModel->getEntityById($id);
        $data=[
            'entity'=> $entity,
            'entityId'=>$entity->id,
            'userId'=> $_SESSION['user_id'],
            'liked'=>"",
        ];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if($this->entitiesModel->preventDoubleInWatchList($data)){
                $data['liked']= true;
            }else{
                echo json_encode($data);
                $this->entitiesModel->addToWatchList($data);
            }
        }
    }

    public function removeFromWatchList($id){
        $entity= $this->entitiesModel->getEntityById($id);
        $watch_list=$this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $data=[
            'entity'=> $entity,
            'watch_list'=>$watch_list
        ];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($entity->id){
                    $this->entitiesModel->removeFromWatchList($id);
                    flash('media_message', 'Media delete','ml-5 has-text-white');
                    header('location: '.URLROOT.'/medias/index');
                }
        }
        else{header('location: '.URLROOT.'/medias/index');}
    }

    public function addToLikedList($id){
        $entity= $this->entitiesModel->getEntityById($id);
        $data=[
            'entity'=> $entity,
            'entityId'=>$entity->id,
            'userId'=> $_SESSION['user_id'],
            'liked'=>"",
        ];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if($this->entitiesModel->preventDoubleInLikeList($data)){
                $data['liked']= true;
            }else{
                echo json_encode($data);
                $this->entitiesModel->addToLikeList($data);
            }
            }
        else{header('location: '.URLROOT.'/pages/index');}
    }

    public function removeFromLikeList($id){
        $entity= $this->entitiesModel->getEntityById($id);
        $like_list=$this->entitiesModel->getFromLikeList($_SESSION['user_id']);
        $data=[
            'entity'=> $entity,
            'like_list'=>$like_list
        ];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($entity->id){
                echo json_encode($data);
                $this->entitiesModel->removeFromLikeList($id);
            }
        }
        else{header('location: '.URLROOT.'/medias/index');}
    }

    protected function createArrayListLiked(){
        $watch_list=$this->entitiesModel->getFromLikeList($_SESSION['user_id']);
        $added=[];
        $_SESSION['array_like']=[];
        foreach ($watch_list as $add){
            array_push($_SESSION['array_like'],$add->entity_id);
        }
    }

    protected function createArrayList(){
        $watch_list=$this->entitiesModel->getFromWatchList($_SESSION['user_id']);
        $added=[];
        $_SESSION['array_watch']=[];
        foreach ($watch_list as $add){
            array_push($_SESSION['array_watch'],$add->entity_id);
        }
    }

    public function search(){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            //Sanitize Post
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data=[
                'query'=>trim($_POST['query']),
                'query_err'=>"",
            ];

            if(empty($_POST['query'])){
                $data['query_err']= "Please enter a word";
            }
             if(!empty($data["query_err"])){
                 $data['success'] = false;
             }else{
                 $data['success'] = true;
                 $_SESSION['query']=$data['query'];
             }
            echo json_encode($data);
        }else{header('location: '.URLROOT.'/medias/index');}
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
