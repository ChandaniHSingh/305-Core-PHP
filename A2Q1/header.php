<?php
session_start();
// if(($_SESSION['isLogin'] == true) && (strcmp($_GET['typeOfUser'],$_SESSION['typeOfUser']) == 0)){
    
// }
// else{
//    header("location:index.php?loginFirst=true");
// }

if((($_SESSION['isLogin'] == true) && (strcmp($_GET['typeOfUser'],$_SESSION['typeOfUser']) == 0 ))|| ((strcmp($_SERVER['PHP_SELF'],"/113-Chandani/305-PHP/Assignment-2/A2Q1/userInsert.php")== 0) && (strcmp($_GET['typeOfUser'],"Customer") == 0 ))){   
    $current_path = "C:/xampp/htdocs/113-Chandani/305-PHP/Assignment-2/A2Q1/";
    
}
else{
   // echo $_SERVER['PHP_SELF'];
   header("location:index.php?loginFirst=true");
}
  
if(isset($_POST['btnLogout'])){
    unset($_SESSION['name']);
    unset($_SESSION['uid']);
    unset($_SESSION['typeOfUser']);
    $_SESSION['isLogin'] = false;

    
    // setCookie('name',$name,time()-3600);
    // setCookie('pass',$pass,time()-3600);
    

    header("location:index.php");
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
            <?php if(strcmp($_GET['typeOfUser'],'Admin') == 0){?>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./home.php?typeOfUser=Admin">Electronic Item Repair</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="/navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php?typeOfUser=Admin">Admin Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="productView.php?typeOfUser=Admin">Product Master</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="serviceProviderView.php?typeOfUser=Admin">Service Provider Master</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="complainView.php?typeOfUser=Admin">Complain View</a>
                            </li>
                           
                        </ul>
                        <form class="d-flex" method="post">
                            <?php if($_SESSION['isLogin']){ ?>
                                <button class="btn btn-outline-primary" type="submit" name="btnLogout">Logout</button>
                            <?php } else{ ?>
                                <a class ="btn btn-outline-success" href="index.php">Login</a>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </nav> 
            <?php } elseif(strcmp($_GET['typeOfUser'],'Customer') == 0){?>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./home.php?typeOfUser=Customer">Electronic Item Repair</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="/navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php?typeOfUser=Customer">Customer Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="complainView.php?typeOfUser=Customer">Complain View</a>
                            </li>
                            
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="complainStatus.php?typeOfUser=Customer">Complain Status</a>
                            </li> -->
                           
                        </ul>
                        <form class="d-flex" method="post">
                            <?php if($_SESSION['isLogin']){ ?>
                                <button class="btn btn-outline-primary" type="submit" name="btnLogout">Logout</button>
                            <?php } else{ ?>
                                <a class ="btn btn-outline-success" href="index.php">Login</a>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </nav> 
            <?php } elseif(strcmp($_GET['typeOfUser'],'Service Provider') == 0){?>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./home.php?typeOfUser=Service Provider">Electronic Item Repair</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="/navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php?typeOfUser=Service Provider">Service Provider Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="complainView.php?typeOfUser=Service Provider">Complain View</a>
                            </li>
                           
                        </ul>
                        <form class="d-flex" method="post">
                            <?php if($_SESSION['isLogin']){ ?>
                                <button class="btn btn-outline-primary" type="submit" name="btnLogout">Logout</button>
                            <?php } else{ ?>
                                <a class ="btn btn-outline-success" href="index.php">Login</a>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </nav> 
            <?php } ?>
        </div>
    </div>