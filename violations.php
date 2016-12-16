<html>
        <head>
           <meta charset="UTF-8">
           <title>Oil Hauls Ticketing System - Sour Violations</title>
           <?php include 'nav_bar.php';?>
        </head>
<body>
        <?php
           $servername = "localhost";          //should be same for you
           $username = "root";                 //same here
           $password = "rootpass";             //your localhost root password
           $db = "cpsc471";                     //your database name

		echo '<form action="violations_query.php" method="get">';
		echo 'Type of Violation <select name="violation_selector">';
			echo '<option value="none">---SELECT---</option>';
			echo '<option value="driver">Driver</option>';
			echo '<option value="truck">Truck</option>.';
			echo '<option value="location">Location</option>';
		echo '</select>';
		echo '<input type="submit" value="Submit"';
	?>
</body>
</html>
