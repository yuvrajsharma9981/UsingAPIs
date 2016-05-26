<?php

require 'yelp.php';

class Database {

    private $connection;
    private $db_name;
    private $MYSQL_USER;
    private $MYSQL_PASS;
    
    public function __construct($dbname) {
        
        $this->MYSQL_USER = getenv('MYSQL_USER');
        $this->MYSQL_PASS = getenv('MYSQL_PASS');
        $this->db_name = $dbname;
        $dsn = 'mysql:host=localhost;dbname=' . $this->db_name;
        
        try {

            $this->connection = new PDO($dsn, $this->MYSQL_USER, $this->MYSQL_PASS);
            
        } catch (PDOException $e) {

            echo 'Exception encountered: ' . $e->getMessage() . '<br>';

            $check = strpos($e->getMessage(), 'Unknown database');

            if ($check != false) {
                // The exception is due to unknown database               
                
                $this->createDatabase();
            }  // end of check       
        }   // end of try ... catch
    }

// end of constructor

    public function createDatabase() {
        //global $db_name;
        echo 'Creating database ' . $this->db_name . ' ......<br>';

        try {

            $this->connection = new PDO('mysql:host=localhost', $this->MYSQL_USER, $this->MYSQL_PASS);
            $this->connection->exec("create database " . $this->db_name);

            echo $this->db_name . ' database has been created.<br>';
        } catch (PDOException $e) {

            echo 'Exception encountered: ' . $e->getMessage() . '. Abort!<br>';
        }  // end of try ... catch          
    }

    public function createTable($table_name) {

        $sql = //"use " . $this->db_name . ";" .
                "create table if not exists " . $table_name . " (               

                id INT NOT NULL AUTO_INCREMENT,                             

                name VARCHAR(140),               

                rating VARCHAR(140),            

                PRIMARY KEY (id)               

                )";
        
        try {
            
            $this->connection->exec($sql);

            echo 'Table ' . $table_name . ' has been created successfully.<br>';
        } catch (PDOException $e) {

            echo 'Exception encountered: ' . $e->getMessage() . '<br>';
        }
    }

    public function insertNames($table_name, $restaurent_names, $rating) {

        $sql = "INSERT INTO " . $table_name . " "
                . "(name, rating) "
                . "VALUES ('$restaurent_names', '$rating')";
        $this->connection->query($sql);
        echo "Record has been Successfully saved";
        echo $term;
        echo "<a href='#' onclick='history.back();'> Go Back!</a>";
    }

    public function retrieveNames($table_name, $query_word) {

        try {
            $sql = "SELECT text, screen_name FROM " . $table_name. " WHERE text LIKE '%". $query_word. "%'";
            
            $statement = $this->connection->prepare($sql);

            $statement->execute();

            $tweets = array();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $t = new stdClass();
                foreach ($row as $key => $value){
                    if ($key == 'text'){
                        $t->text = $value;
                    }
                    if($key == 'screen_name'){
                        $t->screen_name = $value;
                        $tweets[] = $t;
                    }                    
                    
                }
            }

            return $tweets;
        } catch (Exception $ex) {

            return 'Something wrong: ' . $ex->getMessage() . '<br>';
        }
    }

}

