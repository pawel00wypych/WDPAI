<!DOCTYPE html>
<head>
    <title>WORKOUT HISTORY</title>
    <link rel="stylesheet" type="text/css" href="public/css/style-app.css">
    <script src="https://kit.fontawesome.com/a3055391a0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/public/js/showWorkouts.js" defer></script>

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
            <button class="top-nav-button active">
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
                <h1>Workout History</h1>
            </div>
            <div class="right-handler">
                <div class="right-handler-l">
                </div>
                <div class="right-handler-r">
                </div>
            </div>
          </div>

          <div class="main-mid">
              <div class="main-mid history">
                  <div class="main-mid training">

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


<template id="workout-template">
    <div class="line"></div>
    <h1 class="training header-main">Workout</h1>
    <div class="headers">
        <div  class="property name">
            <h1 id="training-name-h1" class="training header name">name</h1>
            <div id="text1">A</div>
        </div>
        <div class="property">
            <h1 class="training header">date</h1>
            <div id="text2">12.02.2023</div>
        </div>
        <div class="property">
            <h1 class="training header">total-time</h1>
            <div id="text3">2:30</div>
        </div>
        <div class="property">
            <h1 class="training header">total-hsr</h1>
            <div id="text4">42</div>
        </div>
        <div class="property">
            <h1 class="training header">total-volume</h1>
            <div id="text5">4320 kg</div>
        </div>
        <div class="property">
            <h1 class="training header">total-reps</h1>
            <div id="text6">82</div>
        </div>
    </div>
    <h1 class="training header-main">Exercises:</h1>
</template>

<template id="exercise-template">
    <div class="exercise">
        <div class="property name">
            <h1 class="training header name">name</h1>
            <div id="text7">Squat</div>
        </div>
        <div class="property">
            <h1 class="training header">description</h1>
            <div id="text8">hard...</div>
        </div>
        <div class="property">
            <h1 class="training header">total-hsr</h1>
            <div id="text9">2:30</div>
        </div>
        <div class="property">
            <h1 class="training header">total-reps</h1>
            <div id="text10">42</div>
        </div>
        <div class="property">
            <h1 class="training header">total-volume</h1>
            <div id="text11">4320 kg</div>
        </div>
        <div class="property">
            <h1 class="training header">rest</h1>
            <div id="text12">1:00</div>
        </div>
    </div>
</template>
<template id="set-template">
    <div class="sets">
        <div class="sets set">
            <div class="set-property name">
                <h1 class="training set-header name">Set:</h1>
                <div id="text13">1</div>
            </div>
            <div class="set-property">
                <h1 class="training set-header">Weight:</h1>
                <div id="text14">100 kg</div>
            </div>
            <div class="set-property">
                <h1 class="training set-header">Reps:</h1>
                <div id="text15">8</div>
            </div>
            <div class="set-property">
                <h1 class="training set-header">RIR:</h1>
                <div id="text16">2</div>
            </div>
            <div class="set-property">
                <h1 class="training set-header">RPE:</h1>
                <div id="text17">8</div>
            </div>
        </div>
    </div>
</template>