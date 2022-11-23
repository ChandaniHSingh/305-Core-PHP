<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');

if($_SESSION['typeOfUser'] == 'Admin'){

// if(isset($_GET['action'])){
//     if($_GET['action'] == 'delete'){
//         $did = $_GET['did'];
//         if($did != ""){
//             $query = mysqli_query($con,"select * from sc_sales where sid = $did");
//             if(mysqli_fetch_row($query)){
//                 $query = mysqli_query($con,"delete from sc_sales where sid = $did");
//                 echo "<script>alert('Deleted Successfully..');</script>";
//             }
//             else{
//                 echo "<script>alert('No Record Found..');</script>";
//             }
    
//         }
//     }
// }

?>

    <script>
        //document.getElementById("edate").value = new Date();
        function dateWiseSalesFun(){

            // var ssdate = new Date("2000-01-01");
           var sdate = document.getElementById("sdate").value;
            var edate = document.getElementById("edate").value;
        
        // alert("Your Browser not supporting AJAX...");
 
         var xmlhttp = new XMLHttpRequest();
         
         xmlhttp.onreadystatechange = function(){
             if(xmlhttp.readyState == 4){
                 document.getElementById('showData').innerHTML=xmlhttp.responseText;
             }
         }
 
         xmlhttp.open("GET","./ajax/ajaxDateWiseSales.php?sdate="+sdate+"&edate="+edate);
         xmlhttp.send(null);
 
     }
    </script>
    <div class="container-fluid" style="min-height:80vh" onload="dateWiseSalesFun()">
    <div class="row tableRow">
            <h1 class="title">All Sales</h1>
            <hr>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                  
                    <div class="row">
                        <div class="col-md-6">
                            <label for="scid" class="form-label">Start Date : </label>
                            <input type="date" name="startDate" class="form-control" id="sdate" value="<?php echo date('Y-m-d')?>" onchange="dateWiseSalesFun();">
                        </div>
                        <div class="col-md-6">
                            <label for="scid" class="form-label">End Date : </label>
                            <input type="date" name="endDate" class="form-control" id="edate" value="<?php echo date('Y-m-d')?>" onchange="dateWiseSalesFun();">
                        
                        </div>
                    </div>

                    
                </form>

                
                <div class="row">
                    <table class="table table-hover table-primary table-bordered">
                        <thaed>
                            <tr>
                                <td class="head">sid</td>
                                <td class="head">pid</td>
                                <td class="head">qty</td>
                                <td class="head">amt</td>
                                <td class="head">date-Time</td>
                            </tr>
                        </thaed>
                        <tbody id="showData">
                        </tbody>
                    </table>
                </div>
                        
            </div>
            <div class="col-md-1">
            
            </div>
        </div>
        
    </div>
    
<?php
    
}

elseif($_SESSION['typeOfUser'] == 'Customer'){
    echo "<script>alert('Not Valid User for this page....')</scripDate>";
}
else{
    echo "<script>alert('First Login....')</script>";
    header("location:index.php");
}
include_once("footer.php");

?>