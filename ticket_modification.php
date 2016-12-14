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
			echo '<br>You must select a ticket to modify<br>';
			$ok_to_modify=FALSE;
		}elseif($ticket_no!=NULL){$ok_to_modify=true;}			
		if($weigh_in==$no_value && $ok_to_modify) {
			$weigh_in=NULL;
			$ok_to_modify=TRUE;
		}elseif($weigh_in!=NULL && $ok_to_modify){
			if(is_numeric($weigh_in)){
				$weigh_in = (int) $weigh_in;
				$ok_to_modify=TRUE;
			}else{
				echo '<br>weigh in value must be an integer<br>';
				$ok_to_modify=FALSE;
			}
		}
		if($weigh_out==$no_value && $ok_to_modify) {
                        $weigh_out=NULL;
			$ok_to_modify=TRUE;
                }elseif($weigh_out!=NULL && $ok_to_modify){
                        if(is_numeric($weigh_out)){
				$weigh_out = (int) $weigh_out;
				$ok_to_modify=TRUE;
			}else{
				echo '<br>weigh out value must be an integer<br>';
				$ok_to_modify=FALSE;
			}
                }
		if($date==$no_value && $ok_to_modify) {
        	        $date=NULL;
			$ok_to_modify = true;
                }elseif($date!=NULL && $ok_to_modify){
				echo "check";
				$dateParsed = DateTime::createFromFormat('Y-m-d', $date);
				echo "successful";
				$ok_to_modify=TRUE;
			if($dateParsed == null){
                                echo '<br>date must be a valid date in format yyyy-mm-dd<br>';
                                $ok_to_modify=FALSE;
        		}
                }
		echo "test";
                if($time==$no_value && $ok_to_modify) {
                        echo "check2";
			$time=NULL;
                        $ok_to_modify = true;
                }elseif($time!=NULL && $ok_to_modify){
                        if(strtotime($time)==true){
                               $ok_to_modify=TRUE;
                        }else{
                               echo '<br>time must be a valid time<br>';
                               $ok_to_modify=FALSE;
                        }
                }
                if($product_hauled==$no_value && $ok_to_modify) {
                       $product_hauled=NULL;
                       $ok_to_modify = true;
                }
                if($hauling_truck==$no_value && $ok_to_modify) {
                        $hauling_truck=NULL;
                        $ok_to_modify = true;
                }
                if($owned_by==$no_value && $ok_to_modify) {
                        $owned_by=NULL;
                        $ok_to_modify = true;
                }
                if($hauled_from==$no_value && $ok_to_modify) {
                        $hauled_from=NULL;
                        $ok_to_modify = true;
                }
                if($hauled_to==$no_value && $ok_to_modify) {
                        $hauled_to=NULL;
                        $ok_to_modify = true;
                }
		if($ok_to_modify){
			echo 'true';
			modify_tickets($ticket_no, $weigh_in, $weigh_out, $date, $time, $product_hauled, $hauling_truck, $owned_by, $hauled_from, $hauled_to);	
		}else{echo 'false';}
		
		function modify_tickets($ticket_no, $weigh_in, $weigh_out, $date, $time, $product_hauled, $hauling_truck, $owned_by, $hauled_from, $hauled_to) {
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
			
			if($weigh_in!=NULL){
				$sql_weigh_in = 'UPDATE tickets
					 	 SET Weigh_in='.$weigh_in.'
						 WHERE Ticket_no='.$ticket_no;
				$conn->query($sql_weigh_in);
			}
                        if($weigh_out!=NULL){
                                $sql_weigh_out = 'UPDATE tickets
                                                  SET Weigh_out='.$weigh_out.'
                                                  WHERE Ticket_no='.$ticket_no;
				$conn->query($sql_weigh_out);
                        }
                        if($date!=NULL){
                                $sql_date = "UPDATE tickets
                                             SET Date='".$date."'
                                             WHERE Ticket_no=".$ticket_no;
				$conn->query($sql_date);
                        }
                        if($time!=NULL){
                                $sql_time = "UPDATE tickets
                                                 SET Time='".$time."'
                                                 WHERE Ticket_no=".$ticket_no;
				$conn->query($sql_time);
                        }
                        if($product_hauled!=NULL){
                                $sql_product_hauled = 'UPDATE tickets
                                                 SET Product_Hauled='.$product_hauled.'
                                                 WHERE Ticket_no='.$ticket_no;
				$conn->query($sql_product_hauled);
                        }
                        if($hauling_truck!=NULL){                                
				$sql_hauling_truck = 'UPDATE tickets
                                                 SET Hauling_Truck='.$hauling_truck.'
                                                 WHERE Ticket_no='.$ticket_no;
                        	$conn->query($sql_hauling_truck);
			}
                        if($owned_by!=NULL){
                                $sql_owned_by = 'UPDATE tickets
                                                 SET Owned_by='.$owned_by.'
                                                 WHERE Ticket_no='.$ticket_no;
				$conn->query($sql_owned_by);
                        }
                        if($hauled_from!=NULL){
                                $sql_hauled_from = 'UPDATE tickets
                                                 SET Hauled_from='.$hauled_from.'
                                                 WHERE Ticket_no='.$ticket_no;
                        	$conn->query($sql_hauled_from);
			}
                        if($hauled_to!=NULL){
                                $sql_hauled_to = 'UPDATE tickets
                                                 SET Hauled_to='.$hauled_to.'
                                                 WHERE Ticket_no='.$ticket_no;
				$conn->query($sql_hauled_to);
                        }

			$conn->close();
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
echo 'Date: <input type="text" name="date_selector"></input>';
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
	    $conn->close();?>
</form>
</div>
</body>
</html>
