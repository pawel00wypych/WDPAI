const form = document.querySelector("form");
const inputEmail = form.querySelector("input[name=email]");
const inputPassword = form.querySelector("input[name=password]");

function testPassword(field, lng) {
    const lowerCaseLetters = /[a-z]/g;
    const upperCaseLetters = /[A-Z]/g;
    const numbers = /[0-9]/g;

    return field.value.length >= lng && field.value.length <= 256 &&
        field.value.match(lowerCaseLetters) && field.value.match(upperCaseLetters)
        && field.value.match(numbers);
};

function testEmail(field) {
    const reg = /\S+@\S+\.\S+/;
    return reg.test(field.value) && field.value.length <= 256;
};

function removeFieldError(field) {
    const errorText = field.nextElementSibling;
    if (errorText !== null) {
        if (errorText.classList.contains("form-error-text")) {
            errorText.remove();
        }
    }
};

function createFieldError(field, text) {
    removeFieldError(field);

    const div = document.createElement("div");
    div.classList.add("form-error-text");
    div.innerText = text;
    if (field.nextElementSibling === null) {
        field.parentElement.appendChild(div);
    } else {
        if (!field.nextElementSibling.classList.contains("form-error-text")) {
            field.parentElement.insertBefore(div, field.nextElementSibling);
        }
    }
};

function markFieldAsError(field, hasError) {
    if (hasError) {
        field.classList.add("no-valid");
    } else {
        field.classList.remove("no-valid");
        removeFieldError(field);
    }
};



inputPassword.addEventListener("blur", e => {
    const testResult = !testPassword(e.target, 8) && e.target.value !== "";
    markFieldAsError(e.target, testResult);
});

inputPassword.addEventListener("input", e => {
    if (e.target.classList.contains("no-valid") && testPassword(e.target, 8)) {
        markFieldAsError(e.target, false);
    }
});

inputEmail.addEventListener("blur", e => {
    const testResult = !testEmail(e.target) && e.target.value !== "";
    markFieldAsError(e.target, testResult);
});

inputEmail.addEventListener("input", e => {
    if (e.target.classList.contains("no-valid") && testEmail(e.target)) {
        markFieldAsError(e.target, false);
    }
});


form.addEventListener("submit", e => {
    e.preventDefault();

    let formErrors = false;

    for (const el of [inputPassword, inputEmail]) {
        markFieldAsError(el, false);
        removeFieldError(el);
    }

    if (!testPassword(inputPassword, 3)) {
        markFieldAsError(inputPassword, true);
        createFieldError(inputPassword, "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
        formErrors = true;
    }

    if (!testEmail(inputEmail)) {
        markFieldAsError(inputEmail, true);
        createFieldError(inputEmail, "Invalid email");
        formErrors = true;
    }

    if (!formErrors) {
        e.target.submit();
    }
});