// File:    login-register.js
// Author:  Austin Nadler

$(function() {
  "use strict";

  // Set up the event handler to be triggered when the element with id='showPassword' is clicked
  $('#showPassword').on('click', function(e) {

    let $passwordField = $('#password');

    if($passwordField.attr('type') === "password") {
      $passwordField.attr('type', 'text');
    } else {
      $passwordField.attr('type', 'password');
    }
  
    // var $password = $(':password');     // Getting the field by element type
    // var $text = $('.password');         // Getting the field by class

    // if($password.length > 0) {          // if the password variable is filled
    //   $password.attr('type','text');    // change the type from password to text
    // } else if($text.length > 0) {       // if the text variable is filled
    //   $text.attr('type', 'password');   // change the type from text to password
    // }
  });

  
  /////// Handle submitting of the form with regex ///////

  let $username = $('#username');
  let $password = $('#password');

  $('#loginRegister').on('submit', function(e){
    let $usernameValidationIcon = $('#usernameValidationIcon');
    let $passwordValidationIcon = $('#passwordValidationIcon');
    let formValidFlag = true;
    if ( /^\w{5,20}$/.test($username.val()) ) {
      $usernameValidationIcon.removeClass("w3-text-red fa fa-close");
      $usernameValidationIcon.addClass("w3-text-green fa fa-check");
      $usernameValidationIcon.text(''); // remove *
    } else {
      formValidFlag = false;
      $usernameValidationIcon.removeClass("w3-text-green fa fa-check");
      $usernameValidationIcon.addClass("w3-text-red fa fa-close");
      $usernameValidationIcon.text('');
    }

    if ( /^\w{5,20}$/.test($password.val()) ) {
      $passwordValidationIcon.removeClass("w3-text-red fa fa-close");
      $passwordValidationIcon.addClass("w3-text-green fa fa-check");
      $passwordValidationIcon.text('');
    } else {
      formValidFlag = false;
      $passwordValidationIcon.removeClass("w3-text-green fa fa-check");
      $passwordValidationIcon.addClass("w3-text-red fa fa-close");
      $passwordValidationIcon.text('');
    }

    if ( formValidFlag === false ) {
      e.preventDefault();
    }
  });

  
  
  // $("#loginRegister").submit( function() {
  //     let usernameValidationIcon = document.getElementById('usernameValidationIcon');
  //     let passwordValidationIcon = document.getElementById('passwordValidationIcon');
  //     // $("#usernameValidationIcon")
  
  //     let formValidatedFlag = true;
    
  //     // username field
  //     if ( /^\w{5,20}$/.test(username.value) ) {
  //       usernameValidationIcon.classList.remove("w3-text-red", "fa", "fa-close");
  //       usernameValidationIcon.classList.add("w3-text-green", "fa", "fa-check");
  //       usernameValidationIcon.innerHTML = "";
  //       console.log("username pass" );
  //     } else {
  //       formValidatedFlag = false;
  //       usernameValidationIcon.classList.remove("w3-text-green", "fa", "fa-check");
  //       usernameValidationIcon.classList.add("w3-text-red", "fa", "fa-close");
  //       usernameValidationIcon.innerHTML = "";
  //       console.log("username fail");
  //     }
  
  //     // password field
  //     if ( /^\w{5,20}$/.test(password.value) ) {
  //       passwordValidationIcon.classList.remove("w3-text-red", "fa", "fa-close");
  //       passwordValidationIcon.classList.add("w3-text-green", "fa", "fa-check");
  //       passwordValidationIcon.innerHTML = "";
  //       console.log("if " + password.value);
  //     } else {
  //       formValidatedFlag = false;
  //       passwordValidationIcon.classList.remove("w3-text-green", "fa", "fa-check");
  //       passwordValidationIcon.classList.add("w3-text-red", "fa", "fa-close");
  //       passwordValidationIcon.innerHTML = "";
  //       console.log("else " + password.value);
  //     }
  
  //     if ( formValidatedFlag === false ) {
  //       e.preventDefault();
  //     }
    
  // });
  


  // // Register the form's submit event


});