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

<ul class="topnav" id="topNavBar">
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="user_directions.php">About</a></li>
  <li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="responsive_nav_bar_toggle()">=</a>
  </li>
</ul>

<div style="padding-left:16px">
  <h2>Responsive Topnav Example</h2>
  <p>Resize the browser window to see how it works.</p>
</div>

<script>
function responsive_nav_bar_toggle() {
    var navBar = document.getElementById("topNavBar");
    if (navBar.className === "topnav") {
        navBar.className += " responsive";
    } else {
        navBar.className = "topnav";
    }
}
</script>

<?php
//Create connection
$con=mysqli_connect("localhost", "root", "rootpass", 

</body>
</html>

