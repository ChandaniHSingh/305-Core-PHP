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
            $query = mysqli_query($con,"select count(*) from sc_product where pid = $eid");
            while($countRow = mysqli_fetch_row($query)){
                if($countRow[0] == 1){
                    $query = mysqli_query($con,"select * from sc_product where pid = $eid");
                    while($row = mysqli_fetch_assoc($query)){
                        $pid = $row['pid'];
                        $cid = $row['cid'];
                        $scid = $row['scid'];
                        $name = $row['name'];
                        $description = $row['description'];
                       // $photo = $row['photo'];
                        $availQty = $row['avail_qty'];
                        $price = $row['price'];

                        
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

    $allowedExtImage = array('.pdf','.jpg','.png');


    if($pid != "" && $name != "" && $description != ""){
        $filename = $_FILES['fileImage']['name'];
        $basename = substr($filename,0,strripos($filename,'.'));
        $ext = substr($filename,strripos($filename,'.'));
        $size = $_FILES['fileImage']['size'];
        $tmpname = $_FILES['fileImage']['tmp_name'];
        if(in_array($ext,$allowedExtImage) && $size < 2000000){
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
        $result = mysqli_query($con,"select * from sc_product where pid = $pid");
        while($row = mysqli_fetch_assoc($result)){
            try{unlink($current_path."uploads/product/".$row['photo']);}
            catch(Exception){}
        }

        $query = mysqli_query($con,"update sc_product set name = '$name', description = '$description' ,photo = '$newfilename' where pid = $pid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:productView.php?typeOfUser=Admin");
    }
    else{
        // echo "<script>alert('Please Upload Image..');</script>";
        $query = mysqli_query($con,"update sc_product set name = '$name', description = '$description' where pid = $pid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:productView.php?typeOfUser=Admin");
    }
}



?>


<!-- 
<script>
    $(document).ready(function(){
        subCategoryFun(<?php echo $cid ?>);
    })

    function subCategoryFun(catid){
        
       // alert("Your Browser not supporting AJAX...");

        var xmlhttp;
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else if(window.ActiveXObject){
            xmlhttp = new ActiveXObject();
        }
        else{
            alert("Your Browser not supporting AJAX...");
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4){
                document.getElementById('scid').innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET","./ajax/ajaxSubCategory.php?catid="+catid);
        xmlhttp.send(null);

    }
    </script> -->


    <div class="container-fluid" style="min-height:80vh">
        
        <div class="row">
            <h1 class="title">Product Edit</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <!-- <label for="pid" class="form-label">Product ID : </label> -->
                    <input type="hidden" name="txtPid" id="pid" value="<?php if(isset($pid)){ echo $pid; }?>" class="form-control" placeholder="Registration-ID"/>
                    </div><div>
                    <label for="cid" class="form-label">Category : </label>
                    <select name="ddCID" id="cid"  class="form-select"  disabled="disabled">
                        <option value="" disabled="disabled">Select Category</option>
                        <?php 
                        $query = "select * from sc_category";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $row['cid'] ?>" <?php if(isset($cid)){ if($cid == $row['cid']){ ?> selected="selected" <?php }} ?>><?php echo $row['name'] ?></option>
                        <?php $cur_cid = $row['cid'];?>
                        <?php    
                        }
                        ?>
                    </select>
                    </div>

                    <div>
                    <label for="scid" class="form-label">SubCategory : </label>
                    <select name="ddSCID" id="scid"  class="form-select"  disabled="disabled">
                        <option value="" disabled="disabled">Select SubCategory</option>
                        <?php 
                        $query = "select * from sc_sub_category where cid = '$cid'";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo $row['name'];
                        ?>

                        <option value="<?php echo $row['scid'] ?>" <?php if(isset($scid)){ if($scid == $row['scid']){ ?> selected="selected" <?php }} ?>><?php echo $row['name'] ?></option>
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
                    <div>
                    <label for="img" class="form-label">Photo : </label>
                    <input type="file" name="fileImage" id="img" value="<?php if(isset($photo)){ echo $photo; }?>" class="form-control" placeholder="Upload Img"/>
                    </div>
                    <div>
                    <label for="availQty" class="form-label">Available Qty : </label>
                    <input type="number" name="numAvailQty" id="availQty" value="<?php if(isset($availQty)){ echo $availQty; }?>" class="form-control" placeholder="Available Qty"/>
                    </div>
                    <div>
                    <label for="price" class="form-label">Price : </label>
                    <input type="number" name="numPrice" id="price" value="<?php if(isset($price)){ echo $price; }?>" class="form-control" placeholder="Price"/>
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