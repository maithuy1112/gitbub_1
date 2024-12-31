<?php
    // 檔案上傳並顯示基本資料
    echo "檔案名稱: " . $_FILES['myfile']['name'] . "<br>";
    echo "檔案大小: " . $_FILES['myfile']['size'] . "<br>";
    echo "檔案格式: " . $_FILES['myfile']['type'] . "<br>";
    echo "暫存名稱: " . $_FILES['myfile']['tmp_name'] . "<br>";
    echo "錯誤代碼: " . $_FILES['myfile']['error'] . "<br>";

    // 檔案上傳後的偵錯
    if($_FILES['myfile']['error'] >0 ) {
        switch ($_FILES['myfile']['error'] ) {
            case 1:die("檔案大小超出 php.ini:upload_max_filesize 限制 ");
            case 2:die("檔案大小超出 MAX_FILE_SIZE 限制");
            case 3:die("檔案大小僅被部份上傳");
            case 4:die("檔案未被上傳");
        }
    }

    //複製檔案
    if(is_uploaded_file ($_FILES['myfile']['tmp_name'])){
        $DestDIR = "images/food";
        if(!is_dir($DestDIR) || !is_writeable($DestDIR)){
            die("目錄不存在或無法寫入");
        }

        
        $File_Extension = explode(".",$_FILES['myfile']['name']);   //取得檔案副檔名，以陣列形式來表示
        $File_Extension = $File_Extension[count($File_Extension) - 1];  //確保副檔名一定會在最後的位置，確保副檔名正確
        $Serverfilename = date("YmdHis") . "." . $File_Extension;   //避免檔案名稱重複，以上傳的 年月日時分秒.副檔名 作為檔名
        move_uploaded_file($_FILES['myfile']['tmp_name'], $DestDIR . "/" . $Serverfilename);    //將上傳的暫存檔案移動到指定目錄

        
    }
        

?>