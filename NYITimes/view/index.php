<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <body>

        <button onclick="myFunction()"><img id="myImg" src="click_button_red_md_wht.gif" width="500"     height="500"></button>

        <script>


            function myFunction()
            {
                document.getElementById("myImg").src = "giphy2.gif";

                setTimeout(continueExecution, 3250);
                //to call function continueExecution to change the image after ~3seconds
            }

            function continueExecution()
            {
                document.getElementById("myImg").style.display = 'none';
                setTimeout(continue2Execution, 50);
                //to call function continue2Execution after ~0.5 seconds
            }
            
            function continue2Execution()
            {
                location.href = "http://localhost/Info153_Labweek3/NYITimes/controller/controller.php";
                //to redirect to the page controller.php
            }


        </script>

    </body>
</html>