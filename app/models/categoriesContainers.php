<?php

/**
 * Class categories containers for the home page
 */
class categoriesContainers
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCategories()
    {
        $this->db->query("SELECT categories.id, 
                               categories.name AS mainCategories, 
                                              entities.categoryId
                                                  FROM categories 
                                                   INNER JOIN entities 
                                                    on categories.id = entities.categoryId 
                               GROUP BY categories.name, categories.id,entities.categoryId");
        $results = $this->db->resultSet();
        return $results;
    }
}
