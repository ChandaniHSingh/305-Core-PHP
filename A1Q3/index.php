<?php
/*
3. Create an associative array of three employees with empid, name and basic salary. Calculate 
Net salaryof an employee based on following formula.
DA = 154% of basic salary
HRA = 10% of basic salary
MA = Rs. 300
PF = 15% of basic salary
Net Salary = Basic salary + DA + HRA – PF
Display the payslip of all three employees in proper format
*/

$arr = array(
    "emp1" => array("empid" => "E001", "name" => "Chandani", "basicSal" => 100000),
    "emp2" => array("empid" => "E002", "name" => "Sumit", "basicSal" => 154000),
    "emp3" => array("empid" => "E003", "name" => "Aman", "basicSal" => 134900)
    /*
    ,
    "emp4" => array("empid" => "E004", "name" => "Sunita", "basicSal" => 150660),
    "emp5" => array("empid" => "E005", "name" => "Harendra", "basicSal" => 145000),
    "emp6" => array("empid" => "E006", "name" => "Seema", "basicSal" => 150060),
    "emp7" => array("empid" => "E007", "name" => "Khushbu", "basicSal" => 136000),
    "emp8" => array("empid" => "E008", "name" => "Vijay", "basicSal" => 137000),
    "emp9" => array("empid" => "E009", "name" => "Saloni", "basicSal" => 85000),
    "emp10" => array("empid" => "E0010", "name" => "Jyoti", "basicSal" => 183000)
    */
);

foreach ($arr as $a) {
    $a['da'] = $a['basicSal'] * 1.54;
    $a['hra'] = $a['basicSal'] * 0.10;
    $a['ma'] = 300;
    $a['pf'] = $a['basicSal'] * 0.15;
    $a['netSal'] = $a['basicSal'] + $a['da'] + $a['hra'] - $a['pf'];
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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">

        <?php foreach ($arr as $a) { ?>
        <div class="row row-details" style="margin:20px 20px 100px 20px;">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <table style="border:1" class="table">
                <tr height="80px" style="background-color:#363636;color:#fff;text-align:center;font-size:24px;font-weight:600;">
                    <td colspan="4">PaySlip of <?php echo $a['name'];?></td>
                </tr>
                <tr>
                    <th class="bg-warning">Emp ID : </th>
                    <td><?php echo $a['empid']; ?></td>
                    <th class="bg-warning">Name : </th>
                    <td><?php echo $a['name']; ?></td>
                </tr>
            </table>
            <br>
            <table class="table table-hover table-bordered">
                <tr class="bg-warning">
                    <th>Earnings</th>
                    <th>Amount</th>
                    <th>Deductions</th>
                    <th>Amount</th>
                </tr>
                <?php
                    $a['da'] = $a['basicSal'] * 1.54;
                    $a['hra'] = $a['basicSal'] * 0.10;
                    $a['ma'] = 300;
                    $a['pf'] = $a['basicSal'] * 0.15;
                    $a['grossEarn'] = $a['basicSal'] + $a['da'] + $a['hra'] + $a['ma'];
                    $a['grossDeduct'] = $a['pf'];
                    $a['netSal'] =  $a['grossEarn'] - $a['grossDeduct'];
                ?>
                <tr>
                    <td>Basic Salary</td>
                    <td><?php echo $a['basicSal']; ?></td>
                    <td>Providand Fund</td>
                    <td><?php echo $a['pf'];?></td>
                </tr>
                <tr>
                    <td>DA</td>
                    <td><?php echo $a['da']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>House Rent Allowance</td>
                    <td><?php echo $a['hra']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Medical Allowance</td>
                    <td><?php echo $a['ma']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="bg-warning">Gross Eraning</th>
                    <td><?php echo $a['grossEarn']; ?></td>
                    <th class="bg-warning">Gross Deduction</th>
                    <td><?php echo $a['grossDeduct']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>NET SALARY</strong></td>
                    <td><?php echo $a['netSal']; ?></td>
                    <td></td>
                </tr>

            </table>
            </div>
            <div class="col-md-2"></div>
        </div>
        <hr>
        <?php }?>


        <!--
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <div class="card" style="width:30rem">
                <div class="card-header">
                    Featured
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">

                    </li>
                    <li class="list-group-item">
                        <td class="table-header">EmpId</td>
                        <td><?php echo $a['empid']; ?></td>
                    </li>
                    <li class="list-group-item">

                    </li>
                </ul>
            </div>
            <?php foreach ($arr as $a) { ?>
                <table class="table table-striped table-primary">
                        <tr>
                            <td class="table-header">EmpId</td>
                            <td><?php echo $a['empid']; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $a['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Basic Salary</td>
                            <td><?php echo $a['basicSal']; ?></td>
                        </tr>
                        <tr>

                            <?php
                            $a['da'] = $a['basicSal'] * 1.54;
                            $a['hra'] = $a['basicSal'] * 0.10;
                            $a['ma'] = 300;
                            $a['pf'] = $a['basicSal'] * 0.15;
                            $a['netSal'] = $a['basicSal'] + $a['da'] + $a['hra'] - $a['pf'];
                            ?>

                            <td>DA</td>
                            <td><?php echo $a['da']; ?></td>
                        </tr>
                        <tr>
                            <td>HRA</td>
                            <td><?php echo $a['hra']; ?></td>
                        </tr>
                        <tr>
                            <td>MA</td>
                            <td><?php echo $a['ma']; ?></td>
                        </tr>
                        <tr>
                            <td>PF</td>
                            <td><?php echo $a['pf']; ?></td>
                        </tr>
                        <tr>
                            <td>Net Salary</td>
                            <td><?php echo $a['netSal']; ?></td>
                        </tr>
                </table>
                        <?php } ?>
            </div>
            <div class="col-md-2"></div>
        </div>
        -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>