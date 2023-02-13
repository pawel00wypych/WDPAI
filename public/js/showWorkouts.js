const workoutsContainer = document.querySelector(".main-mid.history");
const template = document.querySelector("#history-template");
const clone = template.content.cloneNode(true);

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
                console.log(workouts);
                console.log(exercises);
                console.log(sets);
                loadWorkouts(workouts, exercises, sets)
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

    const div = clone.querySelector(".main-mid.training");
    div.id = workout["id_user"];
    const name = clone.querySelector("#text1");
    name.innerHTML = workout["workout_name"]
    const date = clone.querySelector("#text2");
    date.innerHTML = workout["created_at"]
    const duration = clone.querySelector("#text3");
    duration.innerHTML = workout["total_time"]
    const hsr = clone.querySelector("#text4");
    hsr.innerHTML = workout["total_hsr"]
    const volume = clone.querySelector("#text5");
    volume.innerHTML = workout["total_volume"]
    const reps = clone.querySelector("#text6");
    reps.innerHTML = workout["total_reps"]

    workoutsContainer.appendChild(clone);
}

function loadExercises(workout, exercises, sets) {

    exercises.forEach(exercise => {
        showExercise(workout, exercise, sets);
        loadSets(exercise, sets);
    });
}


function showExercise(workout, exercise) {

    if(workout["id_exercise"] === exercise["id_exercise"]) {
        const name = clone.querySelector("#text7");
        name.innerHTML = exercise["exercise_name"]
        const desc = clone.querySelector("#text8");
        desc.innerHTML = exercise["description"]
        const hsr = clone.querySelector("#text9");
        hsr.innerHTML = exercise["total_hsr"]
        const reps = clone.querySelector("#text10");
        reps.innerHTML = exercise["total_reps"]
        const volume = clone.querySelector("#text11");
        volume.innerHTML = exercise["total_volume"]
        const brk = clone.querySelector("#text12");
        brk.innerHTML = exercise["break"]

        workoutsContainer.appendChild(clone);
    }
}

function loadSets(exercise, sets) {
    let id = 0;
    // console.log(sets)
    // sets.forEach(set => {
    //     showSets(exercise, set, id);
    // });

    while(id < sets.length) {
        showSets(exercise, sets[id], id);
        id++
    }
}


function showSets(exercise, set, id) {

    if(exercise["id_exercise"] === set["id_exercise"]) {

        const setNumber = clone.querySelector("#text13");
        setNumber.innerHTML = id
        const weight = clone.querySelector("#text14");
        weight.innerHTML = set["weight"]
        const reps = clone.querySelector("#text15");
        reps.innerHTML = set["reps"]
        const rir = clone.querySelector("#text16");
        rir.innerHTML = set["rir"]
        const rpe = clone.querySelector("#text17");
        rpe.innerHTML = set["rpe"]


        workoutsContainer.appendChild(clone);
    }
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