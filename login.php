<?php
require_once('header.php');
require_once('connect.php');
if (isset($_POST['btnLogin'])) {
    $username = $_POST['username']; // lay gia tri
    $password = $_POST['password'];



    $sql = "SELECT  `username`, `id`  FROM `users` WHERE `username`=? and `password`= ? ";


    $c = new Connect;
    $dblink = $c->connectToPDO();
    $re = $dblink->prepare($sql);
    $valueArray = ["$username", "$password"]; // -> push gia tri vao dau ? o value
    $stmt = $re->execute($valueArray);

    $numrow = $re->rowCount();
    $row = $re->fetch(PDO::FETCH_BOTH);
    if ($numrow == 1) {
        setcookie("cc_id",$row['id'],time()+3600);//time(thời gian hiện tại)+ thời gian(s) để cookie đăng xuất
        setcookie("cc_usrname",$row['username'],time()+3600);//time(thời gian hiện tại)+ thời gian(s) để cookie đăng xuất
        header("Location: index.php"); // chuyen trang 
    } else {
        echo "please check your input";
    }
}
?>

<div class="container">
    <h2>Login</h2>
    <form action="" name="formReg" method="POST">
        <div class="row mb-3">
            <label for="" class="col-lg-4">Username</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="username">
                <br>
            </div>

            <label for="" class="col-lg-4">Password</label>
            <div class="col-lg-8">
                <input type="password" class="form-control" name="password">
                <br>
            </div>

            <!-- <div class="row mb-3">
                    <label for="" class="col-lg-4">Hometown:</label>
                    <div class="col-lg-8">
                    <select name="hometown" id="" class="form-select">
                                <option selected value="unknow">Choose your Hometown</option> 
                                <option value="ct">Can Tho</option>  
                                <option value="cm">Ca Mau</option>
                            </select> -->
            <!-- </div> -->
            <!-- </div> -->
            <div class="row mb-3">
                <div class="d-grid mx-auto col-3">
                    <input type="submit" value="Login" class="btn btn-primary" name="btnLogin">
                </div>
            </div>
    </form>
</div>
</body>

</html>