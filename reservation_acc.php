

<body>
    <div class="hero_area">
        <!-- registration section -->
        <section class="book_section layout_padding">
            <div class="container">
                <div class="heading_container">
                    <h2>
                        註冊帳號
                    </h2>
                </div>
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <div class="card card-registration my-4">
                                <div class="row g-0">
                                    <div class="col-xl-6 d-none d-xl-block">
                                        <img src="images/registrationphoto.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card-body p-md-5 text-black">
                                            <h3 class="mb-5 text-uppercase">請需入以下資訊</h3>


                                            <form method="post">
                                                <div class="form-outline mb-3">
                                                    <label>您的名字：</label>
                                                    <input type=text class="form-control" placeholder="Name" name="User_Name">
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label">電話號碼：</label>
                                                    <input type="tel" class="form-control" placeholder="Phone number" name="User_Tel">
                                                </div>



                                                <div class="form-outline mb-3">
                                                    <label>密碼：</label>
                                                    <input type=text class="form-control" placeholder="Password" name="User_Pw">
                                                </div>

                                                <div class="d-flex justify-content-center pt-3">
                                                    <button type="submit" class="btn btn-warning btn-lg ms-2" name="insertsubmit">確認並註冊</button>
                                                </div>
                                            </form>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <!-- end registration section -->
    </div>

</body>

<?php
session_start();
$User_Tel = $_POST['User_Tel'];
$User_Name = $_POST['User_Name'];
$User_Pw = $_POST['User_Pw'];
$_SESSION['User_Name'] = $User_Name;


$insertsql  = "insert into account (User_Tel, User_Name , User_Pw) values ('$User_Tel', '$User_Name', '$User_Pw')";

if (array_key_exists('insertsubmit', $_POST)) {

    if (mysqli_query($_SESSION["connect"], $insertsql)) {
        echo '<script>location.href="alert.php?message=註冊成功&url=index.php"</script>';

    } else {
        echo '<script>location.href="alert.php?message=註冊失敗&url=index.php"</script>';


    }
}
?>

<style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }
</style>

</html>