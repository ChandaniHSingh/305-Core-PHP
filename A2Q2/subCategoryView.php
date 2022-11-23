<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');


if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        $did = $_GET['did'];
        if($did != ""){
            $query = mysqli_query($con,"select * from sc_sub_category where scid = $did");
            if(mysqli_fetch_row($query)){
                $query = mysqli_query($con,"delete from sc_sub_category where scid = $did");
                echo "<script>alert('Deleted Successfully..');</script>";
            }
            else{
                echo "<script>alert('No Record Found..');</script>";
            }
    
        }
    }
}

?>
    <div class="container-fluid" style="min-height:80vh">
        <div class="row tableRow">
            <h1 class="title">All SubCategories</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-hover table-primary table-bordered">
                <thaed>
                        <tr>
                            <td class="head">scid</td>
                            <td class="head">category</td>
                            <td class="head">name</td>
                            <td class="head">description</td>
                            <!-- <td class="head">photo</td> -->
                            <td class="head" colspan="2">Action</td>
                        </tr>
                    </thaed>
                    <tbody>
                        
                        <?php 
                            $query = mysqli_query($con,"select * from sc_sub_category");

                            while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                    <td><?php echo $row['scid']?></td>
                                    <?php 
                                        $cid = $row['cid'];
                                        $query2 = mysqli_query($con,"select * from sc_category where cid = $cid");

                                        while($row2 = mysqli_fetch_assoc($query2)){ 
                                            $c_name = $row2['name'];
                                        }
                                    ?>
                                    <td><?php echo $c_name?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['description']?></td>
                                    <!-- <td><a target="_blank" href="./uploads/subcategory/<?php echo $row['photo']?>"><img src="./uploads/subcategory/<?php echo $row['photo']?>" alt="<?php echo $row['photo']?>"></a></td> -->
                                    <td><a href="subCategoryEdit.php?typeOfUser=Admin&action=edit&eid=<?php echo $row['scid']?>"><button class="btn btn-warning">Edit</button></a></td>
                                    <td><a href="subCategoryView.php?typeOfUser=Admin&action=delete&did=<?php echo $row['scid']?>"><button class="btn btn-danger">Delete</button></a></td>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
            <a href="subCategoryInsert.php?typeOfUser=Admin"><button class="btn btn-primary">Insert</button></a>
            </div>
        </div>
        
    </div>
    
<?php


include_once("footer.php");

?>