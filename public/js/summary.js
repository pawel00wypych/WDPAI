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

function showData(data) {

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
            showSummary();
            break;
    }
});