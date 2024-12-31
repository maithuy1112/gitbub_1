<?php
session_start();



$_SESSION["url"] = "javascript:history.back()";

//用戶搜尋預約
if (array_key_exists('submitbutton', $_POST)) {
  $search = $_POST['search'];

  if (empty($search)) {

    header("Location: alert.php?message=請輸入搜尋字詞");
  } else {
    $select_reserva_sql  = "SELECT 	Food_RsvnQty,Regd_Qty,Regd_time,Food_Name,Frij_Addr ,R.Food_ID as Food_ID ,Food_Cat,Food_Exp,Food_Ph_Path
 FROM reservationlist R , Food F , fridge G WHERE R.Food_ID = F.Food_ID and F.Frij_ID = G.Frij_ID and Regd_Tel = $_SESSION[User_Tel] and Regd_Status = 'N' and Food_Name like '%$search%' order by Food_Exp";
  }
} else {
  $select_reserva_sql  = "SELECT 	Food_RsvnQty,Regd_Qty,Regd_time,Food_Name,Frij_Addr ,R.Food_ID as Food_ID ,Food_Cat,Food_Exp,Food_Ph_Path
 FROM reservationlist R , Food F , fridge G WHERE R.Food_ID = F.Food_ID and F.Frij_ID = G.Frij_ID and Regd_Tel = $_SESSION[User_Tel] and Regd_Status = 'N' order by Food_Exp";
}

$reserva_food_result = mysqli_query($_SESSION["connect"], $select_reserva_sql);
?>

<body class="sub_page">

  <!-- food section -->

  <section class="food_section layout_padding" style="min-height: 600px;">

    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          您所預約的食物
        </h2>
        <p>請盡快領取你所預約的食物</p>
      </div>

      <?php include "filters_menu_food.php"; ?>

      <div class="filters-content">
        <div class="row grid">

          <?php
          if (mysqli_num_rows($reserva_food_result) > 0) {

            while ($row = mysqli_fetch_assoc($reserva_food_result)) {

              //即期提醒
              $Food_Exp = date_create($row['Food_Exp']);
              $today = date_create(date("Y-n-j"));
              $dated_diff = date_diff($Food_Exp, $today);
              $date_dif = (int)$dated_diff->format("%R%a");
              $overdue_remind = 0;
              if ($date_dif >= 0) {
                continue;
                //已過期不顯示下一個loop
              } elseif ($date_dif >= -4) {
                $overdue_remind = 1;
                //距離過期還有三天以內
              }

              //領取期限
              $current_date = time();
              $deadline = $row['Regd_time'];
              $remaining_time = $deadline - $current_date;
              if ($remaining_time < 0) {
                $remaining_time = 0;
              }
              $hours = floor($remaining_time / (60 * 60));
              $mins = floor(($remaining_time % (60 * 60)) / 60);
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
                          預約數量: <?php echo $row['Regd_Qty'] ?> <br>
                          所在冰箱: <span style="color: yellow;"><?php echo $row['Frij_Addr'] ?></span><br>
                          領取期限: <?php echo '<span style="color: red;"> 剩餘 ' . $hours . "小時" . $mins . '分鐘</span><br>' ?>

                          <?php
                          //echo $current_date;
                          if ($overdue_remind == 0) {
                            echo '<br>';
                          }
                          ?>
                          <?php if ($mins == 0 && $hours == 0) {
                            echo '<script>location.href="index.php?method=un_reservation2&Regd_Qty=' . $row['Regd_Qty'] . '&Food_ID=' . $row['Food_ID'] . '"</script>';
                          } ?>
                        </p>

                      </div>
                      <div class="d-flex justify-content-end ">

                        <!-- 增加預約數量-->

                        <?php 
                          $Food_RsvnQty = $row['Food_RsvnQty']; 
                          $Food_ID = $row['Food_ID']; 
                        ?>
                        <button id="modifyButton" class="btn btn-outline-warning" style="margin-right: 72px;">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>

                        <script>
                          var minLimit = 1;
                          var maxLimit = <?php echo $Food_RsvnQty; ?>;

                          document.getElementById("modifyButton").addEventListener("click", function() {
                            var userInput = prompt("若要增加預約數量，請輸入數字：\n (剩餘可預約數量為 <?php echo $Food_RsvnQty; ?>)\n*若要減少的話請取消並重新預約");
                            if (userInput !== null) {
                              var number = parseInt(userInput);

                              if (isNaN(number) || number < minLimit || number > maxLimit) {
                                alert("請輸入介於 " + minLimit + " 和 " + maxLimit + " 之間的有效數字！");
                              } else {
                                <?php $_SESSION["dbaction"] = 'update';?>
                                window.location.href = "index.php?method=reservation_check&Food_ID=<?php echo $Food_ID; ?>&Update_Regd_Qty=" + number;
                              }
                            }
                          });
                        </script>
                        <!-- 增加預約數量-->

                        <button type="button" class="btn btn-warning" style="margin-right: 10px;color: white;font-weight: bold;" onclick="javascript:location.href='receive.php?Frij_Addr=<?php echo $row['Frij_Addr'] ?>&Food_ID=<?php echo $row['Food_ID'] ?>'">確認領取</button>
                        <button type="button" class="btn btn-warning" style="color: white;font-weight: bold;" onclick="javascript:location.href='index.php?method=un_reservation&Regd_Qty=<?php echo $row['Regd_Qty'] ?>&Food_ID=<?php echo $row['Food_ID'] ?>'">取消預約</button>

                        </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php }
          } else {
            ?>
            <h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉你尚未預約任何食物</b></h3>
          <?php
          }
          ?>

        </div>
      </div>

    </div>


  </section>

</body>