<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');

if($_SESSION['typeOfUser'] == 'Admin'){


?>

<?php
    
}

elseif($_SESSION['typeOfUser'] == 'Customer'){
 
    $uid = $_SESSION['uid'];

    if(isset($_POST['btnRemove'])){

        $did = $_POST['txtPID'];
        // session_unset();
        // unset($_SESSION['my_cart'][$key]);
        foreach($_SESSION['my_cart'] as $key=>$value){
            if($value['PID'] == $did){
                unset($_SESSION['my_cart'][$key]);
            }
        }
        if(count($_SESSION['my_cart']) == 0){
            unset($_SESSION['my_cart']);
        }

        $query4 = "delete from sc_cart where uid = $uid and pid = $did";
            $result4 = mysqli_query($con,$query4);
        // echo "<script>alert('Deleted Successfully..');</script>";
        

    }

    ?>
    <!-- <script>
        function itemDeleteFun(key){
            // $_SESSION['my_cart']
        }
    </script> -->
    <div class="container-fluid" style="min-height:80vh">
        <div class="row tableRow">
            <h1 class="title">My Cart</h1>
            <!-- <?php print_r($_SESSION['my_cart']);?> -->
            <hr>
            
            <div class="col-md-1"></div>
            <div class="col-md-10" style="text-align:center">
            
                    
                <?php 
                $totalAmt = 0;
                
                ?>

                <div class="row">
                <?php 
                    $totalAmt = 0;
                    if(isset($_SESSION['my_cart']) && count($_SESSION['my_cart']) > 0){
                            
                        foreach($_SESSION['my_cart'] as $key=>$value){
                        ?>
                        <?php 
                        // print_r($key);
                        // print_r($value);
                            $pid = $value['PID'];
                            $query = "select * from sc_product where pid = $pid";
                            $result = mysqli_query($con,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                $tempPhoto = $row['photo'];
                                $tempName = $row['name'];
                                $tempPrice = $row['price'];
                            }
                            $tempQty = $value['Qty'];
                            $tempAmt = $tempPrice * $value['Qty'];
                            $totalAmt += $tempAmt
                        ?>

                    
                            <div class="col-md-2"></div>
                            <div class="card col-md-8" style="margin-bottom:10px">
                                <div class="row g-0">
                                    
                                    <div class="col-md-4">
                                    <img src="./uploads/product/<?php echo $tempPhoto ?>" class="img-fluid rounded-start" alt="<?php echo $tempPhoto ?>" style="width:250px;height:250px">
                                    </div>
                                    <div class="col-md-7">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $tempName ?></h3>
                                        <h5 class="card-text">Qty : <input type='number' value='<?php echo $tempQty; ?>' id="qty" style='width:50px' min='1' max='' name='numQty' ></h5>
                                        <h5 class="card-text">Price : <?php echo $tempPrice ?></h5>
                                        <h5 class="card-text">Amt : <?php echo $tempAmt ?></h5>

                                    </div>
                                    </div>
                                    <div class="col-md-1">
                                        <form action="" method="post">
                                            <input type="hidden" name="txtPID" id="pid" value="<?php echo $pid ?>"/>
                                            <button type="submit" class="btn btn-danger" onclick="" name="btnRemove" style="text-align:center;margin-top:20px">X</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        <?php
                        }
                        ?>

                        <div class="row">
                                    
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="text-align : right;display:flex;flex-direction: row;justify-content:flex-end;align-items:center;align-content:space-around">
                                <span style="font-size:large;font-weight:bold;margin-right:20px">Total : <?php echo $totalAmt ?></span>
                                <form action="" method="post">
                                    <input type="hidden" name="txtUid" value="<?php echo $uid ?>"/>
                                    <input type="hidden" name="txtTotalAmt" value="<?php echo $totalAmt ?>"/>
                                    <a href="confirmPayment.php?typeOfUser=Customer&payTotalAmt=<?php echo $totalAmt?>" class="btn btn-success">Go for Payment</a>
                                    <!-- <button type="submit" class="btn btn-success" onclick="" name="btnPay">Go for Payment</button> -->
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <?php    
                    }
                    elseif(!isset($_SESSION['my_cart']) || count($_SESSION['my_cart']) == 0){
                    ?>
                    <h3> No Item in Cart</h3>
                    <?php
                    }
                    ?> 
                    
                </div>
            <div class="col-md-1"></div>
        </div>
        
    </div>

   <script>
    function changeQty(){
        
    }
   </script>
    
<?php
}

include_once("footer.php");

?>