<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello</title>
        <?php include 'nav_bar.php';?>
    </head>
    <body>
        <style>
            #stylized input{
            display: block;
            font-size:11px;
            padding:4px 2px;
            border:solid 1px #aacfe4;
            width:70px;
            margin:2px 0 20px 10px;
        }
        </style>
<div id="stylized">
	<?php
		 	$ok_to_modify=FALSE; 
			$no_value="none";
			$ticket_no = $_POST['Ticket_no_selector'];
			$weigh_in = $_POST['weigh_in_selector'];
			$weigh_out = $_POST['weigh_out_selector'];
			$date = $_POST['date_selector'];
			$time = $_POST['time_selector'];
			$product_hauled = $_POST['product_hauled_selctor'];
			$hauling_truck = $_POST['hauling_truck_selector'];
			$owned_by = $_POST['companySelector'];
			$hauled_from = $_POST['hauled_from_selector'];
			$hauled_to = $_POST['hauled_to_selector'];

			echo $ticket_no." ".$weigh_in." ".$weigh_out." ".$date." ".$time." ".$product_hauled." ".$hauling_truck." ".$owned_by." ".$hauled_from." ".$hauled_to;
			
		if($ticket_no==$no_value) {
			echo 'You must select a ticket to modify';
			$ok_to_modify=TRUE;
		}			
			if($weigh_in==$no_value) {
				$weigh_in=NULL;
			}elseif($weigh_in!=NULL){
				if(is_int($weigh_in)){
					$weigh_in = (int) $weigh_in;
					$ok_to_modify=TRUE;
				}else{
					echo 'weigh in value must be an integer';
					$ok_to_modify=FALSE;
				}
			}
			if($weigh_out==$no_value) {
                                $weigh_out=NULL;
                        }elseif($weigh_out!=NULL){
                                if(is_int($weigh_out)){
					$weigh_out = (int) $weigh_out;
					$ok_to_modify=TRUE;
				}else{
					echo 'weigh in value must be an integer';
					$ok_to_modify=FALSE;
				}
                        }
			
	?>
        <h3>To modify a ticket, first choose the ticket number you wish to modify. Then choose the value for each field you wish to modify. If you leave a field blank it will be left as it was.</h3>
	<form name="insert_form" action="" method="post">
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
            echo 'Ticket to Modify: <select name="Ticket_no_selector"> <br>';
            $sql = "SELECT Ticket_no FROM tickets";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
            }
	    echo '</select><br>';
            
echo 'Weigh In: <input type="text" name="weigh_in_selector" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input>';
echo 'Weigh Out: <input type="text" name="weigh_out_selector" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input>';
echo 'Date: <input type="date" name="date_selector"></input>';
echo 'Time: <input type="time" name="time_selector"></input>';

	    echo 'Product Hauled: <select name="product_hauled_selctor"> <br>';
            $sql = "SELECT Description, Product_no FROM products";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row["Product_no"].'">'.$row["Description"].'</option>';
                }
            }
            echo '</select><br>';

            echo 'Hauling Truck: <select name="hauling_truck_selector"> <br>';
            $sql = "SELECT VIN FROM trucks";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
            }
            echo '</select><br>';

            echo 'Owned By: <select name="companySelector"> <br>';
            $sql = "SELECT Name, Company_id FROM company";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row["Company_id"].'">'.$row["Name"].'</option>';
                }
            }
            echo '</select><br>';

            echo 'Hauled From: <select name="hauled_from_selector"> <br>';
            $sql = "SELECT Location_id, Name FROM facilities";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row["Location_id"].'">'.$row["Name"].'</option>';
                }
            }
            echo '</select><br>';

            echo 'Hauled To: <select name="hauled_to_selector"> <br>';
            $sql = "SELECT Location_id, Name FROM facilities";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row["Location_id"].'">'.$row["Name"].'</option>';
                }
            }
            echo '</select><br>';
	    echo '<input type="submit" name="submit" value="Update"></input>';
?>
</form>
</div>
</body>
</html>
