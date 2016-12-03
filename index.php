<!DOCTYPE html>
<!--
Manmeet Dhaliwal
471 Sample project to show connection to local database
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello</title>
    </head>
    <body>
        <h1>Demo for 471</h1>
        <?php
            // put your code here
            $servername = "localhost";          //should be same for you
            $username = "root";                 //same here
            $password = "rootpass";             //your localhost root password
            $db = "cpsc471";                     //your database name
            
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }else{
                echo "Connected<br>";
            }
            
            //sql query
            $sql = "SELECT * FROM tickets";
            echo "<br><br>Printing ticket numbers in the (tickets) table in the (ticket number) column:<br>";
            $result = $conn->query($sql);       //execute the query
            
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo "query successful";                
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo "Ticket_no: ".$row["Ticket_no"]."<br>"; //here we are looking at one row, and printing the value in "names" column
                }
            }else{
             echo "no records retrieved";
}
            
            $conn-> close();            //close the connection to database
        ?>
    </body>
</html>
