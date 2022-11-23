<?php
include_once("header.php");

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

    <div class="container-fluid" style="">
        
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
    
<?php
include_once("footer.php");
?>