<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
        }

        body {
            background: #f4f4f4;
            direction: rtl;
        }

        .box {
            width: 400px;
            margin: 0 auto;
            box-shadow: 0 0 0 1px rgba(53, 72, 91, .1), 0 2px 2px rgba(0, 0, 0, .0274351), 0 4px 4px rgba(0, 0, 0, .0400741), 0 10px 8px rgba(0, 0, 0, .0499982), 0 15px 15px rgba(0, 0, 0, .0596004), 0 30px 30px rgba(0, 0, 0, .0709366), 0 70px 65px rgba(0, 0, 0, .09);
            border-radius: 10px;
            padding: 20px 0 0 0;
            background: white;
        }

        .main {
            display: flex;
            padding: 50px 0;
            justify-content: center;
            align-content: center;
            flex-direction: column;
        }

        .menu {
            display: flex;
            justify-content: center;
            border-top: 1px solid #e2e2e2;
            background: #7e8a97;
            margin-top: 10px;
            border-radius: 0 0 10px 10px;
            padding: 5px 0;
        }

        .menu ul li {
            display: inline-flex;
        }

        .menu ul li a {
            color: white;
            font-size: 15px;
        }
    </style>
</head>
<body>
<div style="text-align: center">
    <div class="main">
        <div class="box">
            <h1>404</h1>
            <div class="menu">
                <ul>
                    <li><a href="/">بازگشت به صفحه اصلی</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
