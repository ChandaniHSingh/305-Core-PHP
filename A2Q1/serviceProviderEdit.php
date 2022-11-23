<?php

include_once("header.php");




$con = mysqli_connect('localhost','root','','chandani');

/*
$uid = "";
$category = "";
$name = "";
$price = "";
$availQty = "";
$description = "";
$image = "";
*/



if(isset($_GET['action'])){
    if($_GET['action'] == 'edit'){
        $eid = $_GET['eid'];

        if($eid != ""){
            $query = mysqli_query($con,"select count(*) from eir_user where uid = $eid and typeofuser = 'Service Provider'");
            while($countRow = mysqli_fetch_row($query)){
                if($countRow[0] == 1){
                    $query = mysqli_query($con,"select * from eir_user where uid = $eid and typeofuser = 'Service Provider'");
                    while($row = mysqli_fetch_assoc($query)){
                        $uid = $row['uid'];
                        $name = $row['name'];
                        $password = $row['password'];
                        $age = $row['age'];
                        $phone = $row['phone'];
                        //$photo = $row['photo'];
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
    $uid = $_POST['txtUid'];
    $name = $_POST['txtName'];
    $password = $_POST['txtPassword']; 
    $age = $_POST['numAge']; 
    $phone = $_POST['txtPhone']; 



    $imageUpload = false;

    $allowedExtPhoto = array('.pdf','.jpg','.png');


    if($uid != "" && $name != "" && $password != "" && $age != "" && $phone != ""){
        $filename = $_FILES['filePhoto']['name'];
        $basename = substr($filename,0,strripos($filename,'.'));
        $ext = substr($filename,strripos($filename,'.'));
        $size = $_FILES['filePhoto']['size'];
        $tmpname = $_FILES['filePhoto']['tmp_name'];
        if(in_array($ext,$allowedExtPhoto) && $size < 2000000){
            $newfilename = md5($basename).rand(50,500).$ext;
            if(!file_exists("./uploads/user/".$newfilename)){
                move_uploaded_file($tmpname,"./uploads/user/".$newfilename);
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
        $result = mysqli_query($con,"select * from eir_user where uid = $uid");
        while($row = mysqli_fetch_assoc($result)){
            try{unlink($current_path."uploads/user/".$row['photo']);}
            catch(Exception){}
        }

        $query = mysqli_query($con,"update eir_user set name = '$name', password = '$password', age = '$age' , phone = '$phone'  ,photo = '$newfilename' where uid = $uid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:serviceProviderView.php?typeOfUser=Admin");
    }
    else{
        // echo "<script>alert('Please Upload Image..');</script>";
        $query = mysqli_query($con,"update eir_user set name = '$name', password = '$password', age = '$age' , phone = '$phone' where uid = $uid");
        echo "<script>alert('Updated Successfully..');</script>";
        header("location:serviceProviderView.php?typeOfUser=Admin");
    }
}



?>


    <div class="container-fluid">
        
        <div class="row">
            <h1 class="title">Service Provider Edit</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <label for="uid" class="form-label">Service Provider ID : </label>
                    <input type="text" name="txtUid" id="uid" value="<?php if(isset($uid)){ echo $uid; }?>" class="form-control" placeholder="Registration-ID"/>
                    </div>
                    <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($name)){ echo $name; }?>" class="form-control" placeholder="Name"/>
                    </div>
                    <div>
                    <label for="password" class="form-label">Password : </label>
                    <input type="password" name="txtPassword" id="password" value="<?php if(isset($password)){ echo $password; }?>" class="form-control" placeholder="Password"/>
                    </div>
                    <div>
                    <label for="age" class="form-label">Age : </label>
                    <input type="number" name="numAge" id="age" value="<?php if(isset($age)){ echo $age; }?>" class="form-control" placeholder="Age"/>
                    </div>
                    <div>
                    <label for="phone" class="form-label">Phone : </label>
                    <input type="text" name="txtPhone" id="phone" value="<?php if(isset($phone)){ echo $phone; }?>" class="form-control" placeholder="Phone"/>
                    </div>
                    <div>
                    <label for="photo" class="form-label">Photo : </label>
                    <input type="file" name="filePhoto" id="photo" value="<?php if(isset($photo)){ echo $photo; }?>" class="form-control" placeholder="Upload photo"/>
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