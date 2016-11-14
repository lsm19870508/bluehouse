<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{trans("app.401.title")}}</title>

    <style type="text/css">

        body {
            background: whitesmoke;
        }

        .error_message {
            margin: 40px auto 0;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .error_message .inner {

        }

        .error_message .msg_icon_wrp {
            display: block;
        }

        .error_icon {
            background: transparent url("/img/error/error.png") no-repeat scroll 0 0;
            display: inline-block;
            height: 80px;
            vertical-align: middle;
            width: 80px;
        }
    </style>

</head>
<body>
<div class="error_message">
    <div class="inner">
            <span class="msg_icon_wrp">
                <i class="error_icon"></i>
            </span>
        <div class="msg_content">
            <h4 id="err_msg">{{$content}}</h4>
        </div>
    </div>
</div>
</body>
</html>