<?php

$sdate = $_GET['sdate'];
$edate = $_GET['edate'];

$con = mysqli_connect('localhost','root','','chandani');
$result = mysqli_query($con,"select * from sc_sales where date_time between '$sdate' and '$edate' order by date_time desc");

if(mysqli_num_rows($result) < 1){
    $result = mysqli_query($con,"select * from sc_sales where date_time between '$edate' and '$sdate' order by date_time desc");
}




$res = "";
while($row = mysqli_fetch_assoc($result)){
    $res .= "<tr>
        <td>".$row['sid']."</td>";

        $pid = $row['pid'];
        $result2 = mysqli_query($con,"select * from sc_product where pid=$pid");
        while($row2 = mysqli_fetch_assoc($result2)){
            $pname = $row2['name'];
        }

    $res .= "<td>".$pname."</td>
        <td>".$row['qty']."</td>
        <td>".$row['amt']."</td>
        <td>".$row['date_time']."</td>
        
    </tr>";

}

echo $res;

?>