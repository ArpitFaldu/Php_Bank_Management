<?php
    $showAlert=false;
    $showError=false;
    $Error=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'partials/_dbconnect.php';
        $username=$_POST["username"];
        $password=$_POST["password"];
        $cpassword=$_POST["cpassword"];
        $birthdate=$_POST["birth"];
        $mpin=$_POST["mpin"];
        $fname=$_POST["fname"];
        $mname=$_POST["mname"];
        $lname=$_POST["lname"];
        $phone=$_POST["phone"];
        $balance=$_POST["balance"];

        // $exists=false;
        $existSql="SELECT * FROM `signup` WHERE username='$username'";
        $result=mysqli_query($conn,$existSql);
        $numExistRows=mysqli_num_rows($result); 
        if($numExistRows>0){
            // $exists=true;
            $showError="<b>Username already exists</b>.";
        }
        else{
            if (strlen($_POST["password"]) <= '8') {
                $showError = "Your Password Must Contain At Least 8 Characters!";
                $Error=true;
            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                $showError = "Your Password Must Contain At Least 1 Number!";
                $Error=true;
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                $showError = "Your Password Must Contain At Least 1 Capital Letter!";
                $Error=true;
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                $showError = "Your Password Must Contain At Least 1 Lowercase Letter!";
                $Error=true;
            } 
            
            // $exists=false;
            // check password whether same or not 
            if(($password==$cpassword) && $Error==false){

                // Check birthdate for eligible or not 
                $today = date("Y-m-d");
                $age = date_diff(date_create($birthdate), date_create($today));
                
                if(($age->format('%y'))<18){
                    $showError="You are not eligible for creating bank account";
                }
                else{
                    $sql="INSERT INTO `signup` (`username`, `password`,`fname`,`mname`,`lname` ,`birthdate`,`mpin`,`mobile`,`balance`) VALUES ('$username', '$password','$fname','$mname','$lname','$birthdate','$mpin','$phone','$balance')";
                    $result=mysqli_query($conn,$sql);
                    
                    if($result){
                        $showAlert=true;
                    }
                    ucfirst($fname);
                    ucfirst($mname);
ucfirst($lname);
                }
            }
            else if($password!=$cpassword){
                $showError="<b>Passwords do not match</b>.";
            }
        }
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

    <title>Sign Up</title>
    <style>
        .form-group{
            margin: auto;
        }
        button{
            margin: auto;
        }
        .btn-primary{
            margin-left: 290px;
        }
    </style>
</head>

<body>
    <?php
    require 'partials/_nav.php';
    ?>
<?php



if($showAlert){
    echo'<div class="alert alert-success alert-dismissible fade show"      role="alert">
      <strong>Success!</strong> Your account has been created and  now you can login <a href="login.php">here</a>.
      <button type="button" class="close" data-dismiss="alert"     aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    $sql="CREATE TABLE `users`.`$username` (`sr no` INT(10) NOT NULL AUTO_INCREMENT , `transaction` TEXT NOT NULL , `date-time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sr no`)) ENGINE = InnoDB";
    $result=mysqli_query($conn,$sql);
    // if($result){
    //     echo "succesfully create a table";
    // }
}
if($showError){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> '.$showError.'.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
?>
    <div class="container my-4">
        <h1 class="text-center">Nadiad Central Bank Welcomes you!!!</h1>
        <form action="/Php project/signup.php" method="post">
            <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group col-md-6">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">Make sure that you enter the same password.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname">
                
            </div>
            <div class="form-group col-md-6">
                <label for="mname">Middle Naame</label>
                <input type="text" class="form-control" id="mname" name="mname">
               
            </div>
            <div class="form-group col-md-6">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname">
                
            </div>

            <div class="form-group col-md-6">
                <label for="mpin">MPIN</label>
                <input type="password" class="form-control" id="mpin" name="mpin">
                <small id="emailHelp" class="form-text text-muted">Make sure that you enter <b> 6 </b>digit pin.</small>
            </div>

            <div class="form-group col-md-6">
                <label for="birth">Birth-date:</label>
                <input type="date" class="form-control" id="birth" name="birth">
                <small id="emailHelp" class="form-text text-muted">Make sure that you are above 18.</small>
            </div>

            <div class="form-group col-md-6">
                <label for="phone">Mobile</label>
                <input type="phone" class="form-control" id="phone" name="phone">
                <small id="emailHelp" class="form-text text-muted">Make sure that you enter <b> 10 </b>digit mobile number.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="balance">Initial Balance</label>
                <input type="number" class="form-control" id="balance" name="balance">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>