<?php 

    session_start();
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
    }
    // else{
    //     $cid = 0;
    // }

    if(isset($_GET['scid'])){
        $scid = $_GET['scid'];
    }
    // else{
    //     $scid = 0;
    // }

    $res = "";
    

    $con = mysqli_connect('localhost','root','','chandani');
    if($cid == 0 && $scid == 0){
        $query = mysqli_query($con,"select * from sc_product order by pid desc");
    }
    elseif($cid != 0 && $scid == 0){
        $query = mysqli_query($con,"select * from sc_product where cid = $cid order by pid desc");
    }
    elseif($cid != 0 && $scid != 0){
        $query = mysqli_query($con,"select * from sc_product where cid = $cid and scid = $scid order by pid desc");
    }

    while($row = mysqli_fetch_assoc($query)){
        
        $res .= "<div class='col-md-3' style='margin-bottom:10px'>";
        $res .= "<div class='card'>";
        $res .= "<img style='height:300px' src='./uploads/product/".$row['photo']."' class='card-img-top' alt='".$row['name']." Image'/>";
        $res .= "<div class='card-body'>";
        $res .= "<h4 class='card-title'>".$row['name']."</h4>";
        $res .= "<p>".$row['price']." Rs.</p>";
        $res .= "<form action='manageCart.php' method='post'>";
        $res .= "<input type='hidden' value='".$row['pid']."' name='txtPID'>";
        $res .= "<input type='hidden' value='".$_SESSION['uid']."' name='txtUID'>";
        $res .= "<input type='number' value='1' min='1' max='".$row['avail_qty']."' name='numQty' style='float:left;width:50px'> ";
        // $res .= "<button type='submit' class='btn btn-success' name='btnBuyNow' style='float:left;width:auto;margin-left:50px'>Buy Now</button>";
        $res .= "<button type='submit' class='btn btn-primary' name='btnAddToCart' style='float:right;width:auto'>Add To Cart</button>";
        // $res .= "</input>";
        $res .= "</form>";
        $res .= "</div>";
        $res .= "</div>";
        $res .= "</div>";
    }
    echo $res;
?>