<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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
            margin-top: 10px;
            font-weight: bold;
            font-size: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .back-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<br><br><br><br>
    <div class="loader"></div>
    <div class="text">If you have forgotten your password, please try to remember it...</div>
    <div class="button-container">
        <button class="back-button" onclick="goBack()">Go Back to Login Page</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
