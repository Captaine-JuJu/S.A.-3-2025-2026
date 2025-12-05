<?php
print_r($_POST);
$connect = mysqli_connect("localhost","root","azerty","users");
$db = mysqli_select_db($connect, "users");
if(isset($_POST["nom"]){
   // echo "bonjour";
}
