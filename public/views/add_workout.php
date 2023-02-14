<!DOCTYPE html>
<head>
    <title>ADD WORKOUT</title>
    <link rel="stylesheet" type="text/css" href="public/css/style-app.css">
    <script src="https://kit.fontawesome.com/a3055391a0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/public/js/addSet.js" defer></script>
    <script type="text/javascript" src="/public/js/saveWorkout.js" defer></script>

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
            <button class="top-nav-button active">
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
                <h1>Add Workout</h1>
            </div>
            <div class="right-handler">
                <div class="right-handler-l">
                </div>
                <div class="right-handler-r">
                </div>
            </div>
          </div>



        <div class="main-mid">
            <div class="main-mid workout">
                <div  class="routine-exercises">
                    Workout:
                    <input id="workout-name"  type="text" placeholder="Heavy Push.." class="routine-text">
                </div>
                <div  class="routine-exercises">
                    Description:
                    <textarea id="workout-description"  placeholder="Light training, intensity is 80% of B routine.." class="routine-text"></textarea>
                </div>
                <div  class="routine-exercises">
                    Total Time:
                    <input id="workout-time"  type="time" class="routine-text">
                </div>
                <button class="save-workout">
                    <i class="fa-solid fa-book-open"></i>
                    Save workout
                </button>
            </div>
            <div class="mid-exercise">
                <div id="next-row"></div>
                <div class="main-mid workout">
                    <div>
                        <button id="save-set" class="mid-cat-button save">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
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