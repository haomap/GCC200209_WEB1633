<?php
include_once("header.php");
include_once("connect.php");
$c = new Connect;
$dblink = $c->connectToPDO();

if(isset($_COOKIE['cc_usrname'])){
$b = $_COOKIE['cc_id'];
// kiem tra bien id 
if (isset($_GET['id'])) {
    $pid = $_GET['id'];

    
    $findSql = "SELECT `cproid` FROM `cart` WHERE `cproid` = ? AND `cuserid` = ?";

    $re = $dblink->prepare($findSql);
    $valueArray = [
        $pid,$b
    ];
    $stmt = $re->execute($valueArray);

    if ($re->rowCount() == 0) {
        $sql = "INSERT INTO `cart`(`cuserid`, `cproid`, `cquantity`, `cdate`) VALUES (?,?,1,CURDATE())";
    } else {
        $sql = "UPDATE `cart` SET `cquantity`=`cquantity`+1,`cdate`= CURDATE() WHERE  `cuserid`= ? AND `cproid`= ? ";
    }


    $re1 = $dblink->prepare($sql);
    $valueArray1 = [
        $b,$pid
    ];
    $stmt = $re1->execute($valueArray1);
}

$showCartSQL = "SELECT `pimage`, `pname` , `cquantity`, `pprice` FROM `cart` c, `product` p WHERE c.cproid = p.pid AND `cuserid` = ?";
$re1 = $dblink->prepare($showCartSQL);
$valueArray1 = [
    $b
];
$stmt = $re1->execute($valueArray1);
$rows = $re1->fetchAll(PDO::FETCH_BOTH);
}else{
    header("location: login.php");
}

?>

<section class="vh-100" style="background-color: #fdccbc;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <p><span class="h2">Shopping Cart </span><span class="h4">(<?= $re1->rowCount()?> item in your cart)</span></p>

                <div class="card mb-4">
                    <div class="card-body p-4">
                    <div class="row align-items-center">
                            <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="small text-muted mb-4 pb-2">Name</p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="small text-muted mb-4 pb-2">Quantity</p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="small text-muted mb-4 pb-2">Price</p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="small text-muted mb-4 pb-2">Total (&#36;)</p>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $sum = 0;
                        foreach($rows as $row){
                        ?>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="./images/<?=$row['pimage']?>" 
                                class="img-fluid" alt="Generic placeholder image">
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="lead fw-normal mb-0"><?=$row['pname']?></p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="lead fw-normal mb-0"><?=$row['cquantity']?></p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="lead fw-normal mb-0"><?=$row['pprice']?></p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <p class="lead fw-normal mb-0"><?=$row['pprice']*$row['cquantity']?></p>
                                    <?php
                                        $sum+=$row['pprice']*$row['cquantity'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>        


                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-body p-4">

                        <div class="float-end">
                            <p class="mb-0 me-5 d-flex align-items-center">
                                <span class="small text-muted me-2">Order total:</span> <span class="lead fw-normal">&#36;<?=$sum?></span>
                            </p>
                        </div>

                    </div>
                </div>
                <php
                        }
                ?>

                <div  class="d-flex justify-content-end">
                    <a type="button" href="index.php" class="btn btn-primary btn-lg" >Continue shopping</a>
                </div>

            </div>

            
        </div>
    </div>
</section>