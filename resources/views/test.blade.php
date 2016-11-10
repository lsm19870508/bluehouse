<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="app-type" content="main"/>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="appId" content="{{$config['appId']}}"/>
    <meta name="timestamp" content="{{$config['timestamp']}}"/>
    <meta name="noncestr" content="{{$config['noncestr']}}"/>
    <meta name="signature" content="{{$config['signature']}}"/>
    <meta name="status" content="{{$config['status']}}"/>
    <link rel="icon" href="/client/assets/img/qm.ico">
    <title>全民联赛</title>
    <link rel="stylesheet" href="/client/assets/css/no1basketball-cb9c39b6f5.min.css">
    <script data-main="/client/assets/js/no1basketball-3cfd7ace54.min" src="/client/assets/js/libs/r/require.js"></script>
</head>
<body>
<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>
<div class="views">
    <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left">

                </div>
                <div class="center sliding"></div>
                <div class="right">
                    <a href="#" class="link open-popover">
                        <i class="icon icon-user"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Pages container -->
        <div class="pages navbar-through toolbar-fixed">
            <!-- Page -->
            <div data-page="index" class="page  no1bb-player-page">
                <!-- Scrollable page content -->
                <div class="page-content">
                    <div class="content-block index-player-info-container">

                    </div>
                    <div class="content-block info-container for-index">

                    </div>
                    <div class="content-block content-container for-index">

                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Toolbar-->
    </div>
</div>
<!--getCode panel-->
<div class="login-screen modal-in login-bg">
    <!-- Default view-page layout -->
    <div class="view">
        <div class="page" data-page="code">
            <!-- page-content has additional login-screen content -->
            <div class="page-content login-screen-content auth">
                <div class="auth-logo">
                    <img src="/client/assets/img/auth/logo.png">
                </div>
                <!-- GetCode form -->
                <form method="post" id="getCodeForm" action="/qmstat/code" class="form ajax-submit" enctype="application/x-www-form-urlencoded">
                    <div class="list-block inset">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="text" name="phone" placeholder="请输入手机号码" required maxlength="11" onkeyup="value=this.value.replace(/\D+/g,'')">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="list-block inset">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="submit" class="button red-gradient-button" value="获取验证码">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--login panel-->
<div class="popup popup-login login-bg">
    <!-- Default view-page layout -->
    <div class="view">
        <div class="page" data-page="login">
            <!-- page-content has additional login-screen content -->
            <div class="page-content login-screen-content auth">
                <div class="login-screen-title auth-title">
                    <div class="back-container">
                        <a href="#" class="back link">
                            <i class="icon icon-back color-white"></i>
                        </a>
                    </div>
                    <div class="auth-logo">
                        <img src="/client/assets/img/auth/logo.png">
                    </div>
                </div>
                <!-- Login form -->
                <form method="post" id="loginForm" action="/weixin/auth/login" class="form ajax-submit" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="phone">
                    <div class="list-block inset">
                        <p class="code-sent">验证码已发送至 <span id="phoneInfo"></span></p>
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-input code-container">
                                        <input type="text" name="code" placeholder="请输入验证码" required maxlength="4" onkeyup="value=this.value.replace(/\D+/g,'')">
                                    </div>
                                    <div class="cool-down">60s</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="list-block inset">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="submit" class="button red-gradient-button" value="进入">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Links popover -->
<div class="popover">
    <div class="popover-angle"></div>
    <div class="popover-inner">
        <div class="list-block">
            <ul>

            </ul>
        </div>
    </div>
</div>
</body>
</html>