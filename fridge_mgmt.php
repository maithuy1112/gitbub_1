<body class="sub_page">

  <?php
  session_start();
  $User_Tel = $_SESSION["User_Tel"];
  $_SESSION["select_Rgn_tp_sql"]  = 'select Frij_Rgn from fridge where Frij_County="台北" and Admin_Tel ='.$User_Tel.'';
  $_SESSION["select_Rgn_ntp_sql"]  = 'select Frij_Rgn from fridge where Frij_County="新北" and Admin_Tel ='.$User_Tel.'';

  $_SESSION["filters_menu_county"] = 'fridge_mgmt';
  ?>
  <!-- food section -->

  <section class="food_section layout_padding" style="min-height: 600px;">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          管理已新增冰箱
        </h2>
      </div>

      <?php include "filters_menu_county.php"; ?>

      <div class="filters-content">
        <div class="row grid">

          <?php
          $selectfridgesql  = 'select * from fridge where Admin_Tel=' . $User_Tel . '';
          $fridgeresult = mysqli_query($_SESSION["connect"], $selectfridgesql);


          if (mysqli_num_rows($fridgeresult) > 0) {
            while ($row = mysqli_fetch_assoc($fridgeresult)) {
          ?>

              <div class="col-sm-6 col-lg-4 all <?php echo $row['Frij_Rgn'] ?>">
                <div class="box">
                  <div>
                    <div class="">
                      <img src="<?php echo $row['Frij_Ph_Path'] ?>" width="400" height="210">
                    </div>
                    <div class="detail-box">
                      <div>
                        <strong>
                          <h4>
                            <b>
                              <font size=6.5 face="monospace">
                                <?php
                                if ($row['Frij_ID'] < 10) {
                                  echo '冰箱No.' . $row['Frij_ID'] . ' (' . $row['Frij_Rgn'] . ')</font></b>';
                                } else {
                                  echo '冰箱No.' . $row['Frij_ID'] . '(' . $row['Frij_Rgn'] . ')</font></b>';
                                }

                                ?>
                          </h4>
                        </strong>
                      </div>

                      <div class="options">
                        <p>
                          地址: <?php echo $row['Frij_Addr'] ?><br><br><br>
                        </p>

                        <!-- <i class="fa fa-eye" aria-hidden="true" style="font-size:25px;color:#FFFFFF;"></i> 
                    <a href=""> -->
                        </a>
                      </div>

                      <div class="d-flex justify-content-end">
                        

                        <button type="button" class="btn btn-warning" style="margin-right: 10px;color: white;font-weight: bold;" 
                        onclick="javascript:location.href='index.php?method=food_mgmt&Frij_ID=<?php echo $row['Frij_ID'] ?>'" 
                        style="color: white;font-weight: bold;">
                          管理食物
                        </button>

                        <!-- 刪除冰箱 -->
                        <button type="button" class="btn btn-warning " style="color: white;font-weight: bold;background-color: red;border-color: red;" onclick="javascript:location.href=
                    'index.php?method=fridge_delete&Frij_ID=<?php echo $row['Frij_ID'] ?>'"><i class="fa fa-trash fa-1g" aria-hidden="true"></i></button>

                      </div>

                    </div>
                  </div>
                </div>
              </div>

          <?php }
          } else {
            echo '<h3 style="text-align: center;margin: 100px auto 100px auto;"><b>新增冰箱後即可管理</b></h3>';
          }
          ?>
        </div>
      </div>

    </div>
  </section>

  <!-- end food section -->