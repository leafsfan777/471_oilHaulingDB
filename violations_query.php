<html>
        <head>
           <meta charset="UTF-8">
           <title>Oil Hauls Ticketing System - Sour Violations</title>
           <?php include 'violations.php';?>
        </head>
<body>
        <?php
           $servername = "localhost";         
           $username = "root";               
           $password = "rootpass";          
           $db = "cpsc471";               

           $conn = new mysqli($servername, $username, $password, $db);

           if($conn->connect_error){
              die("Connection failed".$conn->connect_error);
           }
		
		$result=NULL;
		$type=$_GET["violation_selector"];
		if($type=='none'){
			echo 'cannot retrieve, please select a type of violation';
		}else{
			if($type=='driver'){
$sql="SELECT t.Ticket_no, t.Weigh_in, t.Weigh_out, t.Date, t.Time, t.Product_Hauled, t.Hauling_Truck, t.Owned_by, t.Hauled_from, t.Hauled_to
      FROM tickets AS t, drivers AS d, trucks AS tr, driven as dr, lisence AS l, products AS p
      WHERE t.Hauling_Truck=tr.VIN AND tr.VIN=dr.VIN AND dr.Emp_Id=d.Emp_id AND d.Lisence=l.Type AND
	(l.Description='Non-Sour Lisence (in province)' AND t.Product_Hauled=p.Product_no AND BINARY p.Sour='1')";
				$result=$conn->query($sql);
			}elseif($type='truck'){
$sql="SELECT t.Ticket_no, t.Weigh_in, t.Weigh_out, t.Date, t.Time, t.Product_Hauled, t.Hauling_Truck, t.Owned_by, t.Hauled_from, t.Hauled_to
      FROM tickets AS t, trucks AS tr, products AS p
      WHERE t.Hauling_Truck=tr.VIN AND BINARY tr.Sour_hauler='0' AND t.Product_Hauled=p.Product_no AND p.Sour=1";
				$result=$conn->query($sql);
			}elseif($type='location'){
$sql="SELECT t.Ticket_no, t.Weigh_in, t.Weigh_out, t.Date, t.Time, t.Product_Hauled, t.Hauling_Truck, t.Owned_by, t.Hauled_from, t.Hauled_to
      FROM tickets AS t, facilities AS f, products AS p
      WHERE t.Hauled_to=f.Location_id AND BINARY f.Sour='1' AND t.Product_Hauled=p.Product_no AND p.Sour=1";
				$result=$conn->query($sql);
			}
		}
			if($result!=NULL && $result->num_rows >0){
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
		echo '</table>';
		}
		$conn->close();
?>
</body>
</html>
