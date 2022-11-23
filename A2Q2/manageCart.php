<?php 
    session_start();
    
$con = mysqli_connect('localhost','root','','chandani');


    if(isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == "POST")){
        if(isset($_POST['btnBuyNow'])){
            $uid = $_POST['txtUID'];
            $pid = $_POST['txtPID'];
            $qty = $_POST['numQty'];

            
        }
        elseif(isset($_POST['btnAddToCart'])){
            $uid = $_POST['txtUID'];
            $pid = $_POST['txtPID'];
            $qty = $_POST['numQty'];

            
            // echo "<script>alert('Added Into Cart Successfully..');</script>";
            // header("location:productView.php?typeOfUser=Customer");

            if(isset($_SESSION['my_cart'])){
                $id = array_column($_SESSION['my_cart'],"PID");
                if(in_array($_POST['txtPID'],$id)){


                    foreach($_SESSION['my_cart'] as $key=>$value){
                        
                        $pid = $value['PID'];
                        if($_POST['txtPID'] == $pid){
                            $qty = $value['Qty'];
                            $qty  += $_POST['numQty'];
                            $value['Qty'] = $qty;
                            $query = mysqli_query($con,"update sc_cart set qty = $qty where uid = $uid and pid = $pid");
                        }


                    }


                    

                    echo "<script>alert('Item Qty Incresed Added')
                    window.location.href='productView.php?typeOfUser=Customer';
                    </script>";
                }
                else{

                    $query = mysqli_query($con,"insert into sc_cart(uid,pid,qty,date_time) values($uid,$pid,$qty,now())");

                    $cnt = count($_SESSION['my_cart']);
                    $_SESSION['my_cart'][$cnt] = array("PID"=>$pid,"Qty"=>$qty);
                    echo "<script>alert('Item addedd')
                    window.location.href='productView.php?typeOfUser=Customer';
                    </script>";
                }

            }
            else{

                $query = mysqli_query($con,"insert into sc_cart(uid,pid,qty,date_time) values($uid,$pid,$qty,now())");

                $_SESSION['my_cart'][0] = array("PID"=>$pid,"Qty"=>$qty);
                echo "<script>alert('Item addedd First Time')
                window.location.href='productView.php?typeOfUser=Customer';
                </script>";
            }
        }
        else{
            echo "<script>alert('Add To Cart Not Clicked...')
                window.location.href='productView.php?typeOfUser=Customer';
                </script>";
        }

        unset($_SESSION['my_cart']);
        $query = "select * from sc_cart where uid = $uid";
        $result = mysqli_query($con,$query);
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['my_cart'][$i] = array("PID"=>$row['pid'],"Qty"=>$row['qty']);
            $i++;
        }
    }

?>