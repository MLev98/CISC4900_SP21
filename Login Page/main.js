/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Displays Message for errors or success
 * 
 * @param formElement Form that needs message associated with it
 * @param type Type of message, error or success
 * @param message The message
 */
function setFormMessage(formElement, type, message){
    const messageElement = formElement.querySelector(".form__message");

    messageElement.textContent = message;
    messageElement.classList.remove("form__message--success", "form__message--error");
    messageElement.classList.add(`form__message--${type}`);
}

/**
 * Prints error messages for designated input fields 
 * 
 * @param inputElement Input field that needs error
 * @param message Error message
 */
function setInputError(inputElement, message){
    inputElement.classList.add("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

/**
 * Clears error messages for designated input fields
 * 
 * @param inputElement Input field that error will be cleared from
 */
function clearInputError(inputElement){
    inputElement.classList.remove("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}

/**
 * Toggles the create account page to be seen and toggles requested page to be hidden
 * 
 * @param form Form to be hidden
 */
function createAccountF(form) {
  form.classList.add("form--hidden");
  createAccount.classList.remove("form--hidden");
}

/**
 * Toggles the login page to be seen and toggles requested page to be hidden
 * 
 * @param form Form to be hidden
 */
function alreadyHaveAccount(form) {
  form.classList.add("form--hidden");
  loginForm.classList.remove("form--hidden");
}
/**
 * Toggles the forgot password page to be seen and toggles requested page to be hidden
 * 
 * @param form Form to be hidden
 */
function forgotPasswordForm(form){
    form.classList.add("form--hidden");
    forgot.classList.remove("form--hidden");
}

/**
 * Toggles the login page to be seen and toggles requested page to be hidden
 * 
 * @param form Form to be hidden
 */
function forgotToLoginForm(form){
    form.classList.add("form--hidden");
    loginForm.classList.remove("form--hidden");
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");
    const forgotForm = document.querySelector("#forgot");

    //Toggles Create Account form to be seen and Login form to hidden
    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hiddden");
    });
    
    //Toggles Login form to be seen and Create Account form to be hidden
    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hiddden");
    });
    
    //Toggle Forgot form to be seen and Login form to be hidden
    document.querySelector("#linkLogin2").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        forgotForm.classList.add("form--hiddden");
    });

    //Checks for successful login and prints error if unsuccessful
    loginForm.addEventListener("submit", e => {
        e.preventDefault();

        //Set up success login feature here

        setFormMessage(loginForm, "error", "Invalid username/password");
    });

    //Checks input element fulfills specific requirements
    document.querySelectorAll(".form__input").forEach(inputElement => {
        inputElement.addEventListener("blur", e => {
            //Checks that username fulfills requirements for valid username
            if(e.target.id === "usernameSetUp" && e.target.value.length > 0 && e.target.value.length < 10)
                //Prints error
                setInputError(inputElement, "Username must be 10 characters long");
        });
        
        //Clears error message while typing
        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });
    });
});
