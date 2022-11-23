<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');

if($_SESSION['typeOfUser'] == 'Admin'){


?>

<?php
    
}

elseif($_SESSION['typeOfUser'] == 'Customer'){
 
    $uid = $_SESSION['uid'];


    ?>
    
    <div class="container-fluid">
        <div class="row tableRow">
            <h1 class="title">Thank You for Shopping</h1>
            <h2 class="title">Visit Again</h2>
        </div>
    </div>
<?php
}

include_once("footer.php");

?>