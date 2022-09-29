<?php
$icon_sql = "SELECT image FROM setting_table WHERE 1";
$query_ico = mysqli_query($conn, $icon_sql);
$icon = mysqli_fetch_assoc($query_ico);
?>

<!--inizio header-->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="assets/images/site/<?php echo $icon['image']; ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title><?php echo $name_page; ?></title>

    <style>
        body {
            background: #F0F2F5;
        }

        .white {
            background-color: #ffffff;
        }

        #add-category-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        #add-food-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .tooltip-arrow {
            display: none !important;
        }
        @media only screen and (max-width: 575px) {
            
        }
    </style>
</head>

<body>
    <!--fine header-->