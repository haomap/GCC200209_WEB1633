<?php
   setcookie("cc_usrname",$row['username'],time()-3600);//time(thời gian hiện tại)+ thời gian(s) để cookie đăng xuất
   header("Location: index.php"); // chuyen trang 
?>