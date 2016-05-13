<?php

require '../model/database.php';


$database = new Database("nsf");

if (empty($_GET)) {
    //to collect tweets from API before, runs on the backend, before the webpage is even shown to the user
    $twitter = new TwitterTest();
    $query = "Election";
    $since_id = "0";
    $counter = 0;
    while ($counter < 7200) {
        $arrtweet = $twitter->tweetArray($query, $since_id);
        $database->insertTweets("twitter", $arrtweet);
        sleep(5);
        $counter++;
    }
} else if (!empty($_GET)) {
    //runs when user select one of the three choices, query according to it to the local database created above
    $query_word = $_GET["query_word"];
    if ($query_word == "Trump") {
        $results = $database->retrieveTweets("twitter", $query_word);
    } else if ($query_word == "Bernie") {
        $results = $database->retrieveTweets("twitter", $query_word);
    } else if ($query_word == "Clinton") {
        $results = $database->retrieveTweets("twitter", $query_word);
    }
    include('../View/view.php');
}


