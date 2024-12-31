<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/building.png" type="">
    <title>共享冰箱</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body style="background-color:#fef4ed">


    <?php
    ini_set("display_errors", "Off");

    session_start();
    $_SESSION["filters_menu_county"] = 'else';
    $_SESSION["connect"] = mysqli_connect("localhost", "root", "12345678", "共享冰箱");
    mysqli_set_charset($_SESSION["connect"], "utf8mb4");

    include "head.php";
    $method = $_GET['method'];
    switch ($method) {
        case "fridge":
            include "fridge.php";
            break;
        case "food_insidefridge":
            include "food_insidefridge.php";
            break;
        case "insert_food":
            include "insert_food.php";
            break;
        case "reservation_acc":
            include "reservation_acc.php";
            break;
        case "logout":
            include "logout.php";
            break;
        case "logincheck":
            include "logincheck.php";
            break;
        case "dblink":
            include "dblink.php";
            break;
        case "reservation_food":
            include "reservation_food.php";
            break;
        case "reservation_check":
            include "reservation_check.php";
            break;
        case "insert_fridge":
            include "insert_fridge.php";
            break;
        case "reservation_list":
            include "reservation_list.php";
            break;
        case "un_reservation":
            include "un_reservation.php";
            break;
        case "un_reservation2":
            include "un_reservation2.php";
            break;
        case "receive":
            include "receive.php";
            break;
        case "receive_check":
            include "receive_check.php";
            break;
        case "all_food":
            include "all_food.php";
            break;
        case "cross_fridge_food":
            include "cross_fridge_food.php";
            break;
        case "verification":
            include "verification.php";
            break;
        case "favourite_insert":
            include "favourite_insert.php";
            break;
        case "favourite_list":
            include "favourite_list.php";
            break;
        case "un_favourite":
            include "un_favourite.php";
            break;
        case "fridge_mgmt":
            include "fridge_mgmt.php";
            break;
        case "fridge_delete":
            include "fridge_delete.php";
            break;
        case "food_mgmt":
            include "food_mgmt.php";
            break;
        case "food_delete":
            include "food_delete.php";
            break;
        case "receive_list":
            include "receive_list.php";
            break;
        case "main":
            include "main.php";
            break;
        case "verification_check":
            include "verification_check.php";
            break;
        default:
            include "main.php";
            break;
    }
    include "foot.php";
    ?>


    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->
</body>

</html>