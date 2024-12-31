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
session_start();
$Frij_Addr = $_GET['Frij_Addr'];
$Food_ID = $_GET['Food_ID'];
$Regd_Tel = $_SESSION['User_Tel'];

$selectFood_sql = "select Food_Name,Food_Ph_Path,Food_RsvnQty,Regd_Tel from food as f,reservationlist as r where f.Food_ID = $Food_ID and r.Food_ID = $Food_ID and Regd_Tel = $Regd_Tel";

$selectFood_result = mysqli_query($_SESSION["connect"], $selectFood_sql);
while ($row = mysqli_fetch_assoc($selectFood_result)) {

?>

    <body>
        <div class="hero_area">
            <!-- book section -->
            <section class="book_section layout_padding">
                <div class="container">
                    <div class="heading_container">
                        <h2>
                            確認領取
                        </h2>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <p><b>請確認預約資訊：</b></p>
                            <form class="form_container" action="index.php?method=receive_check&Food_ID=<?php echo $Food_ID; ?>&Regd_Tel=<?php echo $row['Regd_Tel']; ?>" method="post" enctype="multipart/form-data">
                                <input type=hidden name="dbaction" value="receive_check">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">冰箱：</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $Frij_Addr ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">食物:</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $row['Food_Name'] ?>" readonly>
                                </div>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">領取照片</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" name="size" value="1000000" required>
                                            <input type="file" class="custom-file-input" id="customFile" name="check_ph">
                                            <label class="custom-file-label" for="customFile">選擇照片</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="btn_box">
                                    <button type="submit">
                                        <b>確認領取</b>
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
    <?php
include "foot.php";
?>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
