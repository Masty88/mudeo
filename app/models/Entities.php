<?php

class Entities
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function createPreviewVideo($entity){
        if( $entity== null){
            $entity=$this->getRandomEntity();
        }
    }

    public function getRandomEntity(){
        $this->db->query("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $results=$this->db->single();
        return $results;
    }

    public function getEntities(){
        $this->db->query("SELECT entities.name AS filmName, 
                                           entities.categoryId, 
                                            entities.thumbnail, 
                                                entities.id AS showId,
                                                entities.view_count,
                                                categories.name, 
                                                categories.id 
                                                FROM categories  
                                                INNER JOIN entities 
                                                ON categories.id = entities.categoryId 
                                                ORDER BY categories.name;");
        $results=$this->db->resultSet();
        return $results;
    }

    public function addMedia($data){
        $this->db->query("INSERT INTO entities (name,thumbnail,preview,categoryId,userId,description,full_media) VALUES (:name, :thumbnail, :preview ,:categoryId, :userId, :description, :full_media )");
        $this->db->bind(':name', $data['title']);
        $this->db->bind(':userId', $data['user_id']);
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':preview', $data['media_preview']);
        $this->db->bind(':full_media', $data['media_full']);
        $this->db->bind(':categoryId', $data['category_id']);
        $this->db->bind(':description', $data['body']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * Count media for user
     * Return false if upload limit has been reached
     */

    public function countMediaForUsers($userId){
        $this->db->query('SELECT * FROM entities WHERE userId = :userId');
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() < 5) {
            return true;
        } else {
            return false;
        }
    }

    public function getEntityById($id){
        $this->db->query('SELECT * FROM entities WHERE id= :id');
        $this->db->bind(':id', $id);
        $row= $this->db->single();
        return $row;
    }

    public function getEntitiesForUser($userId){
        $this->db->query('SELECT * FROM entities WHERE userid= :id');
        $this->db->bind(':id', $userId);
        $results=$this->db->resultSet();
        return $results;
    }

    public function deleteMedia($id){
        $this->db->query('DELETE FROM entities WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function modifyMedia($data){
        $this->db->query('UPDATE entities SET name = :name, description = :description, categoryId = :categoryId, thumbnail = :thumbnail  WHERE id= :id');
        $this->db->bind(':name', $data['title']);
        $this->db->bind(':description', $data['body']);
        $this->db->bind(':categoryId', $data['category_id']);
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':id', $data['entityId']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function addToWatchList($data){
        $this->db->query('INSERT INTO users_watch_list (entity_id,user_id) VALUES (:entity_id, :user_id)');
        $this->db->bind(':entity_id',$data['entityId']);
        $this->db->bind(':user_id',$data['userId']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getFromWatchList($userId){
        $this->db->query('SELECT entities.name AS filmName, 
                                           entities.categoryId, 
                                            entities.thumbnail, 
                                            entities.id AS showId,
                                            entities.view_count,
                                            users_watch_list.entity_id,
                                            users_watch_list.user_id
                                            FROM users_watch_list 
                                            INNER JOIN entities 
                                            ON users_watch_list.entity_id = entities.id
                                            WHERE users_watch_list.user_id = :user_id');
        $this->db->bind(':user_id', $userId );
        $results=$this->db->resultSet();
        return $results;
    }

    public function removeFromWatchList($id){
        $this->db->query('DELETE FROM users_watch_list WHERE entity_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function preventDoubleInWatchList($data)
    {
        $this->db->query('SELECT * FROM users_watch_list WHERE user_id = :user_id AND entity_id= :entity_id');
        $this->db->bind(':entity_id',$data['entityId']);
        $this->db->bind(':user_id',$data['userId']);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addToLikeList($data){
        $this->db->query('INSERT INTO liked_media (entity_id,user_id) VALUES (:entity_id, :user_id)');
        $this->db->bind(':entity_id',$data['entityId']);
        $this->db->bind(':user_id',$data['userId']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function preventDoubleInLikeList($data)
    {
        $this->db->query('SELECT * FROM liked_media WHERE user_id = :user_id AND entity_id= :entity_id');
        $this->db->bind(':entity_id',$data['entityId']);
        $this->db->bind(':user_id',$data['userId']);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getFromLikeList($userId){
        $this->db->query('SELECT * FROM liked_media WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId );
        $results=$this->db->resultSet();
        return $results;
    }

    public function removeFromLikeList($id){
        $this->db->query('DELETE FROM liked_media WHERE entity_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function search($input){
        $sql = "SELECT * FROM entities WHERE name LIKE CONCAT( '%', :input, '%')";
        $this->db->query($sql);
        $this->db->bind(':input', $input);

        //$this->db->rowCount();
            $results=$this->db->resultSet();
            return $results;
    }

    public function countViews($id){
        $this->db->query("UPDATE entities SET view_count = view_count + 1 WHERE id= :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function countUniqueViews($id){
        $this->db->query("INSERT INTO count_views (user_id,entity_id) VALUES (:user_id, :entity_id)");
        $this->db->bind(':entity_id', $id);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
    }

    public function preventDoubleInViewsCount($id)
    {
        $this->db->query('SELECT * FROM count_views WHERE user_id = :user_id AND entity_id= :entity_id');
        $this->db->bind(':entity_id',$id);
        $this->db->bind(':user_id',$_SESSION['user_id']);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return false;
        } else {
            return true;
        }

    }

    public function getNextVideo(){
        $this->db->query('SELECT * FROM entities WHERE id !=:id ');
    }

}

