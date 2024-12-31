<?php
session_start();
$Frij_ID = $_GET['Frij_ID'];

//刪除預約
$delete_sql = "delete from favourite where Frij_ID = $Frij_ID;";

if (mysqli_query($_SESSION["connect"], $delete_sql)) {
    echo '<script>alert("成功取消最愛");history.back();</script>';
} else {
    echo '<script>location.href="alert.php?message=取消最愛失敗&url=index.php"</script>';
}
?>