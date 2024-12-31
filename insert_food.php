<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<!--owl slider stylesheet -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<!-- nice select  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
<!-- font awesome style -->
<link href="css/font-awesome.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="css/responsive.css" rel="stylesheet" />

<?php
ini_set("display_errors", "Off");

session_start();

$_SESSION["connect"] = mysqli_connect("localhost", "root", "", "共享冰箱");
mysqli_set_charset($_SESSION["connect"], "utf8mb4");

include "head.php";

?>

<style>
    body {
        background-color: #FEF4ED;
    }
</style>

<?php
$Frij_ID = $_GET['Frij_ID'];
$Frij_Addr = $_GET['Frij_Addr'];
?>

<body>
    <div class="hero_area">
        <!-- book section -->
        <section class="book_section layout_padding">
            <div class="container">
                <div class="heading_container">
                    <h2>
                        分享食物
                    </h2>
                    <br>
                    <p>謝謝你願意分享食物
                        您將要分享食物的冰箱為：<b><?php echo $Frij_Addr; ?></b>
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form_container">
                            <p>
                                請輸入以下資訊:</p>
                            <form action="index.php?method=dblink&Frij_ID=<?php echo $Frij_ID; ?>" method="post" enctype="multipart/form-data">
                                <input type=hidden name="dbaction" value="insert_food">
                                <div>
                                    <input type="text" class="form-control" placeholder="食物名稱" name="Food_Name" required />
                                </div>
                                <div>
                                    <select class="form-control nice-select wide" name="Food_Cat" required>
                                        <option value="" disabled selected>
                                            食物類別
                                        </option>
                                        <option value="飲料">
                                            飲料
                                        </option>
                                        <option value="乾糧">
                                            乾糧
                                        </option>
                                        <option value="蔬果">
                                            蔬果
                                        </option>
                                        <option value="熟食">
                                            熟食
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <input type="int" class="form-control" placeholder="食物數量" name="Food_Qty" required />
                                </div>
                                <div>
                                    <label for="select1"><b>食物有效期限</b></label>
                                    <div>
                                        <input type="datetime-local" class="form-control" name="Food_Exp" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">食物照片</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" name="size" value="1000000" required>
                                            <input type="file" class="custom-file-input" id="customFile" name="myfile">
                                            <label class="custom-file-label" for="customFile">選擇照片</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="btn_box">
                                    <button type="submit">
                                        <b>確定登記</b>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="cover" class="coverflow">
                            <a href='#'><img src='images/food1.jpg' alt=' ' width="550" height="450"></a>
                            <a href='#'><img src='images/food2.jpg' alt=' ' width="550" height="450"></a>
                            <a href='#'><img src='images/food3.jpg' alt=' ' width="550" height="450"></a>

                        </div>
                    </div>
        </section>
        <!-- end book section -->
    </div>

</body>
<?php
include "foot.php";
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

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

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>