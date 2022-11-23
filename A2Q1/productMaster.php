<?php

include_once("header.php");

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
$imageUpload = true;
$newfilename = "";

if(isset($_POST['btnInsert'])){
    $name = $_POST['txtName']; 
    $description = $_POST['txtDescription'];

    $allowedExtImage = array('.jpeg','.jpg','.png');


    if($name != "" && $description != ""){
        
        // $filename = $_FILES['fileImage']['name'];
        // $basename = substr($filename,0,strripos($filename,'.'));
        // $ext = substr($filename,strripos($filename,'.'));
        // $size = $_FILES['fileImage']['size'];
        // $tmpname = $_FILES['fileImage']['tmp_name'];
        // if(in_array($ext,$allowedExtImage) && $size < 2000000){
        //     $newfilename = md5($basename).rand(50,500).$ext;
        //     if(!file_exists("./uploads/".$newfilename)){
        //         move_uploaded_file($tmpname,"./uploads/".$newfilename);
        //         $imageUpload = true;
        //     }
        //     else{
        //         echo "<script>alert('Photo File Already Exists...')</script>";
        //     }
        // }
        // else if($size >= 2000000){
        //     echo "<script>alert('Photo File size should be less than 2000000 KB...')</script>";
        // }
        // else{
        //     echo "<script>alert('Photo File Format Allowed is : ".implode(',',$allowedExtPhoto)."')</script>";
        // }
        
    }
    else{
        echo "<script>alert('Please fill all Fields...');</script>";
    }


    if($imageUpload){
        $query = mysqli_query($con,"insert into eir_product(name,description,photo) values('$name','$description','$newfilename')");
        echo "<script>alert('Inserted Successfully..');</script>";
    }
    else{
        echo "<script>alert('Please Upload Image..');</script>";
    }
}

if(isset($_POST['btnSearch'])){
    $pid = $_POST['txtPid'];
    
    if($pid != ""){
        $query = mysqli_query($con,"select count(*) from eir_product where pid = $pid");
        while($countRow = mysqli_fetch_row($query)){
            if($countRow[0] == 1){
                $query = mysqli_query($con,"select * from eir_product where pid = $pid");
                while($row = mysqli_fetch_assoc($query)){
                    $pid = $row['pid'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $image = $row['photo'];
                }
                echo "<script>alert('Found Successfully..');</script>";
            }
            else{
                echo "<script>alert('No Record Found..');</script>";
            }
        }
    }
    
}

if(isset($_POST['btnUpdate'])){
    $pid = $_POST['txtPid'];
    $name = $_POST['txtName'];  
    $description = $_POST['txtDescription'];

    $imageUpload = true;
    $newfilename = "";
    $allowedExtImage = array('.pdf','.jpg','.png');


    if($pid != "" && $name != "" && $description != ""){
        // $filename = $_FILES['fileImage']['name'];
        // $basename = substr($filename,0,strripos($filename,'.'));
        // $ext = substr($filename,strripos($filename,'.'));
        // $size = $_FILES['fileImage']['size'];
        // $tmpname = $_FILES['fileImage']['tmp_name'];
        // if(in_array($ext,$allowedExtImage) && $size < 2000000){
        //     $newfilename = md5($basename).rand(50,500).$ext;
        //     if(!file_exists("./uploads/".$newfilename)){
        //         move_uploaded_file($tmpname,"./uploads/".$newfilename);
        //         $imageUpload = true;
        //     }
        //     else{
        //         echo "<script>alert('Photo File Already Exists...')</script>";
        //     }
        // }
        // else if($size >= 2000000){
        //     echo "<script>alert('Photo File size should be less than 2000000 KB...')</script>";
        // }
        // else{
        //     echo "<script>alert('Photo File Format Allowed is : ".implode(',',$allowedExtPhoto)."')</script>";
        // }
    }
    else{
        echo "<script>alert('Please fill all Fields...');</script>";
    }


    if($imageUpload){
        $query = mysqli_query($con,"update eir_product set name = '$name', description = '$description' ,photo = '$newfilename' where pid = $pid");
        echo "<script>alert('Updated Successfully..');</script>";
    }
    else{
        echo "<script>alert('Please Upload Image..');</script>";
    }
}

if(isset($_POST['btnDelete'])){
    $pid = $_POST['txtPid'];
    if($pid != ""){
        $query = mysqli_query($con,"select count(*) from eir_product where pid = $pid");
        while($countRow = mysqli_fetch_row($query)){
            if($countRow[0] == 1){
                $query = mysqli_query($con,"delete from eir_product where pid = $pid");
                echo "<script>alert('Deleted Successfully..');</script>";
            }
            else{
                echo "<script>alert('No Record Found..');</script>";
            }
        }

    }
    
}


?>


    <div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Product  Master</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <label for="pid" class="form-label">Product  ID : </label>
                    <input type="text" name="txtPid" id="pid" value="<?php if(isset($pid)){ echo $pid; }?>" class="form-control" placeholder="Product-ID"/>
                    </div>
                    <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($name)){ echo $name; }?>" class="form-control" placeholder="Name"/>
                    </div>
                    <div>
                    <label for="description" class="form-label">Description : </label>
                    <textarea name="txtDescription" id="description" cols="30" rows="5" class="form-control"><?php if(isset($description)){ echo $description; }?></textarea>
                    </div>
                    <div>
                    <label for="img" class="form-label">Image : </label>
                    <input type="file" name="fileImage" id="img" value="<?php if(isset($image)){ echo $image; }?>" class="form-control" placeholder="Upload Img"/>
                    </div>
                    <div style="text-align:center">
                    
                    <input type="submit" name="btnInsert" id="insert" value="Insert" class="btn btn-success btn-small"/>
                    
                    
                    <input type="submit" name="btnUpdate" id="update" value="Update" class="btn btn-success btn-small"/>
                    <input type="submit" name="btnDelete" id="delete" value="Delete" class="btn btn-success btn-small"/>
                    <input type="submit" name="btnSearch" id="search" value="Search" class="btn btn-success btn-small"/>
                    </div>
                    
                    
                </form>   
            </div>
            <div class="col-md-2"></div>
        </div>


        <div class="b-example-divider"></div>


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
                                    <td><a target="_blank" href="./uploads/<?php echo $row['photo']?>"><img src="./uploads/<?php echo $row['photo']?>" alt="<?php echo $row['photo']?>"></a></td>
                                    <td><a href="productMaster.php?typeOfUser=Admin&action=edit&id=<?php echo $row['pid']?>"><button class="btn btn-warning">Edit</button></a></td>
                                    <td><a href="productMaster.php?typeOfUser=Admin&action=delete&id=<?php echo $row['pid']?>"><button class="btn btn-danger">Delete</button></a></td>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
        
    </div>


<?php


include_once("footer.php");

?>