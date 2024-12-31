<?php
session_start();

$Frij_ID = $_GET['Frij_ID'];

//冰箱地址
$selectFrij_Addr_sql = "select Frij_Addr from fridge where Frij_ID = $Frij_ID";
$Frij_Addr_result = mysqli_query($_SESSION["connect"], $selectFrij_Addr_sql);
while ($row = mysqli_fetch_assoc($Frij_Addr_result)) {
  $Frij_Addr = $row['Frij_Addr'];
};
//

//下面的跳轉網址
$_SESSION["url"] = "index.php?method=food_insidefridge&Frij_ID=$Frij_ID";

//用戶搜尋食物
if (array_key_exists('submitbutton', $_POST)) {
  $search = $_POST['search'];

  if (empty($search)) {

    header("Location: alert.php?message=請輸入搜尋字詞");
  } else {
    $selectfood_sql  = "select * from food where Frij_ID = $Frij_ID and Food_Name like '%$search%' order by Food_Exp";
    $data = 1;  //無搜索食物
  }
} else {
  $selectfood_sql  = "select * from food where Frij_ID = $Frij_ID order by Food_Exp";
  $data = 0;  //冰箱為空
}




$foodresult = mysqli_query($_SESSION["connect"], $selectfood_sql);

if ((mysqli_num_rows($foodresult) == 0) && (array_key_exists('submitbutton', $_POST))) {
  header("Location: alert.php?message=找不到符合搜尋字詞");
}

?>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>

  </div>

  <!-- food section -->

  <section class="food_section layout_padding" style="min-height: 600px;">

    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          冰箱No.<?php echo $Frij_ID ?>&nbsp;現有的食物

        </h2>
        <p>地址：<?php echo $Frij_Addr ?></p>
      </div>

      <?php include "filters_menu_food.php"; ?>


      <div class="filters-content">
        <div class="row grid">

          <?php
          $remain = mysqli_num_rows($foodresult); //剩餘未過期食物數量
          if (mysqli_num_rows($foodresult) > 0) {
            while ($row = mysqli_fetch_assoc($foodresult)) {

              $Food_Exp = date_create($row['Food_Exp']);
              $today = date_create(date("Y-n-j"));
              $dated_diff = date_diff($Food_Exp, $today);
              $date_dif = (int)$dated_diff->format("%R%a");
              $overdue_remind = 0;
              if ($date_dif >= 0) {
                $remain -= 1;
                $overdue_remind = 2;
                //已過期
              } elseif ($date_dif >= -4) {
                $overdue_remind = 1;
                //距離過期還有三天以內
              }



          ?>

              <div class="col-sm-6 col-lg-4 all <?php echo $row['Food_Cat'] ?>">
                <div class="box">
                  <div>
                    <div class="">
                      <img src="<?php echo $row['Food_Ph_Path'] ?>" width="400" height="210">
                    </div>
                    <div class="detail-box">
                      <h3><strong>
                          <font face="monospace"><?php echo $row['Food_Name'] ?></font>
                        </strong></h3>

                      <div class="options">
                        <p>
                          <?php
                          if ($overdue_remind == 1) {
                            echo '<span style="color: red;">即將於三日內過期</span><br>';
                          } elseif ($overdue_remind == 2) {
                            echo '<span style="color: red;">已過期</span><br>';
                          }if ($overdue_remind == 0) {
                            echo '<br>';
                          }

                          //領取狀態
                          $Regd_Tel = $_SESSION['User_Tel'];
                          $Food_ID = $row['Food_ID'];
                          $Y_sql = "select * from reservationlist where Food_ID = $Food_ID and Regd_Status = 'Y'";
                          $Yresult =  mysqli_query($_SESSION["connect"], $Y_sql);
                          $N_sql = "select * from reservationlist where Food_ID = $Food_ID and Regd_Status = 'N'";
                          $Nresult =  mysqli_query($_SESSION["connect"], $N_sql);
                          $Y = 0;
                          $N = 0;
                          if (mysqli_num_rows($Yresult) > 0) {
                            while ($row2 = mysqli_fetch_assoc($Yresult)) {
                              $Y += $row2['Regd_Qty'];  //已領取數
                            }
                          }
                          if (mysqli_num_rows($Nresult) > 0) {
                            while ($row3 = mysqli_fetch_assoc($Nresult)) {
                              $N += $row3['Regd_Qty'];  //未領取數
                            }
                          }

                          ?>

                          有效期限: <?php echo $row['Food_Exp'] ?> <br>
                          剩餘可預約數量: <?php echo $row['Food_RsvnQty'] ?><br>
                          領取狀況:
                          <?php
                          if ($Y == $row['Food_Qty']) {
                            echo '<span style="color: red;">已領取完畢';
                          ?></span>
                          <?php
                          } else {
                          ?>
                            已領取 <span style="color: yellow;"><?php echo $Y ?></span> ,
                            未領取 <span style="color: yellow;"><?php echo $N ?></span>
                          <?php
                          }
                          ?>


                        </p>

                      </div>
                      <div class="d-flex justify-content-end ">
                        <button type="button" class="btn btn-warning" style="margin-right: 10px;color: white;font-weight: bold;" onclick="javascript:location.href='index.php?method=verification&Food_ID=<?php echo $row['Food_ID']?>'" style="color: white;font-weight: bold;">
                          驗證領取
                        </button>
                        <button type="button" class="btn btn-warning" style="color: white;font-weight: bold;background-color: red;border-color: red;" onclick="javascript:location.href='index.php?method=food_delete&Frij_ID=<?php echo $Frij_ID ?>&Food_ID=<?php echo $row['Food_ID'] ?>'" style="color: white;font-weight: bold;"><i class="fa fa-trash fa-1g" aria-hidden="true"></i></button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <?php }
          } else {
            if ($data == 0) {
              echo '<h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉此冰箱內尚未有任何食物</b></h3>';
            } else {
              echo '<h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉尚未有任何與 <span style="color: red;">"' . $search . '"</span> 相關的食物</b></h3>';
            }
          }
          ?>

        </div>
      </div>

    </div>


  </section>

</body>