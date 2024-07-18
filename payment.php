<?php $activePage = 'payment'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <style>
        .loader {
            border: 16px solid lightgray;
            border-radius: 50%;
            border-top: 16px solid black;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            margin: 100px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .text {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <br><br><br><br>
    <div class="loader"></div>
    <div class="text">Webpage under process. Please wait...</div>
</body>
</html>
