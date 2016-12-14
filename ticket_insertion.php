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
	    width:100px;
	    margin:2px 0 20px 10px;
	}
	</style>        
	
	<div id="stylized">
        <form name="insert_form" method="post" action="ticket_insertion.php">
		Weigh In: <input type="text" name ="Weigh_in" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
		Weigh Out: <input type="text" name ="Weigh_out" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
		Date: <input type="date" name ="date"></input>
		Time: <input type="time" name ="time"></input>
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
				
            echo 'Product Hauled: <select name="product_hauled_selector"> <br>';
            $sql = "SELECT Description, Product_no FROM products";
            $result = $conn->query($sql);											//execute the query
            if($result->num_rows > 0){												//check if query results in more than 0 rows
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
			     
			echo'<input type="submit" value="Submit">';
			
			$weigh_in = $_POST["Weigh_in"];
			$weigh_out = $_POST["Weigh_out"];
			$date = $_POST["date"];
			$time = $_POST["time"];
			$company=$_POST["companySelector"];
			$truck = $_POST["hauling_truck_selector"];
			$hauled_from=$_POST["hauled_from_selector"];
			$hauled_to=$_POST["hauled_to_selector"];
			$product = $_POST["product_hauled_selector"]; 

			$sql= "INSERT INTO tickets
				(Weigh_in, Weigh_out, Date, Time, Product_Hauled, Hauling_Truck, Owned_by, Hauled_from, Hauled_to)
				VALUES
				('".$weigh_in."', '".$weigh_out."', '".$date."', '".$time."','".$product."', '".$truck."', '".$company."', '".$hauled_from."', '".$hauled_to."')";       
			
			echo $sql;
			$result = $conn->query($sql);



			$conn->close();

?>
</form>
</div>
</body>
</html>
