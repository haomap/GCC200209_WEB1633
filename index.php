<?php
require_once('header.php');
require_once('connect.php');
$sql = "SELECT  *  FROM `product` ORDER BY `pdate` LIMIT 4";

$c = new Connect;
$dblink = $c->connectToMySQL();

$re = $dblink->query($sql);

if ($re->num_rows > 0) {
?>

<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Welcome to our Toy Store!</h1>
                    <p class="lead">Discover a wide range of amazing toys for kids of all ages.</p>
                    <hr class="my-4">
                    <p>From educational toys to interactive games, we have everything your child needs to have fun and learn.</p>
                    <img src="./images/Avata2.jpg" style="float: left; list-style: none; position: relative; width: 1201px;" class="img-fluid" alt="MH Store">
                    <br>
                    <a class="btn btn-primary btn-lg" href="allproduct.php" role="button">All products</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <!-- Your existing product cards code here -->
        </div>
    </div>
</main>

    <div class="container">
        <div class="row justify-content-center">
            <?php
            while ($row = $re->fetch_assoc()) {
            ?>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm">
                    <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center shadow-1-strong "
                        style="width: 50px; height: 50px;" >
                    <p class="text-white mb-0 small">New</p>
                </div>
                        <a href="#">
                            <img src="./images/<?=$row['pimage']?>" class="card-img-top" alt="product.title" />
                        </a>
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <span class="float-start badge rounded-pill bg-success">&#36;<?= $row['pprice']?></span>

                                <span class="float-end"><a href="#" class="small text-muted text-uppercase aff-link"><?=$row['pcatid']?></a></span>
                            </div>
                            <h5 class="card-title">
                                <a target="_blank" href="detail.php?id=<?=$row['pid']?>"><?=$row['pname']?></a>
                            </h5>

                            <div class="d-grid gap-2 my-4">

                                <a href="cart.php?id=<?=$row['pid']?>" class="btn btn-warning bold-btn">Add to cart</a>

                            </div>
                            <div class="clearfix mb-1">

                                <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>

                                <span class="float-end">
                                    <i class="far fa-heart" style="cursor: pointer"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
<?php
} else {
    echo " not found";
}

?>