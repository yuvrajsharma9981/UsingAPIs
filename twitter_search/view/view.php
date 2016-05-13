<?php

echo '<table border="1" width="100%">';
echo '<th>Tweet Id</th><th>Tweet Time</th><th>Tweet</th>';

foreach ($arr as $tweet) {
    //to print the tweets along with user id and time stamp in form of table
    echo '<tr><td>' . $tweet->id_str . '</td><td>' . $tweet->created_at . '</td><td>' . $tweet->text . '</td></tr>';
}
echo '</table>';

