<?php
include 'partials/_dbconnect.php';
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Welcome-<?php 
  ?></title>
</head>

<body>

  <?php
  require 'partials/_nav.php';
  ?>

  <div class="container my-4">
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Welcome-<?php echo ucfirst($_SESSION['firstname'])." " .ucfirst( $_SESSION['middlename'])." ". ucfirst($_SESSION['lastname']) ?>!</h4>
      <p>You are logged in as <?php echo $_SESSION['username'];?></p>
      <hr>
      <!-- <p class="mb-0">Whenever you need to, be sure to logout <a href="logout.php">using this link</a> </p> -->
    </div>
    <h2>Personal Detail</h2>
    <?php
      echo "Name:-". ucfirst($_SESSION['firstname'])." " .ucfirst( $_SESSION['middlename'])." ". ucfirst($_SESSION['lastname'])."<br> Birth-Date:".$_SESSION['birth']."<br>";

    ?>

    <form action="/Php project/welcome.php" method="post">
      <div class="form-group col-md-6">
        <label for="cmpin">To check your current balance enter your mpin</label>
        <input type="password" class="form-control" id="cmpin" name="cmpin">
        <small id="emailHelp" class="form-text text-muted">Make sure that you enter <b> 6 </b>digit pin.</small>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>     
    
      <div class="form-group col-md-6">
        <label for="deposit">To deposit money in your account</label>
        <input type="number" class="form-control" id="deposit" name="deposit">
        <button type="submit" class="btn btn-primary my-2" name="button">Deposite</button>
      </div>
    
      <div class="form-group col-md-6">
        <label for="withdraw">To withdraw money from your account</label>
        <input type="number" class="form-control" id="withdraw" name="withdraw">
        <button type="submit" class="btn btn-primary my-2" name="drawbutton">Withdraw</button>
      </div>

      <div class="form-group col-md-6">
        <label for="reciever">Reciever Account</label>
        <input type="text" class="form-control" id="reciever" name="reciever">
        <label for="payment">To transfer money from your account</label>
        <input type="number" class="form-control" id="payment" name="payment">
        <button type="submit" class="btn btn-primary my-2" name="transferbutton">Transfer</button>
      </div>
    </form>
      
      
    <?php
      if (isset($_POST['submit'])){
        $cmpin=$_POST['cmpin'];
        if($_SESSION["mpinnumber"] == $cmpin){
          echo  $_SESSION["ibalance"];
        }
        else{
          echo"<b>wrong mpin</b>";
        }

      }
      if (isset($_POST['button'])){
        $deposit=(int)$_POST['deposit'];
        $tempbalance=(int)$_SESSION["ibalance"];
        $tempbalance = $tempbalance+$deposit;
        $tempname=$_SESSION['username'];
        $_SESSION["ibalance"]=$tempbalance;
        $sql="UPDATE `signup` SET `balance` = '$tempbalance' WHERE `username` = '$tempname'";
        $result=mysqli_query($conn,$sql);
        echo  $_SESSION["ibalance"];

        $sql="INSERT INTO `$tempname` (`transaction`, `date-time`) VALUES ('you deposite $deposit rupees in your bank account', current_timestamp())";
        $result=mysqli_query($conn,$sql);
      }

      if (isset($_POST['drawbutton'])){
        $draw=(int)$_POST['withdraw'];
        $tempbalance=(int)$_SESSION["ibalance"];
        $tempbalance = $tempbalance-$draw;
        $tempname=$_SESSION['username'];
        $_SESSION["ibalance"]=$tempbalance;
        $sql="UPDATE `signup` SET `balance` = '$tempbalance' WHERE `username` = '$tempname'";
        $result=mysqli_query($conn,$sql);
        echo  $_SESSION["ibalance"];

        $sql="INSERT INTO `$tempname` (`transaction`, `date-time`) VALUES ('you draw $draw rupees in your bank account', current_timestamp())";
        $result=mysqli_query($conn,$sql);
      }

      if(isset($_POST['transferbutton'])){
        $reciever_name=$_POST['reciever'];
        $payment=$_POST['payment'];
        $pay_name=$_SESSION['username'];

        $sql="SELECT * fROM `signup` WHERE `username`='$reciever_name' ";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num==0){
          echo "Such type of account name is not exsist";
        }
        else{
          $rows=[];
          $rows = $result->fetch_array(MYSQLI_ASSOC);
          
          $_SESSION['reciever_balance']=$rows['balance'];

          $r_balance=(int)$_SESSION["reciever_balance"]+$payment;
          $_SESSION["reciever_balance"]=$r_balance;
          
          $p_balance=(int)$_SESSION["ibalance"]-$payment;
          $_SESSION["ibalance"]=$p_balance;

          $sql="UPDATE `signup` SET `balance` = '$r_balance' WHERE `username` = '$reciever_name'";
          $result=mysqli_query($conn,$sql);
          $sql="UPDATE `signup` SET `balance` = '$p_balance' WHERE `username` = '$pay_name'";
          $result=mysqli_query($conn,$sql); 
          
          $sql="INSERT INTO `$reciever_name` (`transaction`, `date-time`) VALUES ('recieve $payment from $pay_name', current_timestamp())";
          $result=mysqli_query($conn,$sql);
          $sql="INSERT INTO `$pay_name` (`transaction`, `date-time`) VALUES ('give $payment to $reciever_name', current_timestamp())";
          $result=mysqli_query($conn,$sql);
        }

      }
    ?>
    
  </div>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>