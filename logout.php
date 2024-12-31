<?php
 session_start();
    $_SESSION['User_Name'] = "";
    echo '<script>location.href="alert.php?message=登出成功&url=index.php?method=main"</script>';

?>