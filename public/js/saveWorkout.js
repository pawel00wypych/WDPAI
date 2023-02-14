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

    const sets = [];
    const exercises = [{
        name: "",
        total_hsr: 0,
        total_reps: 0,
        total_volume: 0,
        break: ""
    }];
    let names = new Map();

    for(let i = 0; i < exerciseName.length ; i++) {
        let k = 0;
        if(!names.has(exerciseName[i].name))
        {
            names.set(exerciseName[i].name, k);

            exercises[k++] =  {
                name: exerciseName[i].name,
                total_hsr: getHSR(rir[i].value, reps[i].value) * 1,
                total_reps: reps[i].value * 1,
                total_volume: reps[i].value * weight[i].value * 1,
                break: rest[i].value
            }
        }else {
            let j = names.get(exerciseName[i].name);
            console.log(j);

            let temp = exercises[j].name;
            let tempHsr = exercises[j].total_hsr;
            let tempReps = exercises[j].total_reps;
            let tempVolume = exercises[j].total_volume;
            exercises[j] = {
                name: temp,
                total_hsr: tempHsr + getHSR(rir[i].value, reps[i].value) * 1,
                total_reps: tempReps + reps[i].value * 1,
                total_volume: tempVolume + reps[i].value * weight[i].value * 1,
                break: rest[i].value
            }
        }
        sets.push({
            name: exerciseName[i].value,
            weight: weight[i].value,
            reps: reps[i].value,
            rpe: rpe[i].value,
            rir: rir[i].value,
            rest: rest[i].value
        });
        totalVolumeOfWorkout += reps[i].value * weight[i].value * 1;
        totalRepsOfWorkout += reps[i].value * 1;
        totalHSROfWorkout += getHSR(rir[i].value, reps[i].value) * 1;

    }

    const workout = {
       workout_name: workoutName,
       description:  workoutDescription,
        total_time: totalTime,
        total_hsr: totalHSROfWorkout,
        total_volume: totalVolumeOfWorkout,
        total_reps: totalRepsOfWorkout
    };

    console.log(sets);
    console.log(exercises);
    console.log(workout);
}

function getHSR(rir, reps) {
    let hsr;
    if(rir >= 5 || reps < rir) {
        hsr = 0;
    }
    else {
        if(reps > 5)
            hsr = 5 - rir;
        else
            hsr = reps - rir;
    }
    return hsr;
}


save.addEventListener("click", saveWorkout);