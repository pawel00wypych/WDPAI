function addSet() {

    let div = document.createElement("div");
    div.className = "main-mid workout";


    let weight = document.createElement("input");
    weight.defaultValue = 3;
    weight.className = "routine-text";
    weight.type = "number";
    weight.name = "weight";
    let div1 = document.createElement("div");
    div1.class = "routine-exercises";
    div1.innerText = "weight:";
    div1.appendChild(weight);


    let reps = document.createElement("input");
    reps.defaultValue = 3;
    reps.className = "routine-text";
    reps.type = "number";
    reps.name = "reps";
    let div2 = document.createElement("div");
    div2.class = "routine-exercises";
    div2.innerText = "reps:";
    div2.appendChild(reps);


    let rpe = document.createElement("input");
    rpe.defaultValue = 3;
    rpe.className = "routine-text";
    rpe.type = "number";
    rpe.name = "rpe";
    let div3 = document.createElement("div");
    div3.class = "routine-exercises";
    div3.innerText = "rpe:";
    div3.appendChild(rpe);


    let rir = document.createElement("input");
    rir.defaultValue = 3;
    rir.className = "routine-text";
    rir.type = "number";
    rir.name = "rir";
    let div4 = document.createElement("div");
    div4.class = "routine-exercises";
    div4.innerText = "rir:";
    div4.appendChild(rir);

    let deleteButton = document.createElement("button");
    deleteButton.value = "Delete exercise";
    deleteButton.id = "save-set"
    deleteButton.className = "mid-cat-button save";
    deleteButton.innerText = "Delete set";
    deleteButton.addEventListener("click", function () {
        this.parentElement.parentElement.remove();
    })
    let div5 = document.createElement("div");
    div5.appendChild(deleteButton);

    let icon = document.createElement("i");
    icon.className = "fa-solid fa-plus";
    let add = document.createElement("button");
    add.value = "Delete exercise";
    add.id = "save-set"
    add.className = "mid-cat-button save";
    add.appendChild(icon);
    add.addEventListener("click", addSet)
    let div6 = document.createElement("div");
    div6.appendChild(add);


    div.appendChild(div1)
    div.appendChild(div2)
    div.appendChild(div3)
    div.appendChild(div4)
    div.appendChild(div5)
    div.appendChild(div6)
    document.getElementsByClassName("next-row")[0].appendChild(div);
}

document.getElementById("save-set").addEventListener("click", addSet)