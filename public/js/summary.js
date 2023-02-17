const summaryContainer = document.querySelector("#summary");
const summaryTemplate = document.querySelector("#summary-template");

function showSummary() {

    fetch("/getStatistics")
        .then(function (response) {
            return response.json();
        }).then(function (data) {
        summaryContainer.innerHTML = "";
        showData(data);
    });
}

function loadWorkoutVolumes() {
    fetch("/getWorkoutVolumes")
        .then(function (response) {
            return response.json();
        }).then(function (data) {
        showChart(data);
    });
}

function showData(data) {
    loadWorkoutVolumes();
    const clone = summaryTemplate.content.cloneNode(true);

    const lastTraining1 = clone.querySelector("#last-training-1");
    lastTraining1.innerHTML = data[0][0]["workout_name"];
    const lastTraining2 = clone.querySelector("#last-training-2");
    lastTraining2.innerHTML = data[0][0]["created_at"];
    const lastTraining3 = clone.querySelector("#last-training-3");
    lastTraining3.innerHTML = data[0][0]["description"];
    const lastTraining4 = clone.querySelector("#last-training-4");
    lastTraining4.innerHTML = data[0][0]["total_time"];
    const lastTraining5 = clone.querySelector("#last-training-5");
    lastTraining5.innerHTML = data[0][0]["total_volume"];
    const lastTraining6 = clone.querySelector("#last-training-6");
    lastTraining6.innerHTML = data[0][0]["total_reps"];
    const lastTraining7 = clone.querySelector("#last-training-7");
    lastTraining7.innerHTML = data[0][0]["total_hsr"];
    const lastTraining8 = clone.querySelector("#last-training-8");
    lastTraining8.innerHTML = data[0][0]["body_weight"];

    const totalWorkouts = clone.querySelector("#total-workouts");
    totalWorkouts.innerHTML = data[1][0]["count"];
    const totalVolume = clone.querySelector("#total-volume");
    totalVolume.innerHTML = data[2][0]["volume"];
    const totalReps = clone.querySelector("#total-reps");
    totalReps.innerHTML = data[2][0]["reps"];
    const totalHsr = clone.querySelector("#total-hsr");
    totalHsr.innerHTML = data[2][0]["hsr"];

    summaryContainer.appendChild(clone);


}

function showChart(data) {

    let values = [];
    let dates = [];

    data.forEach(element => {
        dates.push(element["created_at"]);
        values.push(element["total_volume"]);
    });

    const ctx = document.getElementById("myChart")

    const myChart = new Chart(ctx, {
        type: "line",
        fontColor: 'C90404FF',
        data: {
            labels: dates,
            datasets: [
                {
                    label: "Total Workout Volume",
                    data: values,
                    backgroundColor: "red",
                    borderColor: 'black',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: "black",
                        font: {
                            size: 20
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: "black",
                        font: {
                            size: 16,
                        },
                        beginAtZero: true
                    }
                },
                x: {
                    ticks: {
                        color: "black",
                        font: {
                            size: 18
                        },
                    }
                }
            }
        }
    });
}



document.addEventListener("DOMContentLoaded", showSummary);
