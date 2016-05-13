<?php

require "../../vendor/autoload.php";


use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterTest {

    private $twitter;
    private $CONSUMER_KEY;
    private $CONSUMER_SECRET;
    private $ACCESS_TOKEN;
    private $ACCESS_TOKEN_SECRET;
    
    public function __construct() {

        $this->CONSUMER_KEY = getenv('CONSUMER_KEY');
        $this->CONSUMER_SECRET = getenv('CONSUMER_SECRET');
        $this->ACCESS_TOKEN = getenv('ACCESS_TOKEN');
        $this->ACCESS_TOKEN_SECRET = getenv('ACCESS_TOKEN_SECRET');
       
        $this->twitter = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $this->ACCESS_TOKEN, $this->ACCESS_TOKEN_SECRET);
        //creating a class object for the TwitterOAuth Class
        
    }

    public function tweetArray($query, $since_id) {

        if ($since_id > 0) {

            $parameters = array('q' => $query, 'since_id' => $since_id, 'count' => 10);
        } else {

            $parameters = array('q' => $query, 'count' => 100);
        }

        $result = $this->twitter->get('search/tweets', $parameters);

        if ($this->twitter->getLastHttpCode() == 200) {

            $array = $result->statuses;

            if (is_array($array)) {
                return $array;
            }
        }
    }
}

