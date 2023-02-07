const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    console.log("mark validation");
    console.log(element);
    if (!element.classList.contains('no-valid')) {
        console.log('Element does NOT have class');
    } else {
        console.log('Element has class');
    }
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
    if (!element.classList.contains('no-valid')) {
        console.log('Element does NOT have class');
    } else {
        console.log('Element has class');
    }
    console.log(element);
}

function validateEmail() {
    setTimeout(function () {

            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            const condition = arePasswordsSame(
                passwordInput.value,
                confirmedPasswordInput.value
            );
            console.log(passwordInput.value);

            console.log(confirmedPasswordInput.value);
            console.log(condition);

            markValidation(confirmedPasswordInput, condition);
        },
        500
    );
}

emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);