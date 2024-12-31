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
$selected = 1;
//下面的跳轉網址
$_SESSION["url"] = "index.php?method=food_insidefridge&Frij_ID=$Frij_ID";

//用戶搜尋食物
if (array_key_exists('submitbutton', $_POST)) {
  $search = $_POST['search'];
  

  if (empty($search)) {
    header("Location: alert.php?message=請輸入搜尋字詞");
  } else {
    $selected = 0;
    $selectfood_sql  = "select * from food where Frij_ID = $Frij_ID and Food_Name like '%$search%'and Food_RsvnQty != 0 order by Food_Exp";
  }
} else {
  $selectfood_sql  = "select * from food where Frij_ID = $Frij_ID and Food_RsvnQty != 0 order by Food_Exp";
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
          <font size="6.5">冰箱No.<?php echo $Frij_ID ?>&nbsp;現有的食物</font>

        </h2>
        <p>地址：<?php echo $Frij_Addr ?></p>
      </div>

      <?php include "filters_menu_food.php"; ?>


      <div class="filters-content">
        <div class="row grid">

          <?php
          $count_foodresult = mysqli_num_rows($foodresult); //剩餘未過期食物數量

          if ($count_foodresult > 0) {

            while ($row = mysqli_fetch_assoc($foodresult)) {

              if ($count_foodresult == 0) {
                break;
              }

              $Food_Exp = date_create($row['Food_Exp']);
              $today = date_create(date("Y-n-j"));
              $dated_diff = date_diff($Food_Exp, $today);
              $date_dif = (int)$dated_diff->format("%R%a");
              $overdue_remind = 0;

              if ($date_dif >= 0) {
                $count_foodresult--;
                continue;
                //已過期不顯示下一個loop
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
                          if ($overdue_remind != 0) {
                            echo '<span style="color: red;">即將於三日內過期</span><br>';
                          }
                          ?>

                          有效期限: <?php echo $row['Food_Exp'] ?> <br>
                          登記數量: <?php echo $row['Food_Qty'] ?> <br>
                          剩餘可預約數量: <?php echo $row['Food_RsvnQty'] ?>


                          <?php if ($overdue_remind == 0) {
                            echo '<br>&emsp;';
                          } ?>
                        </p>

                      </div>
                      <div class="d-flex justify-content-end ">
                        <button type="button" class="btn btn-warning" style="color: white;font-weight: bold;" onclick="javascript:location.href='index.php?method=reservation_food&Frij_Addr=<?php echo $Frij_Addr ?>&Food_ID=<?php echo $row['Food_ID'] ?>'" style="color: white;font-weight: bold;">預約食物</button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <?php
              
            }
            
          }
          
          if ($selected == 0) {
            echo '<h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉尚未有任何與 <span style="color: red;">"' . $search . '"</span> 相關的食物</b></h3>';
          }else if ($count_foodresult == 0) {
            echo '<h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉此冰箱內尚未有任何食物</b></h3>';
          }

          ?>

        </div>
      </div>

    </div>


  </section>

</body>