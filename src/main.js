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
    "use strict";
    var messageElement = formElement.querySelector(".form__message");
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

document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.querySelector("#login");
  const createAccountForm = document.querySelector("#createAccount");
  const forgotForm = document.querySelector("#forgot");

  //Checks for successful login and prints error if unsuccessful
  // loginForm.addEventListener("submit", e => {
  //     e.preventDefault();

  //     //Set up success login feature here

  //     setFormMessage(loginForm, "error", "Invalid username/password");
  // });

  //Checks if input element fulfills specific requirements
  document.querySelectorAll(".form__input").forEach(inputElement => {
    inputElement.addEventListener("blur", e => {

      var numbers = /^[0-9]+$/;
      //Checks EMPLID is only numbers
      if((e.target.id === "emplid" || e.target.id === "emplid_profile") && !e.target.value.match(numbers))
      setInputError(inputElement, "EMPLID must only contain numbers");
      //Checks that username fulfills requirements for valid username
      if(e.target.id === "usernameSetUp" && e.target.value.length > 0 && e.target.value.length < 4)
      setInputError(inputElement, "Username must be at least 4 characters long");
      var validEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      //Checks email follows valid email format
      if(e.target.id === "emailSetUp" && !e.target.value.match(validEmail))
      setInputError(inputElement, "Invalid email, enter a valid email");
      var validPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8}$/;
      //Checks password follows valid password requirements
      if(e.target.id === "passwordSetUp" && !e.target.value.match(validPassword))
      setInputError(inputElement, "Invalid password; must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character");
      //Checks password is the same as original
      if(e.target.id === "passwordConfirmedSetUp" && !(e.target.value == document.getElementById('passwordSetUp').value))
      setInputError(inputElement, "Password doesn't match");
    });

    //Clears error message while typing
    inputElement.addEventListener("input", e => {
      clearInputError(inputElement);
    });
  });
});
