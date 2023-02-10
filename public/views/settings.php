<!DOCTYPE html>
<head>
    <title>WORKOUT HISTORY</title>
    <link rel="stylesheet" type="text/css" href="public/css/style-app.css">
    <script src="https://kit.fontawesome.com/a3055391a0.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="top-container">
    <div class="torch">
        <img src="public/img/torch.svg" class="torch">
    </div>
    <div id="logo">
        <img src="public/img/olymper.svg" id="logo">
    </div>
    <div class="torch">
        <img src="public/img/torch.svg" class="torch">
    </div>
    <nav class="top-nav">
        <button onclick="document.location='summary'" class="top-nav-button">
            <i class="fa-solid fa-chart-line"></i>
            SUMMARY
        </button>
        <button onclick="document.location='add_routine'" class="top-nav-button">
            <i class="fa-solid fa-plus"></i>
            ADD ROUTINE
        </button>
        <button onclick="document.location='add_workout'" class="top-nav-button">
            <i class="fa-solid fa-plus"></i>
            ADD WORKOUT
        </button>
        <button onclick="document.location='add_exercise'" class="top-nav-button">
            <i class="fa-solid fa-plus"></i>
            ADD EXERCISE
        </button>
        <button onclick="document.location='workout_history'" class="top-nav-button">
            <i class="fa-solid fa-magnifying-glass"></i>
            WORKOUT HISTORY
        </button>
        <button class="top-nav-button active">
            <i class="fa-solid fa-gear"></i>
            SETTINGS
        </button>
    </nav>
</div>

<main>
    <div class="main-top">
        <div class="left-handler">
            <div class="left-handler-l">
            </div>
            <div class="left-handler-r">
            </div>
        </div>
        <div class="pipe-handler">
            <h1>Workout History</h1>
        </div>
        <div class="right-handler">
            <div class="right-handler-l">
            </div>
            <div class="right-handler-r">
            </div>
        </div>
    </div>
    <form id="logoutForm" method="post" action="logout"></form>

    <div class="main-mid">
        <div class="main-mid admin">
            <button class="mid-cat-button" form="logoutForm" type="submit">
                Logout
            </button>
        </div>
    </div>

    <div class="main-bot">
        <div class="left-handler">
            <div class="left-handler-l">
            </div>
            <div class="left-handler-r">
            </div>
        </div>
        <div class="pipe-handler"></div>
        <div class="right-handler">
            <div class="right-handler-l">
            </div>
            <div class="right-handler-r">
            </div>
        </div>
    </div>
</main>

<div class="bot-container">
</div>
</body>