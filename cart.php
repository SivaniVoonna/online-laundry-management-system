<?php
session_start();
$time = date('d-m-y');
$conn=mysqli_connect("localhost","root","Pawan@2420","pawan");
$user=$_GET["user"];
if(isset($_POST["add_to_cart"])){
  if(isset($_SESSION["shopping_cart"])){
    $item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
    if(!in_array($_GET["id"],$item_array_id)){
      $count = count($_SESSION["shopping_cart"]);
      $item_array=array(
        'item_id' => $_GET["id"],
        'item_name' => $_POST["hidden_name"],
        'laundry_type' => $_POST["type"],
        'item_quantity' => $_POST["quantity"]
      );
      if($_POST["type"] == "Dry Cleaning"){
        $item_array['item_price'] = $_POST["hidden_price1"];
      }
      elseif($_POST["type"] == "Normal Laundry"){
        $item_array['item_price'] = $_POST["hidden_price2"];
      }
      elseif($_POST["type"] == "Wash & Iron"){
        $item_array['item_price'] = $_POST["hidden_price3"];
      }
      $_SESSION["shopping_cart"][$count] = $item_array;  
      echo '<script>alert("Item Added")</script)';
      header("refresh:0;url=cart.php?user=$user");
      foreach($_SESSION["shopping_cart"] as $keys => $values){
        $item_id=$values["item_id"];
        $item_name=$values["item_name"];
        $laundry_type=$values["laundry_type"];
        $item_quantity=$values["item_quantity"];
        $item_price=$values["item_price"];
        $total_price = $values["item_price"] * $values["item_quantity"];
        global $time;
        $time = date('d-m-y');
        $result=mysqli_query($conn,"select * from order_details where (user='$user' and item_id='$item_id' and date_time='$time')");
        $c=mysqli_num_rows($result);
        if($c==0){
        mysqli_query($conn,"insert into order_details(user,item_id,item_name,laundry_type,item_quantity,item_price,total,date_time) values('$user',$item_id,'$item_name','$laundry_type',$item_quantity,$item_price,$total_price,'$time')");
      }
      else{
        mysqli_query($conn,"update order_details set laundry_type='$laundry_type',item_quantity=$item_quantity,item_price=$item_price,total=$total_price where (user='$user' and item_id=$item_id and date_time='$time')");
      }
      }
    }
    else{
      echo '<script>alert("Item Already Added")</script)';
      header("refresh:0;url=cart.php?user=$user");
    }
  }
  else{
    $item_array = array(
      'item_id' => $_GET["id"],
      'item_name' => $_POST["hidden_name"],
      'laundry_type' => $_POST["type"],
      'item_quantity' => $_POST["quantity"]
    );
    if($_POST["type"] == "Dry Cleaning"){
      $item_array['item_price'] = $_POST["hidden_price1"];
    }
    elseif($_POST["type"] == "Normal Laundry"){
      $item_array['item_price'] = $_POST["hidden_price2"];
    }
    elseif($_POST["type"] == "Wash & Iron"){
      $item_array['item_price'] = $_POST["hidden_price3"];
    }
    $_SESSION["shopping_cart"][0] = $item_array;
  }
}
if(isset($_GET["action"])){
  if($_GET["action"] == "delete"){
    foreach($_SESSION["shopping_cart"] as $keys => $values){
      if($values["item_id"] == $_GET["id"]){
        $id=$_GET["id"];
        unset($_SESSION["shopping_cart"][$keys]);
        mysqli_query($conn,"delete from order_details where user='$user'and item_id=$id and date_time='$time'");
        echo '<script>window.alert("Item Removed")</script>';
        header("refresh:0;url=cart.php?user=$user");
      }
    }
  }
}
$total =0;
if(isset($_POST["checkout"])){
  if(isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])){
    echo '<script>alert("Proceed to checkout??")</script>';
    foreach($_SESSION["shopping_cart"] as $keys => $values){
      global $total;
      $total = $total + ($values["item_price"] * $values["item_quantity"]);
      
    }
    header("refresh:0;url=checkout.php?total=$total");
  }
  else{
    echo '<script>alert("Cart Empty")</script>';
    header("refresh:0;url=cart.php?user=$user");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>WATIGA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/e5bf6a6ceb.js" crossorigin="anonymous"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top"  style="background: wheat; box-shadow: -3px 4px 30px 3px rgba(0,0,0, .5)">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.html#myPage">WATIGA</a>
    </div>
    <div class="collapse navbar-collapse text-center" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php?user=<?php echo "$user"; ?>"><b>PROFILE</b></a></li>
        <li><a href="index.html#"><b>LOGOUT</b></a></li>
      </ul>
    </div>
  </div>
  </nav>
<div class="cart"  style="background: url('https://images.unsplash.com/photo-1590493965042-c37d4d6962be?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1052&q=80') no-repeat; background-size: 100% 100%;"><br><br>
<div class="container">
    <h3 align="center">Select items for Laundry</h3>
    <?php
    $result=mysqli_query($conn,"select * from price");
    $c=mysqli_num_rows($result);
    if($c>0)
    {
      while($row=mysqli_fetch_assoc($result))
      {
        ?>
        <div class="col-md-6 col-lg-3 col-sm-12 col-xs-12 mb-5">
          <form action="cart.php?action=add&user=<?php echo "$user"; ?>&id=<?php echo $row["id"];?>" method="post">
            <div style="border:1px solid #333; background:#f1f1f1; border-radius:30px; padding-top:15px; padding-bottom:15px;">
              <center><img src="<?php echo 'data:image;base64,'.base64_encode($row['image']).''?>" alt="no_image" class="img-responsive" style="height:150px; width:150px;"/></center>
              <h4 align="center" class="text-info"><?php echo $row["Garments"];?></h4>
              <h4 align="center" class="text-danger"><?php echo "Dry Cleaning: Rs.".$row['Dry Cleaning']."" ;?></h4>
              <h4 align="center" class="text-danger"><?php echo "Normal Laundry: Rs.".$row['Normal Laundry']."" ;?></h4>
              <h4 align="center" class="text-danger"><?php echo "Wash & Iron: Rs.".$row['Wash & Iron']."" ;?></h4>
              <center><input type="text" name="quantity" class="form-control" value="0" style="width:100px; text-align:center; margin-bottom:10px" required/></center>
              <center><div><select name="type" id="tpye"><option value="Dry Cleaning">Dry Cleaning</option><option value="Normal Laundry">Normal Laundry</option><option value="Wash & Iron">Wash & Iron</option> </select></div></center>
              <input type="hidden" name="hidden_name" value="<?php echo $row["Garments"]; ?>">
              <input type="hidden" name="hidden_price1" value="<?php echo $row["Dry Cleaning"]; ?>">
              <input type="hidden" name="hidden_price2" value="<?php echo $row["Normal Laundry"]; ?>">
              <input type="hidden" name="hidden_price3" value="<?php echo $row["Wash & Iron"]; ?>">
              <center><input type="submit" name="add_to_cart" style="margin-top:10px;" class="btn btn-success" value="Add to Cart"></center>
            </div>
          </form>
        </div>
        <?php
      }
    }
    ?>
    </div>
    </div>
    <div class="cart2" style="padding-top:20px;">
    <h3 align="center">Order Details</h3>
    <h5 align="center">Comfirm your cart before clicking "CHECKOUT"</h5>
    <div class="container table-responsive" style="padding-bottom:50px;">
      <center><table class="table table-bordered table-striped" style="box-shadow: 4px 4px 30px 3px rgba(0,0,0, .5); border-radius:20px;">
        <tr style="background:black; color:white; font-size:15px;">
          <th space="col"> Item Name </th>
          <th space="col"> Laundry Type </th>
          <th space="col"> Price </th>
          <th space="col"> Quantity </th>
          <th space="col"> Total </th>
          <th space="col"> Action </th>
        </tr>
        <?php
        if(!empty($_SESSION["shopping_cart"])){
          foreach($_SESSION["shopping_cart"] as $keys => $values){
            ?>
            <tr style="background:white;">
              <td><?php echo $values["item_name"]; ?></td>
              <td><?php echo $values["laundry_type"]; ?></td>
              <td><?php echo $values["item_price"]; ?></td>
              <td><?php echo $values["item_quantity"]; ?></td>
              <td>Rs. <?php echo number_format($values["item_price"] * $values["item_quantity"] , 2); ?></td>
              <td><a href="cart.php?action=delete&user=<?php echo "$user"; ?>&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a></td>
            </tr>
            <?php
            global $total;
            $total = $total + ($values["item_price"] * $values["item_quantity"]);
          }
          ?>
          <tr>
            <td colspan="4" align="right">Total</td>
            <td align="right">Rs. <?php echo number_format($total,2); ?></td>
          </tr>
          <?php
        }
        ?>
      </table></center>
    </div>
    <div class="checkout">
      <form action="cart.php?user=<?php echo "$user"; ?>" method="post">
      <center><input type="submit" name="checkout" style="margin-top:10px; margin-bottom:20px;" class="btn btn-success" value="CHECKOUT"></center>
    </div>
    </div>
<div class="hide" id="profile_sec">
  <h1>Hello</h1>
</div>

</body>
</html>