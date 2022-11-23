<?php

include_once("header.php");




$con = mysqli_connect('localhost','root','','chandani');

/*
$cid = "";
$category = "";
$name = "";
$price = "";
$availQty = "";
$description = "";
$image = "";
*/
$imageUpload = false;


if(isset($_POST['btnInsert'])){
    $cid = $_POST['ddCID']; 
    $name = $_POST['txtName']; 
    $description = $_POST['txtDescription'];

    $imageUpload = false;
    $newfilename = "";

    $allowedExtImage = array('.jpeg','.jpg','.png');


    if($cid != "" && $name != "" && $description != ""){
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
        // $query = mysqli_query($con,"insert into sc_sub_category(cid,name,description,photo) values($cid,'$name','$description','$newfilename')");
        $query = mysqli_query($con,"insert into sc_sub_category(cid,name,description) values($cid,'$name','$description')");
        echo "<script>alert('Inserted Successfully..');</script>";
        header("location:subCategoryView.php?typeOfUser=Admin");
    }
    else{
        echo "<script>alert('Please Upload Image..');</script>";
    }
}



?>


    <div class="container-fluid" style="min-height:80vh">
        
        <div class="row">
            <h1 class="title">SubCategory Insert</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                <!--    
                    <div>
                    <label for="cid" class="form-label">Product ID : </label>
                    <input type="text" name="txtcid" id="cid" value="<?php if(isset($cid)){ echo $cid; }?>" class="form-control" placeholder="Registration-ID"/>
                    </div>
                -->
                    <div>
                    <label for="cid" class="form-label">Category : </label>
                    <select name="ddCID" id="cid"  class="form-select" >
                        <option value="" disabled="disabled">Select Category</option>
                        <?php 
                        $query = "select * from sc_category";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $row['cid'] ?>"><?php echo $row['name'] ?></option>
                        <?php    
                        }
                        ?>
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
                    
                    <input type="submit" name="btnInsert" id="insert" value="Insert" class="btn btn-success btn-small"/>
                    </div>
                    
                    
                </form>   
            </div>
            <div class="col-md-2"></div>
        </div>
        
    </div>


<?php


include_once("footer.php");

?>