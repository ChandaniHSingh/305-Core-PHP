<?php 
$con = mysqli_connect('localhost','root','','chandani');

$catid=$_GET['catid'];
$res = "<option >Select SubCategory</option>";
?>
<?php 
    $query = "select * from sc_sub_category where cid = $catid";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($result)){

        $res .= "<option value='".$row['scid']."'>".$row['name']."</option>";

        // $res .= "<option value='".$row['scid']."' if(isset($scid) && $scid == ".$row['scid']."){ selected = 'selected' }>".$row['name']."</option>";

        // $res .= "<option value='".$row['scid']."' if(isset($scid) && $scid == $row['scid']){ selected = 'selected' }>".$row['name']."</option>";
        // $res .= "<option value='".$row['scid']."'". if(isset($scid) && $scid == $row['scid']){ ."selected='selected'".}.">".$row['name']."</option>";
        // $res .="<option value='".$row['scid']."'".(isset($scid) && $scid == $row['scid'])?."selected='selected'".">".$row['name']."</option>";   
    }
echo $res;


?>
