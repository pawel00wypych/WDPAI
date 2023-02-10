const workoutsContainer = document.querySelector(".main-mid.history");
function showWorkouts() {

    fetch("/getWorkouts")
        .then(function (response) {
        return response.json();
    }).then(function (workouts) {
        workoutsContainer.innerHTML = "";
        loadWorkouts(workouts)
    });

}

function loadWorkouts(workouts) {
    console.log(workouts);

    workouts.forEach(workout => {
        console.log(workout);
        showWorkout(workout);
    });
}

function showWorkout(workout) {

    const template = document.querySelector("#history-template");
    const clone = template.content.cloneNode(true);

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