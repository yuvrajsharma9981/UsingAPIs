<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="controller.php" method="get">
            Query: <input type="text" name="query" /> <br/>
            Since Id: <input type="text" name="sinceId" /> <br/>
            <input type="submit" value="Submit" />

            <?php
            require '../model/main.php';

            $twitter = new TwitterTest();
            //creating a class object
            
            $query = $_GET['query'];
            $since_id = $_GET['sinceId'];
            $arr = $twitter->testSearch($query, $since_id);
            //calling function testSearch to get tweets from the twitter API and storing it in $arr
            if (is_array($arr)) {
                //to check if its an array or not
                include('../view/view.php');
            }
            ?>
        </form>
    </body>
</html>




