<?php
session_start();

$Rgn_tp_result = mysqli_query($_SESSION["connect"], $_SESSION["select_Rgn_tp_sql"]);
$Rgn_ntp_result = mysqli_query($_SESSION["connect"], $_SESSION["select_Rgn_ntp_sql"]);

?>


<div class="container">
    <div class="row ">
        <div class="col">
            <ul class="filters_menu">
                <li class="active" data-filter="*">
                    全部地區
                </li>
                <li data-filter=".台北,.中正區,.大同區,.中山區,.松山區,.大安區,.萬華區,.信義區,.士林區,.北投區,.內湖區,.南港區,.文山區">
                    台北地區
                </li>
                <li data-filter=".新北,.萬里區,.金山區,.板橋區,.汐止區,.深坑區,.石碇區,.瑞芳區,.平溪區,.雙溪區,.貢寮區,.新店區,.坪林區,.烏來區,.永和區,.中和區,.土城區,.三峽區,.樹林區,.鶯歌區,.三重區,.新莊區,.泰山區,.林口區,.蘆洲區,.五股區,.八里區,.淡水區,.三芝區,.石門區">
                    新北地區
                </li>
            </ul>
        </div>
    </div>

    <div class="row" style="margin-top: -30px;">
        <div class="col">
            <ul class="filters_menu" style="justify-content:left;">
                <button disabled style="padding: 7px 20px;border:0; border-radius: 20px; background-color: #343a40; color: #ffffff; margin-right:20px">
                    <b>台北：</b>
                </button>
                <?php while ($row = mysqli_fetch_assoc($Rgn_tp_result)) { ?>
                    <li data-filter=".<?php echo $row['Frij_Rgn'] ?>">
                        <?php echo $row['Frij_Rgn'] ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="row" style="margin-top: -30px;">
        <div class="col">
            <ul class="filters_menu" style="justify-content:left;">
                <button disabled style="padding: 7px 20px;border:0; border-radius: 20px; background-color: #343a40; color: #ffffff; margin-right:20px">
                    <b>新北：</b>
                </button>
                <?php while ($row = mysqli_fetch_assoc($Rgn_ntp_result)) { ?>
                    <li data-filter=".<?php echo $row['Frij_Rgn'] ?>">
                        <?php echo $row['Frij_Rgn'] ?>
                    </li>
                <?php } ?>

            </ul>

        </div>
        <?php if ($_SESSION["filters_menu_county"] != 'fridge_mgmt') { ?>
            <div class="col" align="right" style="margin: 45px 0 20px 0;">
                <button class="btn btn-warning my-2 my-sm-0" type="submit" name="cross_fridge_food_submitbutton" style="color:#343a40;">
                    <b>跨查冰箱內食物</b>
                </button>
            </div>
        <?php } ?>
    </div>


</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .filters_menu .li {
        margin-bottom: 10px;
    }
</style>