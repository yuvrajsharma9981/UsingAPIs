<?php

class NewYorkTimes {

    private $db_name;
    private $key;
    private $connection;
    private $MYSQL_USER;
    private $MYSQL_PASS;

    public function __construct() {
        //NYT API Connection
        $this->key = getenv('NYTIMES');
        
        //MySQL Connection
        $this->MYSQL_USER = getenv('MYSQL_USER');
        $this->MYSQL_PASS = getenv('MYSQL_PASS');
        $this->db_name = "nsf";
        
        $dsn = 'mysql:host=localhost;dbname=' . $this->db_name;
        $this->connection = new PDO($dsn, $this->MYSQL_USER, $this->MYSQL_PASS);
    }

    public function get($query) {
        //function to query the NYT API and get results back
        
        $url = 'http://api.nytimes.com/svc/search/v2/articlesearch.json?q='
                . urlencode($query)
                . '&page=2&sort=oldest&api-key='
                . $this->key;
        //echo $url. "<br/>";
        $result = json_decode(file_get_contents($url));
        $array = $result->response->docs;
        
        return $array; //return the array with the articles to wordCount function
    }

    public function collectTweets($table_name) {
        //function to collectTweets from local database created from project TwitterDatabase
        
        $sql = "SELECT text FROM " . $table_name . " limit 1000";
        $tweets = $this->connection->query($sql);
        $array = $this->wordCount($tweets);
        return $array; //return the array with the articles to controller.php
    }

    public function wordCount($tweets) {
        //function to get the count of top three most used words and send them as query to get function above
        
        $wordlist = array();
        foreach ($tweets as $tweet) {
            $text = $tweet['text'];
            
            $words = explode(' ', $text); //break the whole tweet at spaces
            foreach ($words as $word) {
                $wordLength = strlen($word);
                if ($wordLength >= 4) { 
                    //if word is relevant i.e.greater than 4 or more length it is kept and count is increaded else that word is dumped
                    if (isset($wordlist[$word])) {
                        $wordlist[$word] ++;
                    } else {
                        $wordlist[$word] = 1;
                    }
                } else {
                    //do nothing here
                }
            }
        }

        arsort($wordlist); //to sort the array in ascending order
       
        $temp = array();
        $counter = 0;
        foreach($wordlist as $key=>$value){
        if($counter > 3){
            //to make sure loop does not run more than three times
            break;
        }
        $counter++;
        $temp[] = $key;
        }
        $array = $this->get(implode("+", $temp)); //calling function get
        return $array; //return the array with the articles to collectTweets function
    }
    
}


