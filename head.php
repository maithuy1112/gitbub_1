<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<body>
  <!-- header section strats -->
  <header class="header_section  bg-dark">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <img src="images/logo.png" width="35px" style="margin:0 10px 0 -20px;">
        <a class="navbar-brand" href="index.php">

          <span>

            Solidarity fridge
          </span>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  mx-auto ">

            <?php
            if ($_SESSION['User_Name'] <> "") {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <b> 首頁</b>
                </a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <b>查看冰箱</b>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="index.php?method=fridge">全部冰箱</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="index.php?method=favourite_list">最愛冰箱</a></li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index.php?method=all_food">
                  <b> 查看食物</b>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index.php?method=reservation_list">
                  <b> 預約清單</b>
                </a>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <b>冰箱管理</b>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="index.php?method=fridge_mgmt">管理冰箱</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="insert_fridge.php">新增冰箱</a></li>
                </ul>
              </li>

            <?php
            }
            ?>



          </ul>

          <?php
          session_start();
          if ($_SESSION['User_Name'] <> "") {

          ?>
            <div class="user_option">
              <a href="#" class="user_link">
                <i class="fa fa-user" aria-hidden="true"> 使用者<?php echo $_SESSION['User_Name']; ?></i>
              </a>
            </div>
            <div class="user_option">

              <a href="index.php?method=logout" class="user_link">
                <i class="fa fa-sign-out" aria-hidden="true"></i>登出
              </a>
            </div>
          <?php
          } else {
          ?>
            <div class="user_option">
              <a href="login.php" class="user_link">
                <i class="fa fa-sign-in" aria-hidden="true"> 用戶登入</i>
              </a>
            </div>
            <div class="user_option">
              <a href="index.php?method=reservation_acc" class="user_link">
                <i class="fa fa-user-plus" aria-hidden="true"> 註冊</i>
              </a>
            </div>
          <?php
          }
          ?>

        </div>
      </nav>
    </div>
  </header>
  <!-- end header section -->
</body>

<style>
  h1,
  h2 {
    font-family: null;
  }
</style>