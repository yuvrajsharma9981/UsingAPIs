<?php


if (!empty($searchResults)) {
    
    //if the results are coming from Yelp API
    
    echo '<table border="1" width="100%">';
    echo '<th>Name</th><th>Yelp Ratings</th><th>Latest Tweets</th><th>Save It For Later</th>';
    foreach ($searchResults as $result) {
        //to print the restaurant names along with their ratings

        $restaurant = $result->name;
        $rating = $result->rating;
        echo '<tr><td>' . $restaurant . '</td><td align="center">' . $rating . "/5 </td> <td align='center'><a href='../controller/controller.php?name=$restaurant'>Click Here!</a></td> <td align='center'><a href='../controller/controller.php?rname=$restaurant&rating=$rating'>Save</a></td></tr>";
    }

    echo '</table>';
}else{
    
    //if the results are coming from Yelp API
    
    echo '<table border="1" width="100%">';
    echo '<th>Serial Number</th><th>Name</th><th>Yelp Ratings</th><th>Latest Tweets</th>';
    foreach ($names as $result) {
        //to print the restaurant names along with their ratings
        $id = $result['id'];
        $restaurant = $result['name'];
        $rating = $result['rating'];
        echo '<tr><td align="center">' . $id . '</td><td align="center">' . $restaurant . '</td><td align="center">' . $rating . "/5 </td> <td align='center'><a href='../controller/controller.php?name=$restaurant'>Click Here!</a></td></tr>";
    }

    echo '</table>';
}