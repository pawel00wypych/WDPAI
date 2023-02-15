const save = document.querySelector(".save-workout");
function saveWorkout() {

    const workoutName = document.getElementById("workout-name").value;
    const workoutDescription = document.getElementById("workout-description").value;
    const totalTime = document.getElementById("workout-time").value;
    const exerciseName = Array.prototype.slice.call(document.getElementsByName("name"));
    const weight = Array.prototype.slice.call(document.getElementsByName("weight"));
    const reps = Array.prototype.slice.call(document.getElementsByName("reps"));
    const rpe = Array.prototype.slice.call(document.getElementsByName("rpe"));
    const rir = Array.prototype.slice.call(document.getElementsByName("rir"));
    const rest = Array.prototype.slice.call(document.getElementsByName("rest"));
    let totalVolumeOfWorkout = 0;
    let totalRepsOfWorkout = 0;
    let totalHSROfWorkout = 0;

    let sets = [];
    let exercises = [];

    let names = new Map();
    let k = 0;

    for(let i = 0; i < exerciseName.length ; i++) {

        let vol = reps[i].value * weight[i].value * 1;
        let rps = reps[i].value * 1;
        let hsr = getHSR(rir[i].value, reps[i].value) * 1;
        let j = 0;

        if(!names.has(exerciseName[i].value.toLowerCase()))
        {
            names.set(exerciseName[i].value.toLowerCase(), k++);

            exercises.push({
                exercise_name: exerciseName[i].value.toLowerCase(),
                total_hsr: hsr,
                total_reps: rps,
                total_volume: vol,
                break: rest[i].value
            });
        }else {
            j = parseInt(names.get(exerciseName[i].value));

            let temp = exercises[j].exercise_name.toLowerCase();
            let tempHsr = exercises[j].total_hsr;
            let tempReps = exercises[j].total_reps;
            let tempVolume = exercises[j].total_volume;
            exercises[j] = {
                exercise_name: temp,
                total_hsr: tempHsr + hsr,
                total_reps: tempReps + rps,
                total_volume: tempVolume + vol,
                break: rest[i].value
            }
        }

        sets.push({
            exercise_name: exerciseName[i].value.toLowerCase(),
            weight: weight[i].value,
            reps: rps,
            rpe: rpe[i].value,
            rir: rir[i].value,
            rest: rest[i].value
        });

        totalVolumeOfWorkout += vol;
        totalRepsOfWorkout += rps;
        totalHSROfWorkout += hsr;
    }

    const workout = {
       workout_name: workoutName.toLowerCase(),
       description:  workoutDescription,
        total_time: totalTime,
        total_hsr: totalHSROfWorkout,
        total_volume: totalVolumeOfWorkout,
        total_reps: totalRepsOfWorkout
    };

    const save = {
        workout: workout,
        exercises: exercises,
        sets: sets
    }

    fetch("/saveWorkout", {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(save)
    })
        .then(function (response) {
            return response;
        }).then(function (result) {
        if (result == null)
            alert("ERROR IN CREATING TRAINING SESSION. PLEASE RELOAD");
    });

}

function getHSR(rir, reps) {
    rir = rir * 1;
    reps = reps * 1;
    let hsr;
    if(rir >= 5 || reps <= rir) {
        hsr = 0;
    }
    else {
        if(reps > 5) {
            hsr = 5 - rir;
        }
        else {
            hsr = reps - rir;
        }
    }

    return hsr;
}


save.addEventListener("click", saveWorkout);