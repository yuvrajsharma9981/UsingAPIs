<?php

require ('../model/twitter.php');
require ('../model/database.php');



//to get the queries from index.html
if (!empty($_GET['term'])) {
    $term = $_GET['term'];
    $location = $_GET['location'];
    $yelp = new Yelp();
    $searchResults = $yelp->query_api($term, $location);
    include('../view/firstview.php');
}

//execute when someone click on CLICK HERE button to get the tweets
if (!empty($_GET['name'])) {
    $collect = new Collect();
    $name = $_GET['name'];
    
    $collect->tweetArray($name, 0);
}

//execute when someone click on SAVE button to store the restaurant name and rating
if (!empty($_GET['rname'])) {
    $rname = $_GET['rname'];

    $rating = $_GET['rating'];
    echo $term;
    $database = new Database('nsf');
    $database->insertNames('yelpdatabase', $rname, $rating);
}

//execute when someone clicked on the SAVED ONES button on the home page
if (!empty($_GET['saved'])) {
    $collect = new Collect();
    $names = $collect->collectNames('yelpdatabase');
    include('../view/firstview.php');
} 