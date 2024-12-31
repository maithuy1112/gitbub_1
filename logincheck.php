
    <?php
    session_start();
    $User_Tel = $_POST['User_Tel'];
    $User_Pw = $_POST['User_Pw'];

    
    $sql = "Select distinct * from account where User_Tel = '$User_Tel' and User_Pw = '$User_Pw'";

    $result = mysqli_query($_SESSION["connect"], $sql);

    
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['User_Name'] = $row['User_Name'];
        $_SESSION["User_Tel"] = $User_Tel;
        echo '<script>location.href="alert.php?message=登入成功&url=index.php"</script>';

    } else {
        echo '<script>location.href="alert.php?message=帳號密碼錯誤&url=login.php"</script>';
    }

    ?>