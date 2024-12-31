<?php
session_start();
$Frij_ID = $_GET['Frij_ID'];
$Food_ID = $_GET['Food_ID'];

//刪除預約
$delete_sql = "delete from food where Frij_ID = $Frij_ID and Food_ID = $Food_ID;";

if (mysqli_query($_SESSION["connect"], $delete_sql)) {
    echo '<script>alert("成功刪除食物");history.back();</script>';
} else {
    echo '<script>location.href="alert.php?message=刪除食物失敗&url=index.php"</script>';
}
?>