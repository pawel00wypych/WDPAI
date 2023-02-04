const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function isEmail(email) {
    console.log(email);

    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    console.log("mark validation");

    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
    if (!element.classList.contains('no-valid')) {
        console.log('Element does NOT have class');
    } else {
        console.log('Element has class');
    }
}

function validateEmail() {
    setTimeout(function () {
            console.log(emailInput);

            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
        console.log(confirmedPasswordInput);
            const condition = arePasswordsSame(
                confirmedPasswordInput.previousElementSibling.value,
                confirmedPasswordInput.value
            );
            console.log(condition);

            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);