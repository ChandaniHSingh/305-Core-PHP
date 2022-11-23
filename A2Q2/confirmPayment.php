<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');

if($_SESSION['typeOfUser'] == 'Admin'){


?>

<?php
    
}

elseif($_SESSION['typeOfUser'] == 'Customer'){
 
    $uid = $_SESSION['uid'];

    if(isset($_GET['payTotalAmt'])){
        $payTotalAmt = $_GET['payTotalAmt'];
    }
    // if(isset($_GET['invoiceID'])){
    //     $invoiceID = $_GET['invoiceID'];
    // }
    
    // if(isset($_POST['btnConfirmOrder'])){
    //     $uid = $_POST['txtUid'];

    //     $query = mysqli_query($con,"delete from sc_cart where uid = $uid");

    //     header("location:thankYou.php?typeOfUser=Customer");
    // }

    
    if(isset($_POST['btnConfirmPay'])){

        $uid = $_POST['txtUid'];
        $payTotalAmt = $_POST['txtTotalAmt'];

        foreach($_SESSION['my_cart'] as $key=>$value){
            $pid = $value['PID'];
            $ordQty = $value['Qty'];
            $query2 = "select * from sc_product where pid = $pid";
            $result2 = mysqli_query($con,$query2);
            while($row2 = mysqli_fetch_assoc($result2)){
                $availQty = $row2['avail_qty'];
                $actualPrice = $row2['price'];
            }
            $tempAmt = $actualPrice * $ordQty;
            $newAvailQty = $availQty - $ordQty;
            $query3 = "update sc_product set avail_qty = $newAvailQty where pid = $pid";
            $result3 = mysqli_query($con,$query3);
            
            $query4 = "delete from sc_cart where uid = $uid and pid = $pid";
            $result4 = mysqli_query($con,$query4);

            $invoiceID = date("Y/m/d-h:i:sa").$uid.$payTotalAmt;

            $query4 = mysqli_query($con,"insert into sc_sales(invoice_id,uid,pid,qty,amt,date_time) values('$invoiceID',$uid,$pid,$ordQty,$tempAmt,now())");
            
        }
        unset($_SESSION['my_cart']);
        echo "<script>alert('Payment Successfully..');</script>";
        header("location:paySlip.php?typeOfUser=Customer&payTotalAmt=$payTotalAmt&invoiceID=$invoiceID");

        // $query = "select * from sc_cart where uid = $uid";
        // $result = mysqli_query($con,$query);
        // while($row = mysqli_fetch_assoc($result)){
        //     $pid = $row['pid'];
        //     $ordQty = $row['qty'];
        //     $query2 = "select * from sc_product where pid = $pid";
        //     $result2 = mysqli_query($con,$query2);
        //     while($row2 = mysqli_fetch_assoc($result2)){
        //         $availQty = $row2['avail_qty'];
        //         $actualPrice = $row2['price'];
        //     }
        //     $tempAmt = $actualPrice * $ordQty;
        //     $newAvailQty = $availQty - $ordQty;
        //     $query3 = "update sc_product set avail_qty = $newAvailQty where pid = $pid";
        //     $result3 = mysqli_query($con,$query3);

        //     $query4 = mysqli_query($con,"insert into sc_sales(uid,pid,qty,amt,date_time) values($uid,$pid,$ordQty,$tempAmt,now())");
            

        //    // $query4 = mysqli_query($con,"delete from sc_cart where uid = $uid and pid = $pid");

        // }

    }

    ?>
    
    <div class="container-fluid" style="min-height:80vh">
        <div class="row tableRow">
            <h1 class="title">Payment Gatway</h1>

            <hr>
            
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align:center">
            
                    
                <span style="font-size:large;font-weight:bold;margin-right:20px">Total : <?php echo $payTotalAmt ?></span>
                          
                       
                <form action="" method="post">
                    <input type="hidden" name="txtUid" value="<?php echo $uid ?>"/>
                    <input type="hidden" name="txtTotalAmt" value="<?php echo $payTotalAmt ?>"/>
                    <button type="submit" class="btn btn-success" onclick="" name="btnConfirmPay">Confirm Payment</button>
                </form>
                          
            </div>
            <div class="col-md-2">
            
            </div>
        </div>
        
    </div>

   
    
<?php
}

include_once("footer.php");

?>