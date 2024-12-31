<?php
session_start();
$Food_ID = $_GET['Food_ID'];

//刪除預約
$delete_sql = "delete from reservationlist where Food_ID = $Food_ID;";

if (mysqli_query($_SESSION["connect"], $delete_sql)) {
    echo '<script>alert("確認成功");history.back();</script>';
} else {
    echo '<script>location.href="alert.php?message=確認成功&url=index.php"</script>';
}
?>