<?php

require "../../vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class Collect {

    private $twitter;
    private $CONSUMER_KEY;
    private $CONSUMER_SECRET;
    private $ACCESS_TOKEN;
    private $ACCESS_TOKEN_SECRET;

    public function __construct() {

        //twitter API conncetion
        $this->CONSUMER_KEY = getenv('CONSUMER_KEY');
        $this->CONSUMER_SECRET = getenv('CONSUMER_SECRET');
        $this->ACCESS_TOKEN = getenv('ACCESS_TOKEN');
        $this->ACCESS_TOKEN_SECRET = getenv('ACCESS_TOKEN_SECRET');

        $this->twitter = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $this->ACCESS_TOKEN, $this->ACCESS_TOKEN_SECRET);
        echo "hey";
        //MySQL Connection
        $this->MYSQL_USER = getenv('MYSQL_USER');
        $this->MYSQL_PASS = getenv('MYSQL_PASS');
        $this->db_name = "nsf";

        $dsn = 'mysql:host=localhost;dbname=' . $this->db_name;
        $this->connection = new PDO($dsn, $this->MYSQL_USER, $this->MYSQL_PASS);
    }

    public function tweetArray($query, $since_id) {
        
        //fucntion to get tweets from twetter API on the basis of query
        
        if ($since_id > 0) {

            $parameters = array('q' => $query, 'since_id' => $since_id, 'count' => 10);
        } else {

            $parameters = array('q' => $query, 'count' => 100);
        }

        $result = $this->twitter->get('search/tweets', $parameters);

        if ($this->twitter->getLastHttpCode() == 200) {

            $array = $result->statuses;
            
            if (is_array($array)) {
                
                include('../view/tweetsView.php');
            }
        }
    }

    public function collectTweets($table_name, $id) {
        //function to collectTweets from local database created from project TwitterDatabase
        $sql = "SELECT name FROM " . $table_name . " where id= " . $id;
        $selectedRestaurant = $this->connection->query($sql);
        $result = $selectedRestaurant->fetch(PDO::FETCH_ASSOC);
        $tweets = $this->tweetArray($result, 0);
        
        include('../view/tweetsView.php');
    }
         
    public function collectNames($table_name) {
        //function to collect restaurant names from local database

        $sql = "SELECT * FROM " . $table_name;
        $names = $this->connection->query($sql);
        return $names;
    }

}
