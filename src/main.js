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
function setFormMessage(formElement, type, message) {
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
function setInputError(inputElement, message) {
  inputElement.classList.add("form__input--error");
  inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

/**
* Clears error messages for designated input fields
*
* @param inputElement Input field that error will be cleared from
*/
function clearInputError(inputElement) {
  inputElement.classList.remove("form__input--error");
  inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}

/**
* Toggles between form pages to be seen and the other hidden
*
* @param form1 Form to be hidden
* @param form2 Form to be shown
*/
function formVisibilityToggle(form1, form2) {
  form1.classList.add("form--hidden");
  form2.classList.remove("form--hidden");
}

/**
* Logins using a test account Test Method
*
*/
function login() {
  if (loginUser.value === "admin" && loginCredentials.value === "admin") {
    window.location = "./profile.html";
  }
}

/**
* Lougouts Test Method
*
*/
function logout() {
  window.location = "./index.html";
}

document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.querySelector("#login");
  const createAccountForm = document.querySelector("#createAccount");
  const forgotForm = document.querySelector("#forgot");

  //Checks for successful login and prints error if unsuccessful
  loginForm.addEventListener("submit", e => {
    e.preventDefault();

    //Set up success login feature here

    setFormMessage(loginForm, "error", "Invalid username/password");
  });

  //Checks if input element fulfills specific requirements
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
