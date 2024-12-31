<?php
session_start();
$Food_ID = $_GET['Food_ID'];
$Regd_Qty = $_GET['Regd_Qty'];

//可預約食物數量增加
$Food_RsvnQty_sql = "UPDATE `food` SET `Food_RsvnQty` = `Food_RsvnQty`+$Regd_Qty WHERE `food`.`Food_ID` = $Food_ID;";

//刪除預約
$delete_sql = "delete from reservationlist where Food_ID = $Food_ID;";

if (mysqli_query($_SESSION["connect"], $delete_sql)) {

    mysqli_query($_SESSION["connect"], $Food_RsvnQty_sql);
    echo '<script>location.href="alert.php?message=成功取消預約&url=index.php?method=reservation_list"</script>';
} else {
    echo '<script>location.href="alert.php?message=取消預約失敗&url=index.php"</script>';
}
?>