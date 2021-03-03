/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function setFormMessage(formElement, type, message){
    const messageElement = formElement.querySelector(".form__message");

    messageElement.textContent = message;
    messageElement.classList.remove("form__message--success", "form__message--error");
    messageElement.classList.add(`form__message--${type}`);
}

function setInputError(inputElement, message){
    inputElement.classList.add("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

function clearInputError(inputElement){
    inputElement.classList.remove("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}

function createAccountF(form) {
  form.classList.add("form--hidden");
  createAccount.classList.remove("form--hidden");
}

function alreadyHaveAccount(form) {
  form.classList.add("form--hidden");
  loginForm.classList.remove("form--hidden");
}

function forgotPasswordForm(form){
    form.classList.add("form--hidden");
    forgot.classList.remove("form--hidden");
}

function forgotToLoginForm(form){
    form.classList.add("form--hidden");
    loginForm.classList.remove("form--hidden");
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");
    const forgotForm = document.querySelector("#forgot");

    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hiddden");
    });

    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hiddden");
        forgotForm.classList.add("form--hiddden");
    });
    
    document.querySelector("#linkLogin2").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        forgotForm.classList.add("form--hiddden");
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();

        //Set up success login feature here

        setFormMessage(loginForm, "error", "Invalid username/password");
    });

    document.querySelectorAll(".form__input").forEach(inputElement => {
        inputElement.addEventListener("blur", e => {
            if(e.target.id === "usernameSetUp" && e.target.value.length > 0 && e.target.value.length < 10)
                setInputError(inputElement, "Username must be 10 characters long");
        });

        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });
    });
});
