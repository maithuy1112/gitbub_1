<?php
session_start();

$Food_ID = $_GET['Food_ID'];
$select_verification_sql  = "select r.Food_ID,Food_Name,Regd_Tel,Regd_Qty,Regd_Ph_Path from reservationlist r, food f 
                        where r.Food_ID = f.Food_ID and r.Food_ID = $Food_ID and Regd_Status = 'Y'";

$verification_result = mysqli_query($_SESSION["connect"], $select_verification_sql);
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
                    驗證食物領取狀態

                </h2>
            </div>

            <div class="filters-content">
                <div class="row grid">

                    <?php
                    if (mysqli_num_rows($verification_result) > 0) {

                        while ($row = mysqli_fetch_assoc($verification_result)) {


                    ?>
                            <div class="col-sm-6 col-lg-4 all">
                                <div class="box">
                                    <div>
                                        <div class="">
                                            <img src="<?php echo $row['Regd_Ph_Path'] ?>" width="400" height="210">
                                        </div>
                                        <div class="detail-box">
                                            <h3><strong>
                                                    <font face="monospace"><?php echo $row['Food_Name'] ?></font>
                                                </strong></h3>

                                            <div class="options">
                                                <p>

                                                    領取人電話號碼: <?php echo $row['Regd_Tel'] ?> <br>
                                                    預約數量: <?php echo $row['Regd_Qty'] ?><br>

                                                </p>

                                            </div>

                                            <div class="d-flex justify-content-end ">

                                                <button type="button" class="btn btn-success" style="color: white;font-weight: bold;" onclick="javascript:location.href='index.php?method=verification_check&Food_ID=<?php echo $Food_ID; ?>'">
                                                    確認並刪除記錄
                                                </button>
                                                <!--
                                                <button type="button" class="btn btn-danger" style="color: white;font-weight: bold;" onclick="javascript:location.href='index.php?method=verification_check&Food_ID=<?php echo $Food_ID; ?>'">
                                                <i class="fa fa-user-times" aria-hidden="true"></i>封鎖用戶
                                                </button>
                        -->

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php }
                    } else {
                        ?>
                        <h3 style="text-align: center;margin: 100px auto 100px auto;"><b>抱歉尚未有任何食物需要驗證</b></h3>
                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>


    </section>

</body>