<body class="sub_page">

  <?php
  session_start();
  $User_Tel = $_SESSION["User_Tel"];
  $_SESSION["select_Rgn_tp_sql"]  = 'select Frij_Rgn from fridge where Frij_County="台北"';
  $_SESSION["select_Rgn_ntp_sql"]  = 'select Frij_Rgn from fridge where Frij_County="新北"';
  ?>
  <!-- food section -->

  <section class="food_section layout_padding" style="min-height: 600px;">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          查看冰箱
        </h2>
        <p>只顯示已登記的冰箱地區</p>
      </div>
      <form method="POST" action="index.php?method=cross_fridge_food"> <!-- 跨查 -->
        <?php include "filters_menu_county.php"; ?>

        <div class="filters-content">
          <div class="row grid">

            <?php
            $selectfridgesql  = 'select * from fridge';
            $fridgeresult = mysqli_query($_SESSION["connect"], $selectfridgesql);


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

                                $fav_sql = 'select * from favourite where User_Tel=' . $User_Tel . '';
                                $favresult = mysqli_query($_SESSION["connect"], $fav_sql);
                                $T_or_F = 0; //有無相同結果

                                while ($row2 = mysqli_fetch_assoc($favresult)) {
                                  if ($row['Frij_ID'] == $row2['Frij_ID']) {
                                    $T_or_F += 1;
                                  }
                                }
                                if ($T_or_F >= 1) {
                                ?>
                                  <span type="button" style="margin-left: 45px;color: #FFC107;font-weight: bold;" onclick="javascript:location.href=
                      'index.php?method=un_favourite&Frij_ID=<?php echo $row['Frij_ID'] ?>'"><i class="fa fa-heart fa-1g" aria-hidden="true"></i></span>
                                <?php
                                } else {
                                ?>
                                  <span type="button" style="margin-left: 45px;color: #FFC107;font-weight: bold;" onclick="javascript:location.href=
                      'index.php?method=favourite_insert&Frij_ID=<?php echo $row['Frij_ID'] ?>&dbaction=favourite_insert'"><i class="fa fa-heart-o fa-1g" aria-hidden="true"></i></span>
                                <?php
                                }
                                ?>
                              </font>
                            </b>
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

                      <div>
                        <button type="button" class="btn btn-warning" style="margin-right: 10px;color: white;font-weight: bold;" onclick="javascript:location.href='insert_food.php?Frij_ID=<?php echo $row['Frij_ID'] ?>&Frij_Addr=<?php echo $row['Frij_Addr'] ?>'">
                          登記食物
                        </button>

                        <button type="button" class="btn btn-warning" style="margin-right: 30px;color: white;font-weight: bold;" onclick="javascript:location.href='index.php?method=food_insidefridge&Frij_ID=<?php echo $row['Frij_ID'] ?>'">
                          查看食物
                        </button>

                        <label>
                          <input type="checkbox" name="cross_select_fridge[]" value="<?php echo $row['Frij_ID'] ?>" class="btn btn-outline-danger"> 
                          <b>跨查冰箱</b>
                        </label>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            <?php } ?>
      </form>
    </div>
    </div>

    </div>
  </section>

  <!-- end food section -->