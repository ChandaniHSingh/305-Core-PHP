<?php

include_once("header.php");




$con = mysqli_connect('localhost','root','','chandani');

/*
$scid = "";
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
            $query = mysqli_query($con,"select count(*) from sc_sub_category where scid = $eid");
            while($countRow = mysqli_fetch_row($query)){
                if($countRow[0] == 1){
                    $query = mysqli_query($con,"select * from sc_sub_category where scid = $eid");
                    while($row = mysqli_fetch_assoc($query)){
                        $scid = $row['scid'];
                        $cid = $row['cid'];
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
    $scid = $_POST['txtscid'];
    $cid = $_POST['ddCID'];
    $name = $_POST['txtName'];
    $description = $_POST['txtDescription'];

    $imageUpload = false;
    $newfilename = "";

    $allowedExtImage = array('.pdf','.jpg','.png');


    if($scid != "" && $cid != "" && $name != "" && $description != ""){
        $imageUpload = true;
        // $filename = $_FILES['fileImage']['name'];
        // $basename = substr($filename,0,strripos($filename,'.'));
        // $ext = substr($filename,strripos($filename,'.'));
        // $size = $_FILES['fileImage']['size'];
        // $tmpname = $_FILES['fileImage']['tmp_name'];
        // if(in_array($ext,$allowedExtImage) && $size < 2000000){
        //     $newfilename = md5($basename).rand(50,500).$ext;
        //     if(!file_exists("./uploads/subcategory/".$newfilename)){
        //         move_uploaded_file($tmpname,"./uploads/subcategory/".$newfilename);
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
        $query = mysqli_query($con,"update sc_sub_category set cid = $cid ,name = '$name', description = '$description' ,photo = '$newfilename' where scid = $scid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:subCategoryView.php?typeOfUser=Admin");
    }
    else{
        // echo "<script>alert('Please Upload Image..');</script>";
        $query = mysqli_query($con,"update sc_sub_category set cid = $cid ,name = '$name', description = '$description' where scid = $scid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:subCategoryView.php?typeOfUser=Admin");
    }
}



?>


    <div class="container-fluid" style="min-height:80vh">
        
        <div class="row">
            <h1 class="title">SubCategory Edit</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <!-- <label for="scid" class="form-label">Category ID : </label> -->
                    <input type="hidden" name="txtscid" id="scid" value="<?php if(isset($scid)){ echo $scid; }?>" class="form-control" placeholder="Registration-ID"/>
                    </div>
                    <div>
                    <label for="cid" class="form-label">Category : </label>
                    <select name="ddCID" id="cid"  class="form-select" >
                        <option value="" disabled="disabled">Select Category</option>
                        <?php 
                        $query = "select * from sc_category";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $row['cid'] ?>" <?php if($row['cid'] == $cid){?>selected = "selected"<?php } ?>><?php echo $row['name'] ?></option>
                        <?php    
                        }
                        ?>
                        <!-- <option value="Food" <?php if(isset($category) && $category == "Food"){ ?>selected="selected" <?php }?>>Food</option>
                        <option value="Cosmetic" <?php if(isset($category) && $category == "Cosmetic"){ ?>selected="selected" <?php }?>>Cosmetic</option>
                        <option value="Fashion" <?php if(isset($category) && $category == "Fashion"){ ?>selected="selected" <?php }?>>Fashion</option> -->
                    </select>
                    </div>
                    <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($name)){ echo $name; }?>" class="form-control" placeholder="Name"/>
                    </div>
                    <div>
                    <label for="description" class="form-label">Description : </label>
                    <textarea name="txtDescription" id="description" cols="30" rows="5" class="form-control"><?php if(isset($description)){ echo $description; }?></textarea>
                    </div>
                    <!-- <div>
                    <label for="img" class="form-label">Photo : </label>
                    <input type="file" name="fileImage" id="img" value="<?php if(isset($photo)){ echo $photo; }?>" class="form-control" placeholder="Upload Img"/>
                    </div> -->
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