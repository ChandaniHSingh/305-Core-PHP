<?php

include_once("header.php");


$con = mysqli_connect('localhost','root','','chandani');


$imageUpload = false;
if($_GET['typeOfUser'] == 'Admin'){
    $tou = 'Admin';
}
elseif($_GET['typeOfUser'] == 'Service Provider'){
    $tou = 'Service Provider';
}

if(isset($_GET['action'])){
    if($_GET['action'] == 'edit'){
        $eid = $_GET['eid'];

        if($eid != ""){
            $query = mysqli_query($con,"select count(*) from eir_complain where cid = $eid");
            while($countRow = mysqli_fetch_row($query)){
                if($countRow[0] == 1){
                    $query = mysqli_query($con,"select * from eir_complain where cid = $eid");
                    while($row = mysqli_fetch_assoc($query)){
                        $cid = $row['cid'];
                        $pid = $row['pid'];
                        $c_uid = $row['c_uid'];
                        $sp_uid = $row['sp_uid'];
                        $description = $row['description'];
                        $status = $row['status'];
                    }
                }
                else{
                    echo "<script>alert('No Record Found..');</script>";
                }
            }
        }

    }
}


if(isset($_POST['btnUpdate'])){
    if($tou == 'Admin'){
        $cid = $_POST['txtCid'];
        $sp_uid = $_POST['ddSPUid']; 
    
        if($sp_uid != 0){
            $query = mysqli_query($con,"update eir_complain set sp_uid = $sp_uid , status = 'Pending' where cid = $cid");
            echo "<script>alert('Updated Successfully..');</script>";
            header("location:complainView.php?typeOfUser=Admin");
        }
        else{
            echo "<script>alert('Please fill all Fields...');</script>";
        }
    }
    elseif($tou == 'Service Provider'){
        $cid = $_POST['txtCid'];
        $status = $_POST['ddStatus']; 
    
        if($sp_uid != 0){
            $query = mysqli_query($con,"update eir_complain set status = '$status' where cid = $cid");
            echo "<script>alert('Updated Successfully..');</script>";
            header("location:complainView.php?typeOfUser=Service Provider");
        }
        else{
            echo "<script>alert('Please fill all Fields...');</script>";
        }
    }
}






?>


    <div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Complain Update</h1>
            <?php if($tou == 'Admin'){?>
                <h3 class="title">Complain Allocation</h3>
            <?php }elseif($tou == 'Service Provider'){?>
                <h3 class="title">Complain Status Change</h3>
            <?php }?>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <input type="hidden" name="txtCid" id="cid" value="<?php echo $cid; ?>" class="form-control" placeholder="Complain-ID"/>
                
                    <div>
                    <label for="pid" class="form-label">Product : </label>
                    <select name="ddPid" id="pid"  class="form-select" disabled="disabled">
                        <?php 
                        $query2 = mysqli_query($con,"select * from eir_product where pid = $pid");
                        while($row2 = mysqli_fetch_assoc($query2)){
                        ?>
                            <option value="<?php echo $row2['pid'];?>" <?php if($pid == $row2['pid']){ ?>selected = "selected" <?php } ?>><?php echo $row2['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>

                    <div>
                    <label for="pid" class="form-label">Customer : </label>
                    <select name="ddPid" id="pid"  class="form-select" disabled="disabled">
                        <?php 
                        $query2 = mysqli_query($con,"select * from eir_user where uid = $c_uid");
                        while($row2 = mysqli_fetch_assoc($query2)){
                        ?>
                            <option value="<?php echo $row2['uid'];?>" <?php if($c_uid == $row2['uid']){ ?>selected = "selected" <?php } ?>><?php echo $row2['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>

                    <div>
                    <label for="spuid" class="form-label">Service Provider : </label>
                    <select name="ddSPUid" id="spuid"  class="form-select" <?php if($tou != 'Admin'){?> disabled="disabled" <?php }?> >
                        <option value="0" <?php if($sp_uid == 0){ ?>selected = "selected" <?php } ?>>Select Service Provider</option>
                        <?php 
                        $query2 = mysqli_query($con,"select * from eir_user where typeofuser = 'Service Provider'");
                        while($row2 = mysqli_fetch_assoc($query2)){
                        ?>
                            <option value="<?php echo $row2['uid'];?>" <?php if($sp_uid == $row2['uid']){ ?>selected = "selected" <?php } ?>><?php echo $row2['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>

                    <div>
                    <label for="description" class="form-label">Description : </label>
                    <textarea name="txtDescription" id="description" cols="30" rows="5" class="form-control" disabled="disabled"><?php if(isset($description)){ echo $description; }?></textarea>
                    </div>

                    <div>
                    <label for="status" class="form-label">Status : </label>
                    <select name="ddStatus" id="spuid"  class="form-select" <?php if($tou == 'Admin' || $status == 'Completed'){?> disabled="disabled" <?php }?> >
                        
                        <option value="Pending" <?php if($status == 'Pending'){ ?>selected = "selected" <?php } ?>>Pending</option>
                        <option value="Completed" <?php if($status == 'Completed'){ ?>selected = "selected" <?php } ?>>Completed</option>
                        
                    </select>
                    </div>
                    
                    <?php if($status != 'Completed'){?>
                    <div style="text-align:center">
                    <input type="submit" name="btnUpdate" id="update" value="Update" class="btn btn-success btn-small"/>
                    </div>
                    <?php } ?>
                    
                    
                </form>   
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

        

<?php


include_once("footer.php");

?>