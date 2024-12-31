
    <?php
    session_start();
    $Food_ID = $_GET['Food_ID'];
    $User_Tel = $_SESSION["User_Tel"];
    
    if ($_SESSION["dbaction"] == "insert") {
        $Regd_Qty = $_POST['Regd_Qty'];
        date_default_timezone_set('Asia/Shanghai');
        $Regd_time = strtotime("+1 day");
        // 新增語法
        $insert_sql = "INSERT IGNORE INTO reservationlist (Regd_Tel, Food_ID, Regd_Qty, Regd_time) 
                       VALUES ('$User_Tel', '$Food_ID', '$Regd_Qty', '$Regd_time')";
    
        ini_set("display_errors", "on");
    
        if (mysqli_query($_SESSION["connect"], $insert_sql)) {
            // 檢查受影響的行數
            if (mysqli_affected_rows($_SESSION["connect"]) > 0) {
                // 新增成功
                $update_RsvnQty_sql = "UPDATE food SET Food_RsvnQty = Food_RsvnQty - $Regd_Qty WHERE Food_ID = $Food_ID";
                mysqli_query($_SESSION["connect"], $update_RsvnQty_sql);
    
                echo '<script>location.href="alert.php?message=預約成功&url=index.php?method=reservation_list"</script>';
            } else {
                // 資料重複，插入被忽略
                echo '<script>location.href="alert.php?message=資料已存在，無法重複預約&url=index.php?method=all_food"</script>';
            }
        } else {
            // 其他錯誤處理
            echo '<script>location.href="alert.php?message=預約失敗&url=index.php?method=all_food"</script>';
        }
    
        ini_set("display_errors", "Off");
    }
    
    
    

    if ($_SESSION["dbaction"] == "update") {
        $Update_Regd_Qty = $_GET['Update_Regd_Qty'];
        $update_reservation_sql = "UPDATE `reservationlist` SET `Regd_Qty` = (`Regd_Qty` + $Update_Regd_Qty) WHERE `Food_ID` = $Food_ID AND `Regd_Tel` = '$User_Tel'";
        $update_RsvnQty_sql = "UPDATE `food` SET `Food_RsvnQty` = `Food_RsvnQty`-$Update_Regd_Qty WHERE `Food_ID` = $Food_ID";



        mysqli_query($_SESSION["connect"], $update_RsvnQty_sql);
        mysqli_query($_SESSION["connect"], $update_reservation_sql);

        $_SESSION["url"] = "index.php?method=reservation_list";
        echo '<script>location.href="alert.php?message=修改成功"</script>';
    }
    ?>