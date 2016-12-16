<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Oil Hauls Ticketing System - Retrieval by Location</title>
        <?php include 'nav_bar.php';?>
    </head>
    <body>
        <div>
        <form action="retrieval_loc_info.php" method="get">
        <?php
            $servername = "localhost";          
            $username = "root";                 
            $password = "rootpass";             
            $db = "cpsc471";                    

            $conn = new mysqli($servername, $username, $password, $db);

            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }

            //populate location selector
            echo 'Location: <select name="locationSelector"> <br>';
            $sql = "SELECT Name, Location_id FROM facilities";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row["Location_id"].'">'.$row["Name"].'</option>';
                }
            echo '</select>';
            }else{
             echo "no records retrieved";
            }
            echo '<input type="submit" value="Submit"></input>';
	    $conn-> close();            //close the connection to database
        ?>
        </form>
        </div>
    </body>
</html>

