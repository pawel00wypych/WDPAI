<!DOCTYPE html>
<head>
    <title>SUMMARY</title>
    <link rel="stylesheet" type="text/css" href="public/css/style-app.css">
    <script src="https://kit.fontawesome.com/a3055391a0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/public/js/summary.js" defer></script>
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
                    <button  class="top-nav-button active">
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
                    <button onclick="document.location='settings'" class="top-nav-button">
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
                <h1>Summary</h1>
            </div>
            <div class="right-handler">
                <div class="right-handler-l">
                </div>
                <div class="right-handler-r">
                </div>
            </div>
          </div>

          <div class="main-mid">
              <div id="summary">

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

<template id="summary-template">
    <div class="summary-container">
        <div id="last-training">
            <div id="last-training-1"></div>
            <div id="last-training-2"></div>
            <div id="last-training-3"></div>
            <div id="last-training-4"></div>
            <div id="last-training-5"></div>
            <div id="last-training-6"></div>
            <div id="last-training-7"></div>
            <div id="last-training-8"></div>
        </div>
    </div>
    <div class="summary-container">
        <div id="total-workouts">total workouts</div>
    </div>
    <div class="summary-container">
        <div id="total-volume">total volume</div>
    </div>
    <div class="summary-container">
        <div id="total-reps">total reps</div>
    </div>
    <div class="summary-container">
        <div id="total-hsr">total hsr</div>
    </div>
    <div class="summary-container">
        <div id="chart">chart</div>
    </div>
</template>