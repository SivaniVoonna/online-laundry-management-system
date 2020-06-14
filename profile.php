<?php
$conn=mysqli_connect("localhost","root","Pawan@2420","pawan");
$user=$_GET["user"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/e5bf6a6ceb.js" crossorigin="anonymous"></script>
  <script>
        window.history.forward();
  </script>
  <style>
      .profile{
        position: absolute;
        height: 530px;
        width: 350px;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        box-shadow: -3px 4px 30px 3px rgba(0,0,0, .5);
        text-align:center;
    }
    .prof-card{
        width:100%;
    }
    .iconic{
        color:#fff;
        position:relative;
        height:50%;
        width: 100%;
        padding: 20px;
    }
    .iconic img{
        height:150px;
        width:150px;
        border-radius: 40%;
    }
    .menu-item{
        padding: 20px;
        height: 50%;
        background-color: wheat;
    }
    .item{
        position: relative;
        display: flex;
        justify-content: space-between;
        border: 1px solid;
        padding: 10px 10px;
        padding-bottom: 3px;
        cursor: pointer;
        max-resolution: 2px;
    }
    .item #title{
        font-size: 20px;
    }
    .item #content{
        font-size: 20px;
    }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<nav class="navbar navbar-default navbar-fixed-top" style="background: wheat; box-shadow: -3px 4px 30px 3px rgba(0,0,0, .5);">
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
        <li><a href="cart.php?user=<?php echo "$user"; ?>"><b>EXIT-PROFILE</b></a></li>
      </ul>
    </div>
  </div>
  </nav>
<div class="profile" style="background: url('https://images.unsplash.com/photo-1590493965042-c37d4d6962be?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1052&q=80') no-repeat; background-size: 100% 100%;">
    <?php
    $result=mysqli_query($conn,"select * from signup where email='$user'");
    $c=mysqli_num_rows($result);
    if($c>0)
    {
      while($row=mysqli_fetch_assoc($result))
      {
        ?>
        <div class="prof-card">
            <div class="iconic">
                <img src="<?php echo 'data:image;base64,'.base64_encode($row['image']).''?>" alt="no_image">
                <div class="info">
                    <h3><?php echo $row["name"]; ?></h3>
                </div>
            </div>
            <div class="menu-item">
                <div class="item">
                    <div class="itam-area">
                        <p id="title">City:</p>
                    </div>
                    <p id="content"><?php echo $row["city"]; ?></p>
                </div>
                <div class="item">
                    <div class="itam-area">
                        <p id="title">Area:</p>
                    </div>
                    <p id="content"><?php echo $row["area"]; ?></p>
                </div>
                <div class="item">
                    <div class="itam-area">
                        <p id="title">Mobile No.:</p>
                    </div>
                    <p id="content"><?php echo $row["mobile"]; ?></p>
                </div>
                <div class="item">
                    <div class="itam-area">
                        <p id="title">E-mail:</p>
                    </div>
                    <p id="content"><?php echo $row["email"]; ?></p>
                </div>
            </div>
        </div>
        <?php
      }
    }
    ?>
</div>
<div class="transactions" style="padding-top:700px; padding-bottom:50px;">
<div class="container-fluid table-responsive" style=" background:wheat; padding-bottom:50px; box-shadow: -3px 4px 30px 3px rgba(0,0,0, .5);">
      <center><b><h3 style="padding-bottom:30px;">YOUR RECENT TRANSACTIONS</h3></b></center>
      <center><table class="table table-bordered table-striped" style="box-shadow: 4px 4px 30px 3px rgba(0,0,0, .5); border-radius:20px;">
        <tr style="background:black; color:white; font-size:15px;">
          <th space="col"> Item Id </th>
          <th space="col"> Item Name </th>
          <th space="col"> Laundry Type </th>
          <th space="col"> Price </th>
          <th space="col"> Quantity </th>
          <th space="col"> Total </th>
          <th space="col"> Date </th>
        </tr>
        <?php
        $result=mysqli_query($conn,"select * from order_details where user='$user'");
        $c=mysqli_num_rows($result);
        if($c==0){ ?>
            <tr align="center" style="background:white;">
                <td colspan="7">No Recent Transactions Yet !!!</td>
            </tr>
            <?php
        }
        if($c>0)
        {
          while($row=mysqli_fetch_assoc($result))
          {
            ?>
            <tr style="background:white;">
              <td><?php echo $row["item_id"]; ?></td>
              <td><?php echo $row["item_name"]; ?></td>
              <td><?php echo $row["laundry_type"]; ?></td>
              <td><?php echo $row["item_price"]; ?></td>
              <td><?php echo $row["item_quantity"]; ?></td>
              <td><?php echo $row["total"]; ?></td>
              <td><?php echo $row["date_time"]; ?></td>
            </tr>
            <?php
          }
        }
        ?>
      </table></center>
    </div>
</div>

</body>
</html>