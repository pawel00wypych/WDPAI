const workoutsContainer = document.querySelector(".main-mid.training");
const workoutTemplate = document.querySelector("#workout-template");
const exerciseTemplate = document.querySelector("#exercise-template");
const setTemplate = document.querySelector("#set-template");

function showWorkouts() {

    fetch("/getWorkouts")
        .then(function (response) {
            return response.json();
        }).then(function (workouts) {
        workoutsContainer.innerHTML = "";
        fetch("/getExercises")
            .then(function (response) {
            return response.json();
        }).then(function (exercises) {
            fetch("/getSetsOfExercise")
                .then(function (response){
                return response.json();
            }).then(function (sets) {
                loadWorkouts(workouts, exercises, sets);
            });
        });
    });
}

function loadWorkouts(workouts, exercises, sets) {

    workouts.forEach(workout => {
        showWorkout(workout, exercises, sets);
        loadExercises(workout, exercises, sets);
    });
}

function showWorkout(workout) {

    const clone = workoutTemplate.content.cloneNode(true);

    const name = clone.querySelector("#text1");
    name.innerHTML = workout["workout_name"];
    const date = clone.querySelector("#text2");
    date.innerHTML = workout["created_at"];
    const duration = clone.querySelector("#text3");
    duration.innerHTML = workout["total_time"];
    const hsr = clone.querySelector("#text4");
    hsr.innerHTML = workout["total_hsr"];
    const volume = clone.querySelector("#text5");
    volume.innerHTML = workout["total_volume"] + " kg";
    const reps = clone.querySelector("#text6");
    reps.innerHTML = workout["total_reps"];
    const bw = clone.querySelector("#text61");
    bw.innerHTML = workout["body_weight"];

    workoutsContainer.appendChild(clone);
}

function loadExercises(workout, exercises, sets) {

    exercises.forEach(exercise => {
        if(workout["id_exercise"] === exercise["id_exercise"]) {
            showExercise(workout, exercise);
            loadSets(exercise, sets);
        }
    });
}


function showExercise(workout, exercise) {

        const clone = exerciseTemplate.content.cloneNode(true);

        const name = clone.querySelector("#text7");
        name.innerHTML = exercise["exercise_name"];
        const desc = clone.querySelector("#text8");
        desc.innerHTML = exercise["description"];
        const hsr = clone.querySelector("#text9");
        hsr.innerHTML = exercise["total_hsr"];
        const reps = clone.querySelector("#text10");
        reps.innerHTML = exercise["total_reps"];
        const volume = clone.querySelector("#text11");
        volume.innerHTML = exercise["total_volume"] + " kg";
        const brk = clone.querySelector("#text12");
        brk.innerHTML = exercise["break"];

        workoutsContainer.appendChild(clone);
}

function loadSets(exercise, sets) {
    let id = 0;
     sets.forEach(set => {
         if(exercise["id_exercise"] === set["id_exercise"]) {
             showSets(exercise, set, id);
             id++;
         }
     });
}


function showSets(exercise, set, id) {

        const clone = setTemplate.content.cloneNode(true);

        const setNumber = clone.querySelector("#text13");
        setNumber.innerHTML = id + 1;
        const weight = clone.querySelector("#text14");
        weight.innerHTML = set["weight"] + " kg";
        const reps = clone.querySelector("#text15");
        reps.innerHTML = set["reps"];
        const rir = clone.querySelector("#text16");
        rir.innerHTML = set["rir"];
        const rpe = clone.querySelector("#text17");
        rpe.innerHTML = set["rpe"];


        workoutsContainer.appendChild(clone);
}

document.addEventListener('readystatechange', event => {
    switch (document.readyState) {
        case "loading":
            console.log("document.readyState: ", document.readyState,
                `- The document is still loading.`
            );
            break;
        case "interactive":
            console.log("document.readyState: ", document.readyState,
                `- The document has finished loading DOM. `,
                `- "DOMContentLoaded" event`
            );
            break;
        case "complete":
            showWorkouts();
            break;
    }
});