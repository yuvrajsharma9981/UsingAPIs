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
        <form action="../controller/controller.php" method="get">
            Query: <input type="text" name="query" /> <br/>
            <!-- to take the query from user and send it to controller.php-->
            Since Id: <input type="text" name="sinceId" /> <br/>
            <!-- to take the Since Id from user and send it to controller.php-->
            <input type="submit" value="Submit" />            
        </form>
    </body>
</html>
