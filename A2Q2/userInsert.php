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

if($_GET['typeOfUser'] == 'Customer'){
    $typeofuser = 'Customer';
}
$imageUpload = false;


if(isset($_POST['btnInsert'])){
    $name = $_POST['txtName'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword']; 
    $age = $_POST['numAge']; 
    $phone = $_POST['txtPhone']; 

    $allowedExtImage = array('.jpeg','.jpg','.png');


    if($name != "" && $email != "" && $password != "" && $age != "" && $phone != ""){
        $filename = $_FILES['filePhoto']['name'];
        $basename = substr($filename,0,strripos($filename,'.'));
        $ext = substr($filename,strripos($filename,'.'));
        $size = $_FILES['filePhoto']['size'];
        $tmpname = $_FILES['filePhoto']['tmp_name'];
        if(in_array($ext,$allowedExtImage) && $size < 3000000){
            $newfilename = md5($basename).rand(50,500).$ext;
            if(!file_exists("./uploads/user/".$newfilename)){
                move_uploaded_file($tmpname,"./uploads/user/".$newfilename);
                $imageUpload = true;
            }
            else{
                echo "<script>alert('Photo File Already Exists...')</script>";
            }
        }
        else if($size >= 3000000){
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
        $query = mysqli_query($con,"insert into sc_user(name,email,password,age,phone,photo,typeofuser) values('$name','$email','$password',$age,'$phone','$newfilename','Customer')");
        echo "<script>alert('Inserted Successfully..');</script>";
        if($typeofuser == 'Customer'){
            header("location:index.php?nowLogin=true");
        }
        
    }
    else{
        echo "<script>alert('Please Upload Image..');</script>";
    }
}



?>


    <div class="container-fluid" style="min-height:80vh">
        
        <div class="row">
            <?php if($typeofuser == 'Customer'){ ?>
            <h1 class="title">Customer Registration</h1>
            <?php } ?>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                <!--    
                    <div>
                    <label for="pid" class="form-label">Product ID : </label>
                    <input type="text" name="txtPid" id="pid" value="<?php if(isset($uid)){ echo $uid; }?>" class="form-control" placeholder="Registration-ID"/>
                    </div>
                -->
                    
                    <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($name)){ echo $name; }?>" class="form-control" placeholder="Name"/>
                    </div>
                    <div>
                    <label for="email" class="form-label">Email : </label>
                    <input type="email" name="txtEmail" id="email" value="<?php if(isset($email)){ echo $email; }?>" class="form-control" placeholder="Email"/>
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