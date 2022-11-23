<?php
/*
1. Create a PHP application “Electronic Item Repair”.
Admin :
Login
product_master- Product ID, Name, description.
Service provider registration -ID, Name, Password, Age, Contact Number, and Photo
Complain Allocation 
Complain Status – view all complains along with the status (New / Pending/ Completed)
Customer :
Registration -ID, Name, Password, Age, Contact Number, and Photo
Login
Complain – Complain, ProductID, Complain Description
View Status of Complains
Note : Complaintregistration and view status must be on the same page
Service Provider:
Login
View Complains
Update Status
*/

    session_start();


    if(isset($_GET['loginFirst'])){
        echo "<script>alert('Login First');</script>";
    }
    if(isset($_GET['nowLogin'])){
        echo "<script>alert('Registration Success..Now Login..');</script>";
    }
    
    $con = mysqli_connect("localhost","root","","chandani");
    $isValidUser = false;

    if(isset($_POST['btnLogin'])){
        $n = $_POST['txtName'];
        $p = $_POST['txtPassword'];

        $tou = $_POST['ddTOU'];
        $query = "select count(*) from eir_user where name = '$n' and password = '$p' and typeofuser = '$tou'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_row($result)){
            if($row[0] == 1){
                $query = "select * from eir_user where name = '$n' and password = '$p' and typeofuser = '$tou'";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($result)){
                    $isValidUser = true;
                    // Cookies
                    if(isset($_POST['chkRemember'])){
                        $rem = $_POST['chkRemember'];
                        echo "<script>alert('Remember User');</script>";
                        setCookie('name',$n,time()+3600*24);
                        setCookie('password',$p,time()+3600*24);
                    }

                    // Session
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['typeOfUser'] = $row['typeofuser'];
                    $_SESSION['isLogin'] = true;

                    
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
    <title>Electronic Item Repair</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container-fluid">
        
        <div class="row">
        
        <h1 class="title">Electronic Item Repair</h1>
            
        </div>
    </div>

<div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Login</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($_COOKIE['name'])){  echo $_COOKIE['name']; }?>" class="form-control" placeholder="Name"/>
                    </div>
                    <div>
                    <label for="password" class="form-label">Password : </label>
                    <input type="password" name="txtPassword" id="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; }?>" class="form-control" placeholder="Password"/>
                    </div>
                    <div>
                    <label for="aos" class="form-label">Type of User : </label>
                    <select name="ddTOU" id="tou"  class="form-select"  >
                        <option value="" disabled="disabled">Select Type of User</option>
                        <option value="Admin">Admin</option>
                        <option value="Customer">Customer</option>
                        <option value="Service Provider">Service Provider</option>
                    </select>
                    
                    </div>
                    <div>
                    <input type="checkbox" name="chkRemember" id="remember" class="form-check-input" value="RemenberMe" checked="checked"/>
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

            
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>