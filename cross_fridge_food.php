<?php
session_start();
if (empty($_POST["cross_select_fridge"])) {

    $_SESSION["url"] = "index.php?method=fridge";
    echo '<script>location.href="alert.php?message=你未勾選冰箱，無法查詢"</script>';
}
$select_foodid = implode(",", $_POST["cross_select_fridge"]);;
$cross_select_fridge = implode(" or food.Frij_ID =", $_POST["cross_select_fridge"]);

$selected = 1;

//用戶搜尋食物
if (array_key_exists('submitbutton', $_POST)) {
    $search = $_POST['search'];


    if (empty($search)) {
        header("Location: alert.php?message=請輸入搜尋字詞");
    } else {
        $selected = 0;
        $selectfood_sql  = "select * from food,fridge where food.Frij_ID = fridge.Frij_ID and ( food.Frij_ID = $cross_select_fridge ) and Food_Name like '%$search%'and Food_RsvnQty != 0 order by Food_Exp";
    }
} else {
    $selectfood_sql  = "select * from food,fridge where food.Frij_ID = fridge.Frij_ID and (food.Frij_ID = $cross_select_fridge) and Food_RsvnQty != 0 order by Food_Exp";
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
                    跨查冰箱
                </h2>
                <p>冰箱 No.<?php echo $select_foodid; ?> 內的食物</p>
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
                                                    剩餘可預約數量: <?php echo $row['Food_RsvnQty'] ?><br>
                                                    存放冰箱: <span style="color: yellow;"><?php echo $row['Frij_Addr'] ?></span>


                                                    <?php if ($overdue_remind == 0) {
                                                        echo '<br>&emsp;';
                                                    } ?>
                                                </p>

                                            </div>
                                            <div class="d-flex justify-content-end ">
                                                <button type="button" class="btn btn-warning" style="margin-right: 20px;color: white;font-weight: bold;" onclick="javascript:location.href=
                    'index.php?method=food_insidefridge&Frij_ID=<?php echo $row['Frij_ID'] ?>'">
                                                    查看冰箱
                                                </button>

                                                <button type="button" class="btn btn-warning" onclick="javascript:location.href='index.php?method=reservation_food&Frij_Addr=<?php echo $row['Frij_Addr'] ?>&Food_ID=<?php echo $row['Food_ID'] ?>'" style="color: white;font-weight: bold;">
                                                    預約食物
                                                </button>
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
                    } else if ($count_foodresult == 0) {
                        echo '<h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉此冰箱內尚未有任何食物</b></h3>';
                    }

                    ?>

                </div>
            </div>

        </div>


    </section>

</body>