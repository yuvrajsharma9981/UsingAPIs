<?php

require('../model/NYTdatabase.php');
//to get NYTdatabase.php
//global $array;
$a = new NewYorkTimes(); //to create class object
$array = $a->collectTweets("twitter"); //calling function collectTweets

include('../view/view.php');//to transfer the control to view.php


