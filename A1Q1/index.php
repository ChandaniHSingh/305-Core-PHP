<?php
/* 
1. Create an array of an integer numbers and sort them in descending order. (Do not use builtin functions)
*/


    $arr = array();
    $n = 0;
    if(isset($_POST['btnSubmit'])){
        $n = $_POST['txtN'];
        if($n == ""){
            echo "<script>alert('Please enter value of N...')</script>";
        }
        elseif(is_numeric($n) && $n > 0){

            for($i=0;$i<$n;$i++){
                $arr[$i]=rand(-100,100);
            }
            /*
            echo "<br>Original Array : ";
            print_r($arr);
            */
            for($i = 0;$i < $n;$i++){
                for($j = 0;$j < $n ;$j++){
                    if($arr[$i] > $arr[$j]){
                        $temp = $arr[$i];
                        $arr[$i] = $arr[$j];
                        $arr[$j] = $temp;
                    }
                }
            }
            /*
            echo "<br>Descending Sorted Array : ";
            print_r($arr);
            */
        }
        elseif(!is_numeric($n)){
            echo "<script>alert('Please enter Numeric value of N...')</script>";
        }
        elseif($n <= 0){
            echo "<script>alert('Please enter greater than 0 value...')</script>";
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <h1 class="title">Array descending order</h1>
            <div class="col-md-4"></div>
            <div class="col-md-3">
                <form action="" method="post" class="form">
                    <input type="text" name="txtN" id="n" class="form-control" placeholder="Enter value of N " />
                    <input type="submit" value="Submit"  name="btnSubmit" id="submit" class="btn btn-success btn-large">
                </form>
            </div>
            <div class="col-md-1">
            
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <?php 
                for($i=0;$i<$n;$i++){
                ?>
                    <button disabled="disabled" class="btn btn-primary btn-large"><?php echo $arr[$i]; ?></button>
                <?php
                }
                
                ?>
            <div class="col-md-2"></div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>