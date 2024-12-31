<?php
session_start();
$Frij_Addr = $_GET['Frij_Addr'];
$Food_ID = $_GET['Food_ID'];

$selectFood_sql = "select Food_Name,Food_Ph_Path,Food_RsvnQty from food where Food_ID = $Food_ID";

$selectFood_result = mysqli_query($_SESSION["connect"], $selectFood_sql);
$_SESSION["dbaction"] ="insert";
while ($row = mysqli_fetch_assoc($selectFood_result)) {

?>

    <body>
        <div class="hero_area">
            <!-- book section -->
            <section class="book_section layout_padding">
                <div class="container">
                    <div class="heading_container">
                        <h2>
                            預約食物
                        </h2>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <p><b>請確認預約資訊：</b></p>
                            <form class="form_container" action="index.php?method=reservation_check&Food_ID=<?php echo $Food_ID; ?>" method="post">
                                <input type=hidden name='$_SESSION["dbaction"]' value="insert">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">冰箱：</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $Frij_Addr ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">食物:</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $row['Food_Name'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">預約數量（剩餘數量：<b><?php echo $row['Food_RsvnQty'] ?></b>）:</label>
                                    <input type="number" class="form-control" name="Regd_Qty" min="1" max="<?php echo $row['Food_RsvnQty'] ?>">
                                </div>
                                <div class="btn_box">
                                    <button type="submit">
                                        <b>確定預約</b>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div id="cover" class="coverflow">
                                <img src='<?php echo $row['Food_Ph_Path'] ?>' alt=' ' width="450" height="350">
                            </div>
                        </div>
            </section>
            <!-- end book section -->
        </div>
    <?php
};
    ?>
    </body>

    <style>
        .coverflow {
            width: 550px;
            height: 330px;
            position: relative;
        }

        .coverflow>a {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            filter: alpha(opacity=0);
            /*當圖片數量增加，影片長度需更改，變為5s*圖片數量*/
            -webkit-animation: silder 15s linear infinite;
            animation: silder 15s linear infinite;
        }

        .coverflow>a>img {
            max-width: 100%;
        }

        /*動畫關鍵影格*/
        @-webkit-keyframes silder {
            10% {
                opacity: 1;
                filter: alpha(opacity=100);
            }

            27% {
                opacity: 1;
                filter: alpha(opacity=100);
            }

            30% {
                opacity: 0;
                filter: alpha(opacity=0);
            }
        }

        @keyframes silder {
            10% {
                opacity: 1;
                filter: alpha(opacity=100);
            }

            27% {
                opacity: 1;
                filter: alpha(opacity=100);
            }

            30% {
                opacity: 0;
                filter: alpha(opacity=0);
            }
        }

        /*每個圖片各延遲5秒*/
        .coverflow>a:nth-child(3) {
            -webkit-animation-delay: 10s;
            animation-delay: 10s;
        }

        .coverflow>a:nth-child(2) {
            -webkit-animation-delay: 5s;
            animation-delay: 5s;
        }

        .coverflow>a:nth-child(1) {
            -webkit-animation-delay: 0s;
            animation-delay: 0s;
        }
    </style>