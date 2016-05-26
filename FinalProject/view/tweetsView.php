<?php

echo '<table border="1" width="100%">';
echo '<th>Name</th><th>Tweet Time</th><th>Tweet</th>';
//var_dump($tweets);
foreach ($array as $tweet) {

    //to print the tweets along with user id and time stamp in form of table
    echo '<tr><td>' . $tweet->user->screen_name . '</td><td>' . $tweet->created_at . '</td><td>' . $tweet->text . '</td></tr>';
}

echo '</table>';
