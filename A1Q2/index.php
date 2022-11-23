<?php
/*
2. Develop a PHP application for a simple calculator
*/


    $n1 = "";
    $n2 = "";
    $ans = "";
    if(isset($_POST['btnSubmit'])){
        $n1 = $_POST['txtN1'];
        $n2 = $_POST['txtN2'];
        $op = $_POST['btnSubmit'];
        if($n1 == "" || $n2 == ""){
            echo "<script>alert('Please enter value of both N1 and N2...');</script>";
        }
        elseif(!is_numeric($n1) || !is_numeric($n2)){
            echo "<script>alert('Please enter Numeric value of both N1 and N2...');</script>";
        }
        else{
            switch($op){
                case '+':
                        $ans = $n1 + $n2;
                        break;
                case '-':
                        $ans = $n1 - $n2;
                        break;
                case '*':
                        $ans = $n1 * $n2;
                        break;
                case '/':
                        $ans = $n1 / $n2;
                        break;
                case '%':
                        $ans = $n1 % $n2;
                        break;
                case '**':
                        $ans = $n1 ** $n2;
                        break;
                default:
                        echo "<script>alert('Please enter valid Operation...');</script>";
                        break;
            }
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
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <h1 class="title">Simple Calculator</h1>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 calc">
                <form action="" method="post" class="form">
                    <input type="text" name="txtN1" id="n1" class="form-control" placeholder="Num-1" value="<?php if($n1 != "") echo $n1;?>"/>
                    <input type="text" name="txtN2" id="n2" class="form-control" placeholder="Num-2" value="<?php if($n2 != "") echo $n2;?>" />
                    <input type="submit" value="+"  name="btnSubmit" id="add" class="btn btn-primary btn-large"/>
                    <input type="submit" value="-"  name="btnSubmit" id="sub" class="btn btn-primary btn-large"/>
                    <input type="submit" value="*"  name="btnSubmit" id="mul" class="btn btn-primary btn-large"/>
                    <input type="submit" value="/"  name="btnSubmit" id="div" class="btn btn-primary btn-large"/>
                    <input type="submit" value="%"  name="btnSubmit" id="mod" class="btn btn-primary btn-large"/>
                    <input type="submit" value="**"  name="btnSubmit" id="exp" class="btn btn-primary btn-large"/>
                    <input type="text" name="txtAns" id="ans" disabled="disabled" class="form-control" placeholder="Ans 0" value="<?php if($ans != "") echo $ans;?>"/>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>