<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="/public/js/loginValidation.js" defer></script>

</head>
<body>
    <div class="container">
        <div class="greek-pattern"> 
            <img src="public/img/greek_pt_top.svg" id="greek-pt-top">
            <div class="greek-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">

            </div>
            <img src="public/img/greek_pt_bot.svg" id="greek-pt-bot">
        </div>
        <div class="main-section">
            <div class="logo">
                <img src="public/img/olymper.svg" class="logo">
            </div>
            <div class="login-container">
                <div class="login-container-in1 form">
                        <form class="login_and_register" action="login" method="POST" >
                            <div id="email-1">
                                EMAIL:
                            </div>
                            
                            <input name="email" type="email" placeholder="email@email.com" required>
                            <div id="password-1">
                                PASSWORD:
                            </div>
                            <input name="password" type="password" placeholder="password" required>
                            <div></div>
                            <button type="submit">
                                LOGIN
                            </button>
                            <div></div>
                            <button class="fb-button">
                                <img src="public/img/fb_icon.svg" class="fb-icon">
                                WITH FACEBOOK
                            </button>
                        </form>
                    <div class="messages" >
                        <?php if(isset($messages)) {
                            foreach ($messages as $message)
                                echo $message;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="greek-pattern">
            <img src="public/img/greek_pt_top.svg" id="greek-pt-top">
            <div class="greek-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">
                <img src="public/img/greek_pt_cntr.svg" id="greek-pt-cntr">

            </div>
            <img src="public/img/greek_pt_bot.svg" id="greek-pt-bot">
        </div>
        <div class="footer">
             <div class="footer-text">Terms & Conditions</div>
             <div class="footer-text">Privacy Policy</div>
             <div class="footer-text">Contact Us</div>
             <div class="footer-text">© 2021 Olymper Inc. All rights reserved.</div>
        </div>
    </div>
</body>