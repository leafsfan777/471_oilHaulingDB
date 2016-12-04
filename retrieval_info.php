<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
           <title>Hello</title>
	   <?php include 'index.php';?>
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
	   
	   $company=$_GET["companySelector"];
	   $companyAs=$_GET["companyAs"];
	echo $company;
	echo $companyAs;	   
	if($company!='none' and $companyAs=='none') {
	     echo'Malformed query, must select whether you want tickets with company as owner or as hauler'; 	   
	   }else{
            if ($companyAs == 'owner'){
		$sql = "SELECT * FROM tickets WHERE Owned_by=(SELECT Company_id FROM company WHERE Name='".$company."')";
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
		}}
             elseif($companyAs=='hauler'){
		echo 'check hauler<br>';		
		$sql = "SELECT Ticket_no, Weigh_in, Weigh_out, Date, Time, Product_Hauled, Hauling_Truck, tickets.Owned_by, Hauled_from, Hauled_to 
                        FROM tickets, trucks
                        WHERE tickets.Hauling_Truck=trucks.VIN AND
                              trucks.Owned_by=(SELECT Company_id FROM company WHERE Name='".$company."')";
                echo $sql;
		$result = $conn->query($sql);
                if($result->num_rows > 0){
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
	   }}

?>
</body>
</html>
