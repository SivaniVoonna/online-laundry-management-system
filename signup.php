<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>Signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">WATIGA</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#login"><b>LOGIN</b></a></li>
        <li><a href="#about"><b>ABOUT</b></a></li>
        <li><a href="#services"><b>SERVICES</b></a></li>
        <li><a href="#contact"><b>CONTACT</b></a></li>
      </ul>
    </div>
  </div>
</nav>
</body>
</html>
<?php
$u=$_POST["u"];
$mob=$_POST["mob"];
$area=$_POST["area"];
$city=$_POST["city"];
$mail=$_POST["mail"];
$p1=$_POST["pass1"];
$conn=mysqli_connect("localhost","root","Pawan@2420","pawan");
if (mysqli_connect_errno())
{
echo"failed to connect to mysql:".mysqli_connect_errno();
header("refresh:3;url=signup.html");
}
else
{
mysqli_query($conn,"insert into signup(name,mobile,area,city,email,password)values ('$u','$mob','$area','$city','$mail','$p1')");
echo"<p style:'font-size:40px; text-align:center;'>REGISTRATION DONE<p>";
header("refresh:3;url=index.html");
}
?>
