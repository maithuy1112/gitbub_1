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

<body>
    <div class="hero_area">
        <!-- book section -->
        <section class="book_section layout_padding">
            <div class="container">
                <div class="heading_container">
                    <h2>
                        新增冰箱
                    </h2>
                    <br>
                    <p>若想使用本系統分享食物，歡迎登記一個冰箱。
                        <br>
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form_container">
                            <p>
                                請輸入以下資訊:</p>
                            <form action="index.php?method=dblink" method="post" enctype="multipart/form-data">
                                <input type=hidden name="dbaction" value="insert_fridge">
                                <select id="countySelect" class="form-control nice-select wide" name="Frij_County">
                                    <option value="">選擇縣市</option>
                                    <option value="台北">台北市</option>
                                    <option value="新北">新北市</option>
                                </select>

                                <select id="districtSelect" class="form-control nice-select wide" name="Frij_Rgn">
                                    <option value="">選擇地區</option>
                                </select>
                                <div>
                                    <input type="text" class="form-control" placeholder="冰箱地址" name="Frij_Addr" required />
                                </div>
                                <div>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">冰箱照片</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" name="size" value="1000000" required>
                                            <input type="file" class="custom-file-input" id="customFile" name="Frij_Ph">
                                            <label class="custom-file-label" for="customFile">選擇照片</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="btn_box">
                                    <button type="submit" style="margin-top: 40px;">
                                        <b>確認資料並新增</b>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src='images/fridge1.jpg' alt=' ' width="550" height="350">
                    </div>
        </section>
        <!-- end book section -->
    </div>

</body>

<?php
include "foot.php";
?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    var $j = jQuery.noConflict(); // 使用 $j 代替 $

    $j(document).ready(function() {
        var districtData = {
            新北: ['板橋區', '新莊區', '永和區', '中和區', '土城區', '三峽區', '蘆洲區', '五股區', '泰山區', '林口區', '淡水區', '三重區', '汐止區', '瑞芳區', '八里區', '樹林區', '鶯歌區', '三芝區', '金山區', '萬里區', '石門區'],
            台北: ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區', '南港區', '文山區']
        };

        $j("#countySelect").change(function() {
            var selectedCounty = $j(this).val();
            var districtOptions = "";

            if (selectedCounty !== "") {
                var districts = districtData[selectedCounty];
                for (var i = 0; i < districts.length; i++) {
                    districtOptions += "<option value='" + districts[i] + "'>" + districts[i] + "</option>";
                }
            }

            $j("#districtSelect").html("<option value=''>選擇地區</option>" + districtOptions);
        });
    });
</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>