<?php
/*
4. Create a registration form with following fields.
• Registration ID (Must start with E and maximum of 4 characters long)
• Name
• Password
• Retype Password (Password and Retype password must be same)
• Gander
• Address
• Area of Specialization (use dropdown list with multiple selection)
• Upload photo and resume of a candidate
*/

    $flag = false;
    $photoUpload = false;
    $resumeUpload = false;
    $newfilenamePhoto = null;
    $newfilenameResume = null;
    if(isset($_POST['btnSubmit'])){
        $regiID = $_POST['txtRegiID'];
        $name = $_POST['txtName'];
        $password = $_POST['txtPassword'];
        $rePassword = $_POST['txtRePassword'];
        $gender = ($_POST['rdbGender']==null)?null:$_POST['rdbGender'];
        //$gender = $_POST['rdbGender'];
        $address = nl2br($_POST['txtAddress']);
        $aos = $_POST['ddAos'];
        $photo = $_FILES['filePhoto'];
        $resume = $_FILES['fileResume'];

        $allowedExtPhoto = array('.pdf','.jpg','.png');
        $allowedExtResume = array('.pdf','.jpg','.txt');

        if($regiID != "" && $name != "" && $password != "" && $rePassword != "" && $gender != "" && $address != "" && $aos != ""){
            // regiTD (Must start with E and maximum of 4 characters long)
            if(strncmp($regiID,'E',1) == 0 && strlen($regiID) <= 4){
                //(Password and Retype password must be same)
                if($password == $rePassword){
                    //Photo Upload
                    $filename = $_FILES['filePhoto']['name'];
                    $basename = substr($filename,0,strripos($filename,'.'));
                    $ext = substr($filename,strripos($filename,'.'));
                    $size = $_FILES['filePhoto']['size'];
                    $tmpname = $_FILES['filePhoto']['tmp_name'];
                    if(in_array($ext,$allowedExtPhoto) && $size < 2000000){
                        $newfilename = md5($basename).rand(50,500).$ext;
                        if(!file_exists("./uploads/photo/".$newfilename)){
                            move_uploaded_file($tmpname,"./uploads/photo/".$newfilename);
                            $photoUpload = true;
                            $newfilenamePhoto = $newfilename;
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

                    //Resume Upload
                    $filename = $_FILES['fileResume']['name'];
                    $basename = substr($filename,0,strripos($filename,'.'));
                    $ext = substr($filename,strripos($filename,'.'));
                    $size = $_FILES['fileResume']['size'];
                    $tmpname = $_FILES['fileResume']['tmp_name'];
                    if(in_array($ext,$allowedExtResume) && $size < 2000000){
                        $newfilename = md5($basename).rand(50,500).$ext;
                        if(!file_exists("./uploads/resume/".$newfilename)){
                            move_uploaded_file($tmpname,"./uploads/resume/".$newfilename);
                            $resumeUpload = true;
                            $newfilenameResume = $newfilename;

                            if($photoUpload && $resumeUpload){
                                $flag = true;
                            }
                            else if(!$photoUpload){
                                echo "<script>alert('Photo Not Uploaded....')</script>";
                            }
                            else if(!$resumeUpload){
                                echo "<script>alert('Resume Not Uploaded....')</script>";
                            }
                            else{
                                echo "<script>alert('Uncaught Error.....')</script>";
                            }


                        }
                        else{
                            echo "<script>alert('Resume File Already Exists...')</script>";
                        }
                    }
                    else if($size >= 2000000){
                        echo "<script>alert('Resume File size should be less than 2000000 KB...')</script>";
                    }
                    else{
                        echo "<script>alert('Resume File Format Allowed is : ".implode(',',$allowedExtResume)."')</script>";
                    }
                }
                else{
                    echo "<script>alert('Password ans ReType Password Mismatched...')</script>";
                }
            }
            else if(strlen($regiID) > 4){
                echo "<script>alert('Registration ID Must be less than 5...')</script>";
            }
            else if(strncmp($regiID,'E',1) != 0){
                echo "<script>alert('Registration ID Must Start with E only...')</script>";
            }
        }
        else{
            echo "<script>alert('Please fill all the details....')</script>";
        }

        
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container-fluid">
        
    <?php if(!$flag){?>
        <div class="row">
            <h1 class="title">Registration-Form</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                    <div>
                    <label for="regiId" class="form-label">Registration ID : </label>
                    <input type="text" name="txtRegiID" id="regiID" value="<?php if(isset($regiID)){ echo $regiID ; }?>" class="form-control" placeholder="Registration-ID"/>
                    </div>
                    <div>
                    <label for="name" class="form-label">Name : </label>
                    <input type="text" name="txtName" id="name" value="<?php if(isset($name)){ echo $name; }?>" class="form-control" placeholder="Name"/>
                    </div>
                    <div>
                    <label for="password" class="form-label">Paasword : </label>
                    <input type="password" name="txtPassword" id="password" value="<?php if(isset($password)){ echo $password; }?>" class="form-control" placeholder="Password"/>
                    </div>
                    <div>
                    <label for="rePassword" class="form-label">Retype Password : </label>
                    <input type="password" name="txtRePassword" id="rePassword" value="<?php if(isset($rePassword)){ echo $rePassword; }?>" class="form-control" placeholder="ReType-Password"/>
                    </div>
                    <div>
                    <label for="gender" class="form-label">Gender : </label><br>
                    <input type="radio" name="rdbGender" id="male" value="Male" class="form-check-input" <?php if(isset($gender) && $gender == 'Male'){?>checked="checked"<?php }?>/>
                    <label class="form-check-label" for="male">
                            Male
                    </label>
                    <input type="radio" name="rdbGender" id="female" value="Female" class="form-check-input" <?php if(isset($gender) && $gender == 'Female'){?>checked="checked"<?php }?>/>
                    <label class="form-check-label" for="female">
                            Female
                    </label>
                    </div>
                    <div>
                    <label for="address" class="form-label">Address : </label>
                    <textarea name="txtAddress" id="address" cols="30" rows="5" class="form-control"><?php if(isset($address)){ echo $address; }?></textarea>
                    </div>
                    <div>
                    <label for="aos" class="form-label">Area of Specialization : </label>
                    <select name="ddAos[]" id="aos"  class="form-select" multiple >
                        <option value="" disabled="disabled">Select Area of Interest</option>
                        <option value="Data Analist">Data Analist</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Web Developer">Web Developer</option>
                        <option value="Designer">Designer</option>
                        <option value="Data Analist">Data Analist</option>
                    </select>
                    
                    </div>
                    <div>
                    <label for="photo" class="form-label">Photo : </label>
                    <input type="file" name="filePhoto" id="photo" value="<?php if(isset($photo)){ echo $photo; }?>" class="form-control" placeholder="Upload Photo"/>
                    </div>
                    <div>
                    <label for="photo" class="form-label">Resume : </label>
                    <input type="file" name="fileResume" id="resume" value="<?php if(isset($resume)){ echo $resume; }?>" class="form-control" placeholder="Upload resume"/>
                    </div>
                    <div style="text-align:center">
                    
                    <input type="submit" name="btnSubmit" id="submit" value="Submit" class="btn btn-success btn-small"/>
                    <input type="reset" name="btnReset" id="reset" value="Reset" class="btn btn-primary"/>
                    </div>
                    
                    
                </form>   
            </div>
            <div class="col-md-2"></div>
        </div>
        <?php } ?>
        <?php if($flag){?>
        <div class="row tableRow">
            <h1 class="title">Registration-Form Details Result</h1>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-hover table-primary table-bordered">
                    <tbody>
                        <tr>
                            <td class="head">RegiID</td>
                            <td><?php if(isset($regiID)){ echo $regiID; }?></td>
                        </tr>
                        <tr>
                            <td class="head">Name</td>
                            <td><?php if(isset($name)){ echo $name; }?></td>
                        </tr>
                        <tr>
                            <td class="head">Password</td>
                            <td><?php if(isset($password)){ echo $password; }?></td>
                        </tr>
                        <tr>
                            <td class="head">Gender</td>
                            <td><?php if(isset($gender)){ echo $gender; }?></td>
                        </tr>
                        <tr>
                            <td class="head">Address</td>
                            <td><?php if(isset($address)){ echo $address; }?></td>
                        </tr>
                        <tr>
                            <td class="head">Area Of Specialization</td>
                            <td><?php if(isset($aos)){ 
                                foreach($aos as $a){
                                    echo $a."  ";
                                }
                             }?></td>
                        </tr>
                        <tr>
                            <td class="head">Photo</td>
                            <td><a target="_blank" href="./uploads/photo/<?php if(isset($photo))echo $newfilenamePhoto;?>"><?php if(isset($photo))echo $photo['name']?></a></td>
                        </tr>
                        <tr>
                            <td class="head">Resume</td>
                            <td><a target="_blank" href="./uploads/resume/<?php if(isset($resume))echo $newfilenameResume;?>"><?php if(isset($resume))echo $resume['name']?></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
        
        <?php }?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>