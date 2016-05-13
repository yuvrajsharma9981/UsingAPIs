<?php

echo '<table border="1" width="100%">';
echo '<th>Tweeter Id</th><th>Tweet</th>';
foreach ($results as $result) {
    //to echo tweets in form of tables
    $text = $result->text;
    $screen_name = $result->screen_name;

    echo '<tr><td>' . $screen_name . '</td><td>' . $text . '</td></tr>';
}
echo '</table>';
