<!DOCTYPE html>
<html>
<head>
<style>
body {margin:0;}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li a {
  display: inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 17px;
}

ul.topnav li a:hover {background-color: #555;}

ul.topnav li.icon {display: none;}

@media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
}

@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }
}
</style>
</head>
<body>

<ul class="topnav" id="myTopnav">
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="retrieval_comp.php">Retrieval By Company</a></li>
  <li><a href="ticket_insertion.php">Create New Ticket</a></li>
  <li><a href="ticket_modification.php">Modify Tickets</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="user_directions.php">How to Use</a></li>
  <li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
  </li>
</ul>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

</body>
</html>

