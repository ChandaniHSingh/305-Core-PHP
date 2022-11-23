<?php
session_start();
error_reporting(0);
if(((isset($_SESSION['isLogin'])) && ($_SESSION['isLogin'] == true) && (strcmp($_GET['typeOfUser'],$_SESSION['typeOfUser']) == 0 ))|| ((strcmp($_SERVER['PHP_SELF'],"/113/305-PHP/Assignment-2/A2Q2/userInsert.php")== 0) && (strcmp($_GET['typeOfUser'],"Customer") == 0 ))){ 
    if((strcmp($_GET['typeOfUser'],"Customer") == 0 ) && (strcmp($_SERVER['PHP_SELF'],"/113/305-PHP/Assignment-2/A2Q2/userInsert.php") == 0)){
        $current_path = "C:/xampp/htdocs/113-Chandani/305-PHP/Assignment-2/A2Q2/";
    }
    else{
        $uid = $_SESSION['uid'];  
        $con = mysqli_connect("localhost","root","","chandani");
        $query = mysqli_query($con,"select * from sc_user where uid=$uid");
    
        while($row = mysqli_fetch_assoc($query)){
            $userImage = $row['photo'];
            $userName = $row['name'];
        }
        if(isset($_SESSION['my_cart'])){
            $my_cart_count = count($_SESSION['my_cart']);
        }

    }
                        
}
else{
   // echo $_SERVER['PHP_SELF'];
   //header("location:index.php?loginFirst=true");
}

  
if(isset($_POST['btnLogout'])){
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['uid']);
    unset($_SESSION['typeOfUser']);

    session_destroy();
    $_SESSION['isLogin'] = false;

    
    // setCookie('name',$name,time()-3600);
    // setCookie('password',$pass,time()-3600);
    

    header("location:index.php");
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
            <?php if(strcmp($_GET['typeOfUser'],'Admin') == 0){?>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./home.php?typeOfUser=Admin">Shopping Cart</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="/navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php?typeOfUser=Admin">Admin Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="categoryView.php?typeOfUser=Admin">Category Master</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="subCategoryView.php?typeOfUser=Admin">SubCategory Master</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="productView.php?typeOfUser=Admin">Product Master</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="shoppingReportView.php?typeOfUser=Admin">Shopping Report</a>
                            </li>
                           
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/user/<?php echo $userImage ?>" width="50px" height="50px" style="border-radius:25px;height:50px;width:50px"/> <?php echo $_SESSION['name']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li style="text-align:center">
                                    <form class="d-flex" method="post">
                                        <?php if($_SESSION['isLogin']){ ?>
                                            <button class="btn btn-outline-primary" type="submit" name="btnLogout">Logout</button>
                                        <?php } else{ ?>
                                            <button class="btn btn-outline-success" type="submit">Login</button>
                                        <?php } ?>
                                    </form>
                                </li>
                            </ul>
                            </li>
                        </ul>

                        <!-- <form class="d-flex" method="post">
                            
                            
                            <?php if($_SESSION['isLogin']){ ?>
                                <button class="btn btn-outline-primary" type="submit" name="btnLogout">Logout</button>
                            <?php } else{ ?>
                                <button class="btn btn-outline-success" type="submit">Login</button>
                            <?php } ?>
                        </form> -->
                    </div>
                </div>
            </nav> 
            <?php } elseif(strcmp($_GET['typeOfUser'],'Customer') == 0){?>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./home.php?typeOfUser=Customer">Shopping Cart</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="/navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php?typeOfUser=Customer">Customer Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="productView.php?typeOfUser=Customer">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cartView.php?typeOfUser=Customer">My Cart <span><?php if(isset($my_cart_count)){ echo "(".$my_cart_count.")";}?></span></a>
                            </li>
                        </ul>
                        <?php if(strcmp($_SERVER['PHP_SELF'],"/113/305-PHP/Assignment-2/A2Q2/userInsert.php") != 0){?>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/user/<?php echo $userImage ?>" width="50px" height="50px" style="border-radius:25px;height:50px;width:50px"/> <?php echo $_SESSION['name']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li style="text-align:center">
                                    <form class="d-flex" method="post">
                                        <?php if($_SESSION['isLogin']){ ?>
                                            <button class="btn btn-outline-primary"  type="submit" name="btnLogout">Logout</button>
                                        <?php } else{ ?>
                                            <button class="btn btn-outline-success" type="submit">Login</button>
                                        <?php } ?>
                                    </form>
                                </li>
                            </ul>
                            </li>
                        </ul>
                        <?php } else{ ?>
                                <a class="btn btn-outline-success" href="index.php">Login</a> 
                        <?php } ?>
                        <!-- <form class="d-flex" method="post">
                            <?php if($_SESSION['isLogin']){ ?>
                                <button class="btn btn-outline-primary" type="submit" name="btnLogout">Logout</button>
                            <?php } else{ ?>
                                <button class="btn btn-outline-success" type="submit">Login</button>
                            <?php } ?>
                        </form> -->
                    </div>
                </div>
            </nav> 
            <?php }?>
            
        </div>
    </div>