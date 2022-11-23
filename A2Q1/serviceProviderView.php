<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');


if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        $did = $_GET['did'];
        if($did != ""){
            $result = mysqli_query($con,"select * from eir_user where uid = $did and typeofuser = 'Service Provider'");
            if($row = mysqli_fetch_assoc($result)){
                try{unlink($current_path."uploads/user/".$row['photo']);}
                catch(Exception){}
                $query = mysqli_query($con,"delete from eir_user where uid = $did");
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
            <h1 class="title">All Service Provider</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-hover table-primary table-bordered">
                <thaed>
                        <tr>
                            <td class="head">uid</td>
                            <td class="head">name</td>
                            <td class="head">password</td>
                            <td class="head">age</td>
                            <td class="head">phone</td>
                            <td class="head">photo</td>
                            <td class="head" colspan="2">Action</td>
                        </tr>
                    </thaed>
                    <tbody>
                        
                        <?php 
                            $query = mysqli_query($con,"select * from eir_user where typeofuser = 'Service Provider'");

                            while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                    <td><?php echo $row['uid']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['password']?></td>
                                    <td><?php echo $row['age']?></td>
                                    <td><?php echo $row['phone']?></td>
                                    <td><a target="_blank" href="./uploads/user/<?php echo $row['photo']?>"><img src="./uploads/user/<?php echo $row['photo']?>" alt="<?php echo $row['photo']?>" width="100px" height="100px"></a></td>
                                    <td><a href="serviceProviderEdit.php?typeOfUser=Admin&action=edit&eid=<?php echo $row['uid']?>"><button class="btn btn-warning">Edit</button></a></td>
                                    <td><a href="serviceProviderView.php?typeOfUser=Admin&action=delete&did=<?php echo $row['uid']?>"><button class="btn btn-danger">Delete</button></a></td>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
            <a href="userInsert.php?typeOfUser=Admin"><button class="btn btn-primary">Insert</button></a>
            </div>
        </div>
        
    </div>
    
<?php


include_once("footer.php");

?>