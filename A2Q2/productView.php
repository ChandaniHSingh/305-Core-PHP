<?php

include_once("header.php");

$con = mysqli_connect('localhost','root','','chandani');

if($_SESSION['typeOfUser'] == 'Admin'){

if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        $did = $_GET['did'];
        if($did != ""){
            $result = mysqli_query($con,"select * from sc_product where pid = $did");
            if($row = mysqli_fetch_assoc($result)){
                try{unlink($current_path."uploads/product/".$row['photo']);}
                catch(Exception){}
                $query = mysqli_query($con,"delete from sc_product where pid = $did");
                echo "<script>alert('Deleted Successfully..');</script>";
            }
            else{
                echo "<script>alert('No Record Found..');</script>";
            }
    
        }
    }
}

?>



    <div class="container-fluid">
        <div class="row tableRow">
            <h1 class="title">All Products</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
            
                <table class="table table-hover table-primary table-bordered">
                <thaed>
                        <tr>
                            <td class="head">pid</td>
                            <td class="head">cid</td>
                            <td class="head">scid</td>
                            <td class="head">name</td>
                            <td class="head">description</td>
                            <td class="head">photo</td>
                            <td class="head">avail_qty</td>
                            <td class="head">price</td>
                            <td class="head" colspan="2">Action</td>
                        </tr>
                    </thaed>
                    <tbody>
                        
                        <?php 
                            $result = mysqli_query($con,"select * from sc_product order by pid desc");

                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['pid']?></td>
                                    <?php 
                                    $cid = $row['cid'];
                                    $result2 = mysqli_query($con,"select * from sc_category where cid=$cid");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        $cname = $row2['name'];
                                    }
                                    ?>
                                    <td><?php echo $cname?></td>
                                    <?php 
                                    $scid = $row['scid'];
                                    $result2 = mysqli_query($con,"select * from sc_sub_category where scid=$scid");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        $scname = $row2['name'];
                                    }
                                    ?>
                                    <td><?php echo $scname?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['description']?></td>
                                    <td><a target="_blank" href="./uploads/product/<?php echo $row['photo']?>"><img src="./uploads/product/<?php echo $row['photo']?>" alt="<?php echo $row['photo']?>" width="150px" height="150px"></a></td>
                                    <td><?php echo $row['avail_qty']?></td>
                                    <td><?php echo $row['price']?></td>
                                    <td><a href="productEdit.php?typeOfUser=Admin&action=edit&eid=<?php echo $row['pid']?>"><button class="btn btn-warning">Edit</button></a></td>
                                    <td><a href="productView.php?typeOfUser=Admin&action=delete&did=<?php echo $row['pid']?>"><button class="btn btn-danger">Delete</button></a></td>
                                </tr>

                                <?php
                            }
                        
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
            <a href="productInsert.php?typeOfUser=Admin"><button class="btn btn-primary">Insert</button></a>
            </div>
        </div>
        
    </div>
    
<?php
    
}

elseif($_SESSION['typeOfUser'] == 'Customer'){
 

    ?>



    <div class="container-fluid" style="min-height:80vh">
        <div class="row tableRow">
            <h1 class="title">All Products</h1>
            <hr>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="" method="post" class="formRow" enctype="multipart/form-data">
                  
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cid" class="form-label">Category : </label>
                            <select name="ddCID" id="cid"  class="form-select" onchange="subCategoryFun(this.value); productFun();">
                                <option value=''>Select Category</option>
                                <?php 
                                $query = "select * from sc_category";
                                $result = mysqli_query($con,$query);
                                while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $row['cid'] ?>"><?php echo $row['name'] ?></option>
                                <?php $cur_cid = $row['cid'];?>
                                <?php    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="scid" class="form-label">SubCategory : </label>
                                <select name='ddSCID' id='scid'  class='form-select' onchange="productFun();">
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    
                </form>

                
                <div class="row" id="product">
                
                </div>
                        
            </div>
            <div class="col-md-1">
            
            </div>
        </div>
        
    </div>

    <script>

    document.onLoad = productFun();

    function subCategoryFun(catid){
        
    //    alert("Your Browser not supporting AJAX...");

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
                // alert(xmlhttp.responseText);
                document.getElementById('scid').innerHTML=xmlhttp.responseText;
                
            }
        }

        xmlhttp.open("GET","./ajax/ajaxSubCategory.php?catid="+catid);
        xmlhttp.send(null);
        document.getElementById('scid').value = "";

    }

    function productFun(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4){
                // alert(xmlhttp.responseText);
               document.getElementById('product').innerHTML=xmlhttp.responseText;
            }
        }

        var cid = document.getElementById('cid').value;
        var scid = document.getElementById('scid').value;
        if(!cid){cid = 0;}
        if(!scid){scid = 0;}
        // alert(cid +" "+ scid);
        xmlhttp.open("GET","./ajax/ajaxProduct.php?cid="+cid+"&scid="+scid);
        xmlhttp.send(null);
    }
    </script>
    
<?php
}

include_once("footer.php");

?>