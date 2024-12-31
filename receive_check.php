
    <?php
    session_start();
    $Food_ID = $_GET['Food_ID'];
    $Regd_Tel = $_GET["Regd_Tel"];
    $dbaction = $_POST['dbaction'];


    // $User_Tel= $_SESSION["User_Tel"];

    if ($dbaction == "receive_check") {

        //照片上傳
        // 檔案上傳並顯示基本資料
        $_FILES['check_ph']['name'] . "<br>";
        $_FILES['check_ph']['size'] . "<br>";
        $_FILES['check_ph']['type'] . "<br>";
        $_FILES['check_ph']['tmp_name'] . "<br>";
        $_FILES['check_ph']['error'] . "<br>";

        // 檔案上傳後的偵錯
        if ($_FILES['check_ph']['error'] > 0) {
            switch ($_FILES['check_ph']['error']) {
                case 1:
                    die("檔案大小超出 php.ini:upload_max_filesize 限制 ");
                case 2:
                    die("檔案大小超出 MAX_FILE_SIZE 限制");
                case 3:
                    die("檔案大小僅被部份上傳");
                case 4:
                    die("檔案未被上傳");
            }
        }

        //複製檔案
        if (is_uploaded_file($_FILES['check_ph']['tmp_name'])) {
            $DestDIR = "images/check";
            if (!is_dir($DestDIR) || !is_writeable($DestDIR)) {
                die("目錄不存在或無法寫入");
            }


            $File_Extension = explode(".", $_FILES['check_ph']['name']);   //取得檔案副檔名，以陣列形式來表示
            $File_Extension = $File_Extension[count($File_Extension) - 1];  //確保副檔名一定會在最後的位置，確保副檔名正確
            $Serverfilename = date("YmdHis") . "." . $File_Extension;   //避免檔案名稱重複，以上傳的 年月日時分秒.副檔名 作為檔名
            move_uploaded_file($_FILES['check_ph']['tmp_name'], $DestDIR . "/" . $Serverfilename);    //將上傳的暫存檔案移動到指定目錄


        }
        //


        //新增語法
        $Regd_Ph_Path =  "images/check/" . $Serverfilename;

        $Regd_Status_sql = "UPDATE `reservationlist`
                            SET `Regd_Status` = 'Y', `Regd_Ph_Path` = '$Regd_Ph_Path'
                            WHERE `reservationlist`.`Food_ID` = $Food_ID AND `reservationlist`.`Regd_Tel` = '$Regd_Tel'";



        if (mysqli_query($_SESSION["connect"], $Regd_Status_sql)) {
            //echo "新增完成";
            $_SESSION["url"]="index.php?method=reservation_list";
            echo '<script>location.href="alert.php?message=確認領取成功"</script>';

        } else {
            //echo "新增語法有錯誤";
            echo '<script>location.href="alert.php?message=確認領取失敗&url=index.php"</script>';
        }
    }
    ?>