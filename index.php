<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello</title>
        <?php include 'nav_bar.php';?>
    </head>
    <body>
	<div>
	<form action="retrieval_info.php" method="get">
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

            //populate company selector
            echo 'Company: <select name="companySelector"> <br>';
            $sql = "SELECT Name FROM company";
            $result = $conn->query($sql);       //execute the query
            if($result->num_rows > 0){           //check if query results in more than 0 rows
                echo '<option value="none" selected="selected">---SELECT---</option>';                
                while($row = mysqli_fetch_array($result)){   //loop until all rows in result are fetched
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
	    echo '</select>';
            }else{
             echo "no records retrieved";
	    }
	    $conn-> close();            //close the connection to database
             
	    //company as selector
    	    echo' as: <select name="companyAs"><br>';
            echo'<option value="none">---SELECT---</option>';
	    echo'<option value="owner">Owner</option>';
	    echo'<option value="hauler">Hauler</option>';
	    echo'</select>';
            echo'<input type="submit" value="Submit">';
            
	    
	    

	?>
	</form>
	</div>    
    </body>
</html>
