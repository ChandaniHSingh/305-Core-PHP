<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');


if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        $did = $_GET['did'];
        if($did != ""){
            $result = mysqli_query($con,"select * from eir_product where pid = $did");
            if($row = mysqli_fetch_assoc($result)){
                try{unlink($current_path."uploads/product/".$row['photo']);}
                catch(Exception){}
                // echo "<script>alert('$current_path')</script>";
                $query = mysqli_query($con,"delete from eir_product where pid = $did");
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
                            <td class="head">pid</td>
                            <td class="head">name</td>
                            <td class="head">description</td>
                            <td class="head">photo</td>
                            <td class="head" colspan="2">Action</td>
                        </tr>
                    </thaed>
                    <tbody>
                        
                        <?php 
                            $query = mysqli_query($con,"select * from eir_product");

                            while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                    <td><?php echo $row['pid']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['description']?></td>
                                    <td><a target="_blank" href="./uploads/product/<?php echo $row['photo']?>"><img src="./uploads/product/<?php echo $row['photo']?>" alt="<?php echo $row['photo']?>"></a></td>
                                    <td><a href="productEdit.php?typeOfUser=Admin&action=edit&eid=<?php echo $row['pid']?>"><button class="btn btn-warning">Edit</button></a></td>
                                    <td><a href="productView.php?typeOfUser=Admin&action=delete&did=<?php echo $row['pid']?>"><button class="btn btn-danger">Delete</button></a></td>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
            <a href="productInsert.php?typeOfUser=Admin"><button class="btn btn-primary">Insert</button></a>
            </div>
        </div>
        
    </div>
    
<?php


include_once("footer.php");

?>