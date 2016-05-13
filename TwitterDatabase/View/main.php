<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>
        <title>Find the Tweets</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <button id="Trump" class="float-left submit-button" >Tweets on Trump!</button>
        <button id="Clinton" class="float-left submit-button" >Tweets on Clinton!</button>
        <button id="Bernie" class="float-left submit-button" >Tweets on Bernie!</button>


        <script type="text/javascript">
            //to call the right page depending upon the click
            document.getElementById("Trump").onclick = function () {
                location.href = "http://localhost/Info153_Labweek3/TwitterDatabase/Controller/controller.php?query_word=Trump";
            };
    
            document.getElementById("Clinton").onclick = function () {
                location.href = "http://localhost/Info153_Labweek3/TwitterDatabase/Controller/controller.php?query_word=Clinton";
            };
    
            document.getElementById("Bernie").onclick = function () {
                location.href = "http://localhost/Info153_Labweek3/TwitterDatabase/Controller/controller.php?query_word=Bernie";
            };
        </script>


    </body>
</html>


