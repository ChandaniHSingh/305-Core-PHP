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
    if(isset($_GET['invoiceID'])){
        $invoiceID = $_GET['invoiceID'];
    }
    
    // if(isset($_POST['btnConfirmOrder'])){
    //     $uid = $_POST['txtUid'];

    //     $query = mysqli_query($con,"delete from sc_cart where uid = $uid");

    //     header("location:thankYou.php?typeOfUser=Customer");
    // }

    ?>
    
    <div class="container-fluid" style="min-height:80vh">
        <div class="row tableRow">
            <h1 class="title">Payment Slip</h1>

            <hr>
            
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align:center">
            
                    
                <?php 
                $totalAmt = 0;
                $hasItem = false;
                $i = 0;
                $query = "select count(*) from sc_sales where uid = $uid and invoice_id = '$invoiceID'" ;
                $result = mysqli_query($con,$query);
                while($row =mysqli_fetch_row($result)){
                    if($row[0] > 0){
                        $hasItem = true;
                    }
                }
                if(!$hasItem){
                ?>
                    <h3> No Item in Cart</h3>
                <?php
                }
                else{
                ?>
                
                <table class="table table-bordered">
                    <!-- <thead>
                        <tr>
                            <td>Invoice Number</td>
                            <td><?php echo $invoiceID?></td>
                        </tr>
                    </thead> -->
                    <thead>
                        <tr>
                            <td>Sr.No.</td>
                            <td>Item Name</td>
                            <td>Qty</td>
                            <td>Price Per Pic</td>
                            <td>Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                        $query = "select * from sc_sales where uid = $uid and invoice_id = '$invoiceID'";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_assoc($result)){
                        ?>    
                            <tr>
                                <?php 
                                    // $cartid = $row['cart_id'];
                                    $pid = $row['pid'];
                                    $query2 = "select * from sc_product where pid = $pid";
                                    $result2 = mysqli_query($con,$query2);
                                    while($row2 = mysqli_fetch_assoc($result2)){

                                        $pName = $row2['name'];
                                        $actualPrice = $row2['price'];

                                    }

                                    $ordQty = $row['qty'];
                                    $tempAmt = $actualPrice * $row['qty'];
                                    $totalAmt += $tempAmt;
                                ?>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $pName ?></td>
                                <td><?php echo $ordQty ?></td>
                                <td><?php echo $actualPrice ?></td>
                                <td><?php echo $tempAmt ?></td>
                            </tr>
                        <?php
                        }
                    ?>
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="4" style="text-align:right">Grand Total Amount</th>
                            <th><?php echo $totalAmt ?></th>
                            
                        </tr>
                        <tr>
                            <th colspan="4"></th>
                            <th><button type="button" class="btn btn-primary" onclick="window.print()">Print / Download Slip</button></th>
                            <!-- <th>
                                <form action="" method="post">
                                    <input type="hidden" name="txtUid" value="<?php echo $uid ?>"/>
                                    <button type="submit" class="btn btn-success" onclick="" name="btnConfirmOrder">Confirm Order</button>
                                </form>
                            </th> -->
                        </tr>
                    </thead>
                </table>
                <?php
                }
                ?>
                 



                

            <div class="col-md-1">
            
            </div>
        </div>
        
    </div>

   
    
<?php
}

include_once("footer.php");

?>