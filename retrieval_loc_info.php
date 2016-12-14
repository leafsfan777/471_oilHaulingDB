<!DOCTYPE html>
<html>
        <head>
           <meta charset="UTF-8">
           <title>Hello</title>
           <?php include 'retrieval_location.php';?>
        </head>
<body>
        <?php
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

           $location=$_GET["locationSelector"];
        if($location=='none') {
             echo'Malformed query, must select a location';
           }else{
                $sql = "SELECT * FROM tickets WHERE Hauled_to=".$location;
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                   echo'check2';
                   echo'<table style="width:100%">';
                   echo'<tr>';
                   echo'<th>Ticket Number</th>';
                   echo'<th>Weigh in</th>';
                   echo'<th>Weigh out</th>';
                   echo'<th>Date</th>';
                   echo'<th>Time</th>';
                   echo'<th>Product Hauled</th>';
                   echo'<th>Hauling Truck</th>';
                   echo'<th>Owner</th>';
                   echo'<th>Hauled From</th>';
                   echo'<th>Hauled To</th>';
                   echo'</tr>';
                   while($row = mysqli_fetch_array($result)){
                        echo'<tr>';
                        echo'<td>'.$row["Ticket_no"].'</td>';
                        echo'<td>'.$row["Weigh_in"].'</td>';
                        echo'<td>'.$row["Weigh_out"].'</td>';
                        echo'<td>'.$row["Date"].'</td>';
                        echo'<td>'.$row["Time"].'</td>';
                        echo'<td>'.$row["Product_Hauled"].'</td>';
                        echo'<td>'.$row["Hauling_Truck"].'</td>';
                        echo'<td>'.$row["Owned_by"].'</td>';
                        echo'<td>'.$row["Hauled_from"].'</td>';
                        echo'<td>'.$row["Hauled_to"].'</td>';
                        echo'</tr>';
                   }
                	echo'</table>';
               	}
	    }
?>
</body>
</html>

