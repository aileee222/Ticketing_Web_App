function checkForm_login() {
    let error = 0;

    const email = document.querySelector('.email_box');
    const email_error = document.querySelector('#email_error');
    if(email && email.value == "") {
        email_error.classList.remove('hide');
        error++;
    }
    else email_error.classList.add('hide');

    const password = document.querySelector('.passwd_box');
    const password_error = document.querySelector('#passwd_error');
    if(password && password.value == "") {
        password_error.classList.remove('hide');
        error++;
    }
    else password_error.classList.add('hide');

    return error;
}

function checkForm_signup() { 
    console.log('js');
    let error = 0;
    const firstname = document.querySelector('.firstname_box');
    const firstname_error = document.querySelector('#firstname_error');
    if(firstname && firstname.value == "") {
        firstname_error.classList.remove('hide');
        error++;
    }
    else if(firstname) firstname_error.classList.add('hide');

    const lastname = document.querySelector('.lastname_box');
    const lastname_error = document.querySelector('#lastname_error');
    if(lastname && lastname.value == "") {
        lastname_error.classList.remove('hide');
        error++;
    }
    else if(lastname) lastname_error.classList.add('hide');

    const email = document.querySelector('.email_box');
    const email_error = document.querySelector('#email_error');
    if(email && email.value == "") {
        email_error.classList.remove('hide');
        error++;
    }
    else email_error.classList.add('hide');

    const birthday = document.querySelector('.birthday_box');
    const birthday_error = document.querySelector('#birthday_error');
    if(birthday && birthday.value == "") {
        birthday_error.classList.remove('hide');
        error++;
    }
    else birthday_error.classList.add('hide');

    const phone = document.querySelector('.phone_box');
    const phone_error = document.querySelector('#phone_error');
    if(phone && phone.value == "") {
        phone_error.classList.remove('hide');
        error++;
    }
    else phone_error.classList.add('hide');

    const location = document.querySelector('.location_box');
    const location_error = document.querySelector('#location_error');
    if(location && location.value == "") {
        location_error.classList.remove('hide');
        error++;
    }
    else location_error.classList.add('hide');

    const education = document.querySelector('.education_box');
    const education_error = document.querySelector('#education_error');
    if(education && education.value == "") {
        education_error.classList.remove('hide');
        error++;
    }
    else education_error.classList.add('hide');

    const status = document.querySelector('.status_box');
    const status_error = document.querySelector('#status_error');
    if(status && status.value == "") {
        status_error.classList.remove('hide');
        error++;
    }
    else status_error.classList.add('hide');

    const password = document.querySelector('.passwd_box');
    const password_error = document.querySelector('#passwd_error');
    if(password && password.value == "") {
        password_error.classList.remove('hide');
        error++;
    }
    else password_error.classList.add('hide');

    return error;
}

const login_form_submit = document.querySelector('#login_form_submit');
if(login_form_submit) {
    login_form_submit.addEventListener("submit", function(event) {
        checkForm_login();
    });
}

const signup_form_submit = document.querySelector('#signup_form_submit');
if(signup_form_submit) {
    signup_form_submit.addEventListener("submit", function(event) {
        checkForm_signup();
    });
}