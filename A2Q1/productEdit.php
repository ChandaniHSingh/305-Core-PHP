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


$imageUpload = false;


if(isset($_GET['action'])){
    if($_GET['action'] == 'edit'){
        $eid = $_GET['eid'];

        if($eid != ""){
            $query = mysqli_query($con,"select count(*) from eir_product where pid = $eid");
            while($countRow = mysqli_fetch_row($query)){
                if($countRow[0] == 1){
                    $query = mysqli_query($con,"select * from eir_product where pid = $eid");
                    while($row = mysqli_fetch_assoc($query)){
                        $pid = $row['pid'];
                        $name = $row['name'];
                        $description = $row['description'];
                        $photo = $row['photo'];
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
    $pid = $_POST['txtPid'];
    $name = $_POST['txtName'];
    $description = $_POST['txtDescription'];

    $imageUpload = false;
    $newfilename = "";

    $allowedExtPhoto = array('.pdf','.jpg','.png');


    if($pid != "" && $name != "" && $description != ""){
        $filename = $_FILES['fileImage']['name'];
        $basename = substr($filename,0,strripos($filename,'.'));
        $ext = substr($filename,strripos($filename,'.'));
        $size = $_FILES['fileImage']['size'];
        $tmpname = $_FILES['fileImage']['tmp_name'];
        if(in_array($ext,$allowedExtPhoto) && $size < 2000000){
            $newfilename = md5($basename).rand(50,500).$ext;
            if(!file_exists("./uploads/product/".$newfilename)){
                move_uploaded_file($tmpname,"./uploads/product/".$newfilename);
                $imageUpload = true;
            }
            else{
                echo "<script>alert('Photo File Already Exists...')</script>";
            }
        }
        else if($size >= 2000000){
            echo "<script>alert('Photo File size should be less than 2000000 KB...')</script>";
        }
        else{
            echo "<script>alert('Photo File Format Allowed is : ".implode(',',$allowedExtPhoto)."')</script>";
        }
    }
    else{
        echo "<script>alert('Please fill all Fields...');</script>";
    }


    if($imageUpload){
        // Delete previous Photo
        $result = mysqli_query($con,"select * from eir_product where pid = $pid");
        while($row = mysqli_fetch_assoc($result)){
            try{unlink($current_path."uploads/product/".$row['photo']);}
            catch(Exception){}
        }

        $query = mysqli_query($con,"update eir_product set name = '$name', description = '$description' ,photo = '$newfilename' where pid = $pid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:productView.php?typeOfUser=Admin");
    }
    else{
        // echo "<script>alert('Please Upload Image..');</script>";
        $query = mysqli_query($con,"update eir_product set name = '$name', description = '$description' where pid = $pid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:productView.php?typeOfUser=Admin");
    }
}



?>


    <div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Product Edit</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <!-- <label for="pid" class="form-label">Product ID : </label> -->
                    <input type="hidden" name="txtPid" id="pid" value="<?php if(isset($pid)){ echo $pid; }?>" class="form-control" placeholder="Registration-ID"/>
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
                    <label for="img" class="form-label">Photo : </label>
                    <input type="file" name="fileImage" id="img" value="<?php if(isset($photo)){ echo $photo; }?>" class="form-control" placeholder="Upload Img"/>
                    </div>
                    <div style="text-align:center">
                    <input type="submit" name="btnUpdate" id="update" value="Update" class="btn btn-success btn-small"/>
                    </div>
                    
                    
                </form>   
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

        

<?php


include_once("footer.php");

?>