<?php

include_once("header.php");

if($_GET['typeOfUser'] == 'Admin'){
    $tou = 'Admin';
}
elseif($_GET['typeOfUser'] == 'Service Provider'){
    $tou = 'Service Provider';
}
elseif($_GET['typeOfUser'] == 'Customer'){
    $tou = 'Customer';
}


$con = mysqli_connect('localhost','root','','chandani');

/*
$pid = "";
$category = "";
$name = "";
$price = "";
$availQty = "";
$description = "";
$image = "";
*/
$imageUpload = false;

$uid = $_SESSION['uid'];

if(isset($_GET['action'])){
    if($_GET['action'] == 'delete' && $_GET['typeOfUser'] == 'Admin'){
        $did = $_GET['did'];
        if($did != ""){
            $query = mysqli_query($con,"select * from eir_complain where cid = $did");
            if(mysqli_fetch_row($query)){
                $query = mysqli_query($con,"delete from eir_complain where cid = $did");
                echo "<script>alert('Deleted Successfully..');</script>";
            }
            else{
                echo "<script>alert('No Record Found..');</script>";
            }
        }
    }
}

if(isset($_POST['btnInsert'])){
    $pid = $_POST['ddPid']; 
    $cuid = $_POST['txtCUid']; 
    $spuid = ""; 
    $description = $_POST['txtDescription'];
    $status = 'New';


    if($pid != "" && $description != ""){
        $imageUpload = true;
    }
    else{
        echo "<script>alert('Please fill all Fields...');</script>";
    }


    if($imageUpload){
        $query = mysqli_query($con,"insert into eir_complain(pid,c_uid,sp_uid,description,status) values('$pid','$cuid','$spuid','$description','$status')");
        echo "<script>alert('Inserted Successfully..');</script>";
        header("location:complainView.php?typeOfUser=Customer");
    }
    else{
        echo "<script>alert('Please Upload Image..');</script>";
    }
}

if($_GET['typeOfUser']=="Service Provider" && isset($_POST['btnDoneService'])){
    $cid = $_POST['txtCid']; 
    $sp_uid = $_SESSION['uid'];
    if($sp_uid != 0){
        $query = mysqli_query($con,"update eir_complain set status = 'Completed' where cid = $cid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:complainView.php?typeOfUser=Service Provider");
    }
    else{
        echo "<script>alert('Please fill all Fields...');</script>";
    }
}



?>

    <?php if($tou == 'Customer'){ ?>
        <div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Complain Registration</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <label for="pid" class="form-label">Product : </label>
                    <select name="ddPid" id="pid"  class="form-select" >
                        <option value="" disabled="disabled">Select Product</option>
                        <?php 
                        $query = mysqli_query($con,"select * from eir_product");
                        while($row = mysqli_fetch_assoc($query)){
                        ?>
                            <option value="<?php echo $row['pid'];?>"><?php echo $row['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <input type="hidden" name="txtCUid" id="cUid" value="<?php if(isset($_SESSION['uid'])){ echo $_SESSION['uid']; }?>" class="form-control" placeholder="Customer-ID"/>
                    <!-- <div>
                    <label for="cUid" class="form-label">Customer ID : </label>
                    <input type="text" name="txtCUid" id="cUid" value="<?php if(isset($_SESSION['uid'])){ echo $_SESSION['uid']; }?>" class="form-control" placeholder="Customer-ID"/>
                    </div>
                    <div>
                    <label for="spUid" class="form-label">Service Provider ID : </label>
                    <input type="text" name="txtSPUid" id="spUid" value="<?php if(isset($spuid)){ echo $spuid; }?>" class="form-control" placeholder="Service Provider-ID"/>
                    </div> -->

                    <div>
                    <label for="description" class="form-label">Description : </label>
                    <textarea name="txtDescription" id="description" cols="30" rows="5" class="form-control"><?php if(isset($description)){ echo $description; }?></textarea>
                    </div>
                    <div style="text-align:center">
                    
                    <input type="submit" name="btnInsert" id="insert" value="Insert" class="btn btn-success btn-small"/>
                    </div>
                    
                    
                </form>   
            </div>
            <div class="col-md-2"></div>
        </div>
        
    </div>

    <br>
    <hr>
    <br>
    <!-- <div class="container-fluid" style="height:80vh">
        <div class="row tableRow">
            <h1 class="title">All Complains Raise by <?php echo $_SESSION['name'];?></h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-hover table-primary table-bordered">
                <thaed>
                        <tr>
                            <td class="head">cid</td>
                            <td class="head">pid</td>
                            <td class="head">sp_uid</td>
                            <td class="head">description</td>
                            <td class="head">Status</td>
                        </tr>
                    </thaed>
                    <tbody>
                        
                        <?php 
                         $c_uid = $_SESSION['uid'];
                            $query = mysqli_query($con,"select * from eir_complain where c_uid = $c_uid");

                            while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                    <td><?php echo $row['cid']?></td>
                                    <td><?php echo $row['pid']?></td>
                                    <td><?php echo $row['sp_uid']?></td>
                                    <td><?php echo $row['description']?></td>
                                    <td><?php echo $row['status']?></td>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
            
            </div>
        </div>
        
    </div> -->
    <?php } ?>
     
    <br>
    <hr>
    <br>
    <div class="container-fluid" style="height:80vh">
        <div class="row tableRow">
            <?php if($tou == 'Customer'){ ?>
                <h1 class="title">All Complains Raise by <?php echo $_SESSION['name'];?></h1>
            <?php }elseif($tou == 'Admin'){ ?>
                <h1 class="title">All Complains</h1>
            <?php }elseif($tou == 'Service Provider'){ ?>
                <h1 class="title">All Complains Allocated to <?php echo $_SESSION['name'];?></h1>
            <?php } ?> ?>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-hover table-primary table-bordered">
                <thaed>
                        <tr>
                            <td class="head">cid</td>
                            <td class="head">pid</td>
                            <?php if($tou != 'Customer'){ ?>
                                <td class="head">c_uid</td>
                            <?php } ?>
                            <?php if($tou == 'Admin' || $tou == 'Customer'){ ?>
                                <td class="head">sp_uid</td>
                            <?php } ?>
                            <td class="head">description</td>
                            <td class="head">status</td>
                            <?php if($tou != 'Customer'){ ?>
                                <td class="head" colspan="2">Action</td>
                            <?php } ?>
                        </tr>
                    </thaed>
                    <tbody>
                        
                        <?php 
                            if($tou == 'Admin')
                            {
                                $result = mysqli_query($con,"select * from eir_complain");
                            }
                            elseif($tou == 'Service Provider'){
                                $result = mysqli_query($con,"select * from eir_complain where sp_uid = $uid");
                                // $result = mysqli_query($con,"select * from eir_complain where sp_uid = $uid and status='Pending'");
                            }
                            elseif($tou == 'Customer'){
                                $result = mysqli_query($con,"select * from eir_complain where c_uid = $uid");
                                // $result = mysqli_query($con,"select * from eir_complain where sp_uid = $uid and status='Pending'");
                            }

                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['cid']?></td>

                                    <?php $pid = $row['pid']; ?>
                                    <?php $result2 = mysqli_query($con,"select * from eir_product where pid = $pid");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                    ?>
                                    <td><?php echo $row2['name']?></td>
                                    <?php } ?>

                                    <?php if($tou != 'Customer'){ ?>
                                    <?php $c_uid = $row['c_uid']; ?>
                                    <?php $result2 = mysqli_query($con,"select * from eir_user where uid = $c_uid");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                    ?>
                                    <td><?php echo $row2['name']?></td>
                                    <?php } }?>

                                    <?php if($tou == 'Admin' || $tou == 'Customer'){ ?>
                                    <?php 
                                    
                                    
                                    $sp_uid = $row['sp_uid'];
                                    if($sp_uid != 0){ 
                                    
                                    ?>
                                    <?php $result2 = mysqli_query($con,"select * from eir_user where uid = $sp_uid");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                    ?>
                                        <td><?php echo $row2['name']?></td>
                                    <?php } }
                                    else{
                                    ?>
                                        <td>No Allocated</td> 
                                    <?php
                                    } }?>
                                   
                                    <td><?php echo $row['description']?></td>
                                    <td><?php echo $row['status']?></td>
                                    <?php if($tou == 'Admin'){ ?>
                                        <td><a href="complainEdit.php?typeOfUser=Admin&action=edit&eid=<?php echo $row['cid']?>"><button class="btn btn-warning">Allocate</button></a></td>
                                        <td><a href="complainView.php?typeOfUser=Admin&action=delete&did=<?php echo $row['cid']?>"><button class="btn btn-danger">Delete</button></a></td>
                                    <?php } elseif($tou == 'Service Provider'){ ?>
                                    <td>

                                    <?php if($row['status'] == "Pending"){ ?>
                                    <form method="post">
                                        <input type="hidden" name="txtCid" value="<?php echo $row['cid']?>"/>
                                        <input type="submit" class="btn btn-warning" name="btnDoneService" value="Pending" style="width:60%;margin:0"/>
                                    </form> 
                                    <?php }else{?>
                                        <b><?php echo $row['status']?> </b>
                                    <?php } ?>
                                    
                                    <!-- <a href="complainEdit.php?typeOfUser=Service Provider&action=edit&eid=<?php echo $row['cid']?>"><button class="btn btn-warning" onclick="">Edit</button></a> -->
                                
                                    </td>
                                    <?php } ?>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
            
            </div>
        </div>
        
    </div> 
    
<?php


include_once("footer.php");

?>