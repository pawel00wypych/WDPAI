const button = document.querySelector("#get-users");
const usersContainer = document.querySelector(".users");
function showUsers() {

    fetch("/getUsers")
        .then(function (response) {
        return response.json();
    }).then(function (users) {
        usersContainer.innerHTML = "";
        loadUsers(users)
    });

}

function loadUsers(users) {
    console.log(users);
    users.forEach(user => {
        console.log(user);
        showUser(user);
    });
}

function showUser(user) {

    const template = document.querySelector("#user-template");
    const clone = template.content.cloneNode(true);


    const div = clone.querySelector("div");
    div.id = user["id_user"];
    const div2 = clone.querySelector(".user");
    const name = clone.querySelector("#field-1");
    name.innerHTML = user["user_name"];
    const surname = clone.querySelector("#field-2");
    surname.innerHTML = user["surname"];
    const email = clone.querySelector("#field-3");
    email.innerHTML = user["email"];
    const phone = clone.querySelector("#field-4");
    phone.innerHTML = user["phone"];
    const role = clone.querySelector("#field-5");
    role.innerHTML = user["role"];
    const createdAt = clone.querySelector("#field-6");
    createdAt.innerHTML = user["created_at"];

    usersContainer.appendChild(clone);
}




button.addEventListener("click", showUsers);