const form = document.querySelector("form");
const inputEmail = form.querySelector("input[name=email]");
const inputPassword = form.querySelector("input[name=password]");
const confirmedPasswordInput = form.querySelector("input[name=confirmedPassword]");
const inputName = form.querySelector("input[name=name]");

function testUserName(field, lng) {
    return field.value.length >= lng && field.value.length <= 256;
};

function testPassword(field, lng) {
    const lowerCaseLetters = /[a-z]/g;
    const upperCaseLetters = /[A-Z]/g;
    const numbers = /[0-9]/g;

    return field.value.length >= lng && field.value.length <= 256 &&
        field.value.match(lowerCaseLetters) && field.value.match(upperCaseLetters)
        && field.value.match(numbers);
};

function testPasswordConfirmation(field, password) {
    return field.value === password.value;
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

confirmedPasswordInput.addEventListener("blur", e => {
    const testResult = !testPasswordConfirmation(e.target, inputPassword) && e.target.value !== "";
    markFieldAsError(e.target, testResult);
});

confirmedPasswordInput.addEventListener("input", e => {
    if (e.target.classList.contains("no-valid") && testPasswordConfirmation(e.target, inputPassword)) {
        markFieldAsError(e.target, false);
    }
});

inputName.addEventListener("blur", e => {
    const testResult = !testUserName(e.target, 3) && e.target.value !== "";
    markFieldAsError(e.target, testResult);
});

inputName.addEventListener("input", e => {
    if (e.target.classList.contains("no-valid") && testUserName(e.target, 8)) {
        markFieldAsError(e.target, false);
    }
});


form.addEventListener("submit", e => {
    e.preventDefault();

    let formErrors = false;

    for (const el of [inputPassword, inputEmail, inputName, confirmedPasswordInput]) {
        markFieldAsError(el, false);
        removeFieldError(el);
    }

    if (!testPassword(inputPassword, 8)) {
        markFieldAsError(inputPassword, true);
        createFieldError(inputPassword, "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
        formErrors = true;
    }

    if (!testEmail(inputEmail)) {
        markFieldAsError(inputEmail, true);
        createFieldError(inputEmail, "Invalid email");
        formErrors = true;
    }

    if (!testPasswordConfirmation(confirmedPasswordInput, inputPassword)) {
        markFieldAsError(confirmedPasswordInput, true);
        createFieldError(confirmedPasswordInput, "Password confirmation is not equal to password");
        formErrors = true;
    }

    if (!testUserName(inputName, 3)) {
        markFieldAsError(inputName, true);
        createFieldError(inputName, "Name must contain at least 3 letters");
        formErrors = true;
    }

    if (!formErrors) {
        e.target.submit();
    }
});