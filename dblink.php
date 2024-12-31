
    <?php
    session_start();

    $dbaction = $_POST['dbaction'];

    //分享者登記食物(新增)
    if ($dbaction == "insert_food") {

        $Food_Name = $_POST['Food_Name'];
        $Food_Qty = $_POST['Food_Qty'];
        $Food_Cat = $_POST['Food_Cat'];
        $Frij_ID = $_GET['Frij_ID'];
        $Frij_Addr = $_GET['Frij_Addr'];
        $Food_Exp = $_POST['Food_Exp'];


        //照片上傳
        // 檔案上傳
        $_FILES['myfile']['name'] . "<br>";
        $_FILES['myfile']['size'] . "<br>";
        $_FILES['myfile']['type'] . "<br>";
        $_FILES['myfile']['tmp_name'] . "<br>";
        $_FILES['myfile']['error'] . "<br>";

        // 檔案上傳後的偵錯
        if ($_FILES['myfile']['error'] > 0) {
            switch ($_FILES['myfile']['error']) {
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
        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
            $DestDIR = "images/food";
            if (!is_dir($DestDIR) || !is_writeable($DestDIR)) {
                die("目錄不存在或無法寫入");
            }


            $File_Extension = explode(".", $_FILES['myfile']['name']);   //取得檔案副檔名，以陣列形式來表示
            $File_Extension = $File_Extension[count($File_Extension) - 1];  //確保副檔名一定會在最後的位置，確保副檔名正確
            $Serverfilename = date("YmdHis") . "." . $File_Extension;   //避免檔案名稱重複，以上傳的 年月日時分秒.副檔名 作為檔名
            move_uploaded_file($_FILES['myfile']['tmp_name'], $DestDIR . "/" . $Serverfilename);    //將上傳的暫存檔案移動到指定目錄


        }
        //




        $Food_Ph_Path = "images/food/" . $Serverfilename;
        $insert_insert_food_sql = "insert into food( Frij_ID, Food_Name, Food_Cat, Food_Exp, Food_Qty,Food_RsvnQty,Food_Ph_Path) 
        values( '$Frij_ID', '$Food_Name', '$Food_Cat', '$Food_Exp', '$Food_Qty','$Food_Qty','$Food_Ph_Path')";

        if (mysqli_query($_SESSION["connect"], $insert_insert_food_sql)) {

            $_SESSION["url"] = "index.php?method=food_insidefridge&Frij_ID=$Frij_ID";

            //header("Location: alert.php?message=成功登記食物");
            echo '<script>location.href="alert.php?message=成功登記食物"</script>';
        } else {

            //header("Location:index.php?message=登記失敗");
            echo '<script>location.href="alert.php?message=登記失敗&url=index.php"</script>';
        }
    }

    //管理員新增冰箱
    if ($dbaction == "insert_fridge") {

        $Frij_Addr = $_POST['Frij_Addr'];
        $Frij_Rgn = $_POST['Frij_Rgn'];
        $Admin_Tel = $_SESSION["User_Tel"];
        $Frij_County = $_POST['Frij_County'];
        

        //照片上傳
        // 檔案上傳並顯示基本資料
        $_FILES['Frij_Ph']['name'] . "<br>";
        $_FILES['Frij_Ph']['size'] . "<br>";
        $_FILES['Frij_Ph']['type'] . "<br>";
        $_FILES['Frij_Ph']['tmp_name'] . "<br>";
        $_FILES['Frij_Ph']['error'] . "<br>";

        // 檔案上傳後的偵錯
        if ($_FILES['Frij_Ph']['error'] > 0) {
            switch ($_FILES['Frij_Ph']['error']) {
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
        if (is_uploaded_file($_FILES['Frij_Ph']['tmp_name'])) {
            $DestDIR = "images/fridge";
            if (!is_dir($DestDIR) || !is_writeable($DestDIR)) {
                die("目錄不存在或無法寫入");
            }


            $File_Extension = explode(".", $_FILES['Frij_Ph']['name']);   //取得檔案副檔名，以陣列形式來表示
            $File_Extension = $File_Extension[count($File_Extension) - 1];  //確保副檔名一定會在最後的位置，確保副檔名正確
            $Serverfilename = date("YmdHis") . "." . $File_Extension;   //避免檔案名稱重複，以上傳的 年月日時分秒.副檔名 作為檔名
            move_uploaded_file($_FILES['Frij_Ph']['tmp_name'], $DestDIR . "/" . $Serverfilename);    //將上傳的暫存檔案移動到指定目錄


        }
        //

        $Frij_Ph_Path =  "images/fridge/" . $Serverfilename;
        $insert_fridge_sql = "insert into fridge(Frij_Addr, Admin_Tel, Frij_Rgn, Frij_Ph_Path,Frij_County) values('$Frij_Addr', '$Admin_Tel', '$Frij_Rgn', '$Frij_Ph_Path','$Frij_County')";

        if (mysqli_query($_SESSION["connect"], $insert_fridge_sql)) {
            //header("Location: alert.php?message=成功新增冰箱&url=index.php?method=fridge");
            echo '<script>location.href="alert.php?message=成功新增冰箱&url=index.php?method=fridge_mgmt"</script>';
        } else {
            //header("Location:index.php?message=登記失敗");
            echo '<script>location.href="alert.php?message=新增冰箱失敗&url=index.php"</script>';
        }
    }

    ?>






