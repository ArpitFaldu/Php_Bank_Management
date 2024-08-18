<?php
    $login=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'partials/_dbconnect.php';
        $username=$_POST["username"];
        $password=$_POST["password"];

        $sql="SELECT * fROM signup WHERE `username`='$username' AND `password`='$password' ";
        // $sql="SELECT signup.username, signup.password, signup.fname FROM signup INNER JOIN login ON signup.username=login.username";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            $rows=[];
            if ($result && $result->num_rows > 0) {
                $rows = $result->fetch_array(MYSQLI_ASSOC);
            }
            if($num==1){
                $login=true;
                session_start();
                $_SESSION["loggedin"]=true;
                $_SESSION["username"]=$username;
                $_SESSION["firstname"]=$rows['fname'];
                $_SESSION["middlename"]=$rows['mname'];
                $_SESSION["lastname"]=$rows['lname'];
                $_SESSION["mpinnumber"]=$rows['mpin'];
                $_SESSION["birth"]=$rows['birthdate'];
                $_SESSION["ibalance"]=$rows['balance'];
                header("location:welcome.php");
            }
        else{
            $showError="Invalid credentials";
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

    <title>Login</title>
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
if($login){
    echo'<div class="alert alert-success alert-dismissible fade show"      role="alert">
      <strong>Success!</strong> You have been logged in successfully.
      <button type="button" class="close" data-dismiss="alert"     aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
if($showError){
    echo'<div class="alert alert-danger alert-dismissible fade show"      role="alert">
      <strong>Oops!</strong> '.$showError.'.
      <button type="button" class="close" data-dismiss="alert"     aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
?>
    <div class="container my-4">
        <h1 class="text-center">Login to your Bank Account</h1>
        <form action="/Php project/login.php" method="post">
            <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-md-6">
                <br>
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <p class="my-2">Didn't have an account? <a href="signup.php">Create your account here</a></p>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>