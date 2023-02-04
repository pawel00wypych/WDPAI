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
            <div class="hint">SUMMARY:<br/>- Workout Statistics<br/>- Excersise Statistics</div>
        </button>
        <button onclick="document.location='add_routine'" class="top-nav-button">
            <i class="fa-solid fa-plus"></i>
            ADD ROUTINE
            <div class="hint">ADD ROUTINE:<br/>Add Scheme that contains<br/>- Name of Routine<br/>- Excersises<br/>- Description</div>
        </button>
        <button onclick="document.location='add_workout'" class="top-nav-button">
            <i class="fa-solid fa-plus"></i>
            ADD WORKOUT
            <div class="hint">ADD WORKOUT:<br/>- Add workout that you completed to history<br/>- Add workout from template, copy previous<br/>- Add details</div>
        </button>
        <button onclick="document.location='add_exercise'" class="top-nav-button">
            <i class="fa-solid fa-plus"></i>
            ADD EXERCISE
            <div class="hint">ADD EXERCISE:<br/>- Add name<br/>- Choose category<br/>- Add description</div>
        </button>
        <button onclick="document.location='workout_history'" class="top-nav-button">
            <i class="fa-solid fa-magnifying-glass"></i>
            WORKOUT HISTORY
            <div class="hint">WORKOUT HISTORY<br/>- Check previous workouts</div>
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
    <form id="settingsForm" method="post" action="logout"></form>

    <div class="main-mid">
        <button form="settingsForm" type="submit">
            logout
        </button>
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