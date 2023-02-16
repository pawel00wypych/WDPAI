function addSet() {

    const div = document.createElement("div");
    div.className = "main-mid workout";

    const name = document.createElement("input");
    name.className = "routine-text";
    name.type = "text";
    name.name = "name";
    name.placeholder = "Squat.."
    const div0 = document.createElement("div");
    div0.className = "routine-exercises";
    div0.innerText = "exercise:";
    div0.appendChild(name);

    const weight = document.createElement("input");
    weight.className = "routine-text";
    weight.type = "number";
    weight.name = "weight";
    const div1 = document.createElement("div");
    div1.className = "routine-exercises";
    div1.innerText = "weight:";
    div1.appendChild(weight);


    const reps = document.createElement("input");
    reps.className = "routine-text";
    reps.type = "number";
    reps.name = "reps";
    const div2 = document.createElement("div");
    div2.className = "routine-exercises";
    div2.innerText = "reps:";
    div2.appendChild(reps);


    const rpe = document.createElement("input");
    rpe.className = "routine-text";
    rpe.type = "number";
    rpe.name = "rpe";
    const div3 = document.createElement("div");
    div3.className = "routine-exercises";
    div3.innerText = "rpe:";
    div3.appendChild(rpe);


    const rir = document.createElement("input");
    rir.className = "routine-text";
    rir.type = "number";
    rir.name = "rir";
    const div4 = document.createElement("div");
    div4.className = "routine-exercises";
    div4.innerText = "rir:";
    div4.appendChild(rir);

    const rest = document.createElement("input");
    rest.className = "routine-text";
    rest.type = "time";
    rest.name = "rest";
    const div41 = document.createElement("div");
    div41.className = "routine-exercises";
    div41.innerText = "rest:";
    div41.appendChild(rest);

    const deleteButton = document.createElement("button");
    deleteButton.value = "Delete exercise";
    deleteButton.id = "save-set"
    deleteButton.className = "mid-cat-button save";
    deleteButton.innerText = "Delete set";
    deleteButton.addEventListener("click", function () {
        this.parentElement.parentElement.remove();
    })
    const div5 = document.createElement("div");
    div5.className = "routine-exercises";
    div5.appendChild(deleteButton);

    const icon = document.createElement("i");
    icon.className = "fa-solid fa-plus";
    const add = document.createElement("button");
    add.value = "Delete exercise";
    add.id = "save-set";
    add.className = "mid-cat-button save";
    add.appendChild(icon);
    add.addEventListener("click", addSet)
    const div6 = document.createElement("div");
    div6.className = "routine-exercises";
    div6.appendChild(add);

    div.appendChild(div0)
    div.appendChild(div1)
    div.appendChild(div2)
    div.appendChild(div3)
    div.appendChild(div4)
    div.appendChild(div41)
    div.appendChild(div5)
    div.appendChild(div6)

    document.getElementById("next-row").appendChild(div);
}

document.getElementById("save-set").addEventListener("click", addSet)