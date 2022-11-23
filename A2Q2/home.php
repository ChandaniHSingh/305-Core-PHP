<?php
include_once("header.php");

    $con = mysqli_connect("localhost","root","","chandani");
    $isValidUser = false;

    if(isset($_POST['btnLogin'])){
        $n = $_POST['txtName'];
        $p = $_POST['txtPassword'];

        $tou = $_POST['ddTOU'];
        $query = "select count(*) from sc_user where name = '$n' and password = '$p' and typeofuser = '$tou'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_row($result)){
            if($row[0] == 1){
                $query = "select * from sc_user where name = '$n' and password = '$p' and typeofuser = '$tou'";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($result)){
                    $isValidUser = true;
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

    
if($_SESSION['typeOfUser'] == 'Admin'){


?>

    <div class="container-fluid"  style="text-align:center;margin:20px">
        
    <!-- <img src="" width="50px" height="50px" style="border-radius:25px;height:50px;width:50px"/>  -->
            <img src="uploads/user/<?php echo $userImage ?>" class="" alt="p1.jpg" style="border-radius:50%;height:400px;width:400px;">
            <h1><?php echo $_SESSION['name']; ?></h1>
        
    </div>

    <div class="b-example-divider"></div>
    <br><hr><br>
    <div class="container-fluid">
        <div class="row" style="color:blue;text-align:center;font-size:bold">
            <div class="col-md-2"></div>
            <div class='col-md-2'>
                <div class='card' style='margin:10px;background-color:aliceblue'>
                    <div class='card-body'>
                        <h4 class='card-title'>Categories</h4>
                        <?php
                        $result = mysqli_query($con,"select count(*) from sc_category");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <h4 style="color:deeppink"><?php echo $row[0]?></h4>
                    </div>
                </div>
            </div>
            <div class='col-md-2'>
                <div class='card' style='margin:10px;background-color:aliceblue'>
                    <div class='card-body'>
                        <h4 class='card-title'>SubCategories</h4>
                        <?php
                        $result = mysqli_query($con,"select count(*) from sc_sub_category");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <h4 style="color:deeppink"><?php echo $row[0]?></h4>
                    </div>
                </div>
            </div>
            <div class='col-md-2'>
                <div class='card' style='margin:10px;background-color:aliceblue'>
                    <div class='card-body'>
                        <h4 class='card-title'>Products</h4>
                        <?php
                        $result = mysqli_query($con,"select count(*) from sc_product");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <h4 style="color:deeppink"><?php echo $row[0]?></h4>
                    </div>
                </div>
            </div>
            <div class='col-md-2'>
                <div class='card' style='margin:10px;background-color:aliceblue'>
                    <div class='card-body'>
                        <h4 class='card-title'>Customers</h4>
                        <?php
                        $result = mysqli_query($con,"select count(*) from sc_user where typeofuser = 'Customer'");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <h4 style="color:deeppink"><?php echo $row[0]?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
<?php 
}
else if($_SESSION['typeOfUser'] == 'Customer'){


?>

    <div class="container-fluid" >
        
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="height:80vh">
            <div class="carousel-item active">
            <img src="./images/carousel-image/p1.jpg" class="d-block w-100" alt="p1.jpg">
            </div>
            <div class="carousel-item">
            <img src="./images/carousel-image/p2.jpg" class="d-block w-100" alt="p2.jpg">
            </div>
            <div class="carousel-item">
            <img src="./images/carousel-image/p3.jpg" class="d-block w-100" alt="p3.jpg">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
        
    </div>

    <div class="b-example-divider"></div>
<?php } ?>
<?php
include_once("footer.php");
?>