
    <?php
    session_start();
    $Frij_ID = $_GET['Frij_ID'];
    $User_Tel = $_SESSION["User_Tel"];
    $dbaction = $_GET['dbaction'];

    if ($dbaction == "favourite_insert") {
        
        //新增語法
        $sql = "insert into favourite( Frij_ID, User_Tel) values( '$Frij_ID', '$User_Tel')";

        if (mysqli_query($_SESSION["connect"], $sql)) {
            //echo "新增完成";
            echo '<script>alert("成功加入最愛冰箱");history.back();</script>';
        } else {
            //echo "新增語法有錯誤";
            echo '<script>location.href="alert.php?message=加入最愛冰箱失敗&url=index.php"</script>';
        }
    }
    ?>