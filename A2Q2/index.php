<?php
/*
2. Create a PHP application for “Shopping Cart”.

Admin:
Login
Category Master
Subcategory Master
Product Master
Date range wise shopping report

Customer:
Login
Registration
Home Page : Product Search according to category and sub category.
View Cart
*/

    session_start();
    error_reporting(0);

    if(isset($_GET['loginFirst'])){
        echo "<script>alert('Login First');</script>";
    }
    if(isset($_GET['nowLogin'])){
        echo "<script>alert('Registration Success..Now Login..');</script>";
    }
    
    $con = mysqli_connect("localhost","root","","chandani");
    $isValidUser = false;

    if(isset($_POST['btnLogin'])){
        // $n = $_POST['txtName'];
        $e = $_POST['txtEmail'];
        $p = $_POST['txtPassword'];

        // $tou = $_POST['ddTOU'];

        $query = "select count(*) from sc_user where email = '$e' and password = '$p'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_row($result)){
            if($row[0] == 1){
                $query = "select * from sc_user where email = '$e' and password = '$p'";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($result)){
                    $isValidUser = true;
                    // Cookies
                    if(isset($_POST['chkRemember'])){
                        $rem = $_POST['chkRemember'];
                        echo "<script>alert('Remember User');</script>";
                        setCookie('name',$n,time()+3600*24);
                        setCookie('email',$e,time()+3600*24);
                        setCookie('password',$p,time()+3600*24);
                    }

                    // Session
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['typeOfUser'] = $row['typeofuser'];
                    $_SESSION['isLogin'] = true;

                    $tou = $_SESSION['typeOfUser'];
                    // fetch cart from table sc_cart
                    $uid = $_SESSION['uid'];

                    $query = "select * from sc_cart where uid = $uid";
                    $result = mysqli_query($con,$query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $_SESSION['my_cart'][$i] = array("PID"=>$row['pid'],"Qty"=>$row['qty']);
                        $i++;
                    }

                }
            }
        }
        
        
        if($isValidUser){
            header("location:home.php?typeOfUser=$tou");
        }
        else{
            echo "<script>alert('Invalid User');</script>";
        }

    }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container-fluid">
        
        <div class="row">
        
        <h1 class="title">Shopping Cart</h1>
            
        </div>
    </div>

<div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Login</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <!-- <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($_COOKIE['name'])){ echo $_COOKIE['name']; }?>" class="form-control" placeholder="Name"/>
                    </div> -->
                    <div>
                    <label for="email" class="form-label">User ID (Email): </label>
                    <input type="email" name="txtEmail" id="email" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; }?>" class="form-control" placeholder="Email"/>
                    </div>
                    <div>
                    <label for="password" class="form-label">Password : </label>
                    <input type="password" name="txtPassword" id="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; }?>" class="form-control" placeholder="Password"/>
                    </div>
                    <!-- <div>
                    <label for="aos" class="form-label">Type of User : </label>
                    <select name="ddTOU" id="tou"  class="form-select"  >
                        <option value="" disabled="disabled">Select Type of User</option>
                        <option value="Admin">Admin</option>
                        <option value="Customer">Customer</option>
                    </select>
                    
                    </div> -->
                    <div>
                    <input type="checkbox" name="chkRemember" id="remember" class="form-check-input" value="RememberMe" checked="checked"/>
                    <label class="form-check-label" for="remember">
                            Remember Me
                    </label>
                    
                    </div>
                    <div style="text-align:center;margin:10px">
                    
                    <input type="submit" name="btnLogin" id="login" value="Login" class="btn btn-success btn-small" style="margin:0"/>
                    Or 
                    <a href="userInsert.php?typeOfUser=Customer" style="text-decoration:none">New Register Here...</a> 
                    </div>
                    
                    
                </form>   
            </div>
            <div class="col-md-2">

            <!-- <a href="userInsert.php?typeOfUser=Customer"><button class="btn btn-primary">Customer Registration</button></a> -->
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>