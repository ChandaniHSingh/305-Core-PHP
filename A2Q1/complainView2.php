<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');


if($_GET['typeOfUser'] == 'Admin'){
    $tou = 'Admin';
}
elseif($_GET['typeOfUser'] == 'Service Provider'){
    $tou = 'Service Provider';
}

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

?>
    <div class="container-fluid" style="height:80vh">
        <div class="row tableRow">
            <h1 class="title">All Products</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-hover table-primary table-bordered">
                <thaed>
                        <tr>
                            <td class="head">cid</td>
                            <td class="head">pid</td>
                            <td class="head">c_uid</td>
                            <?php if($tou == 'Admin'){ ?>
                                x<td class="head">sp_uid</td>
                            <?php } ?>
                            <td class="head">description</td>
                            <td class="head">status</td>
                            <td class="head" colspan="2">Action</td>
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

                                    <?php $c_uid = $row['c_uid']; ?>
                                    <?php $result2 = mysqli_query($con,"select * from eir_user where uid = $c_uid");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                    ?>
                                    <td><?php echo $row2['name']?></td>
                                    <?php } ?>

                                    <?php if($tou == 'Admin'){ ?>
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
                                    <td><a href="complainEdit.php?typeOfUser=Service Provider&action=edit&eid=<?php echo $row['cid']?>"><button class="btn btn-warning">Edit</button></a></td>
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