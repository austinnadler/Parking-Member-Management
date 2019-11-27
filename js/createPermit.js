// File: createPermit.js
// Author: Austin Nadler

$(function() {
    'use strict';

    let $first = $('#first');
    let $last = $('#last');
    let $phone = $('#phone');
    let $make = $('#make');
    let $model = $('#model');
    let $licensePlate = $('#licensePlate');
    let $firstValidIcon = $('#firstValidIcon');
    let $lastValidIcon = $('#lastValidIcon');
    let $phoneValidIcon = $('#phoneValidIcon');
    let $makeValidIcon = $('#makeValidIcon');
    let $modelValidIcon = $('#modelValidIcon');
    let $licensePlateValidIcon = $('#licensePlateValidIcon');

    $('#permitForm').on('submit', function(e) {
        let formValidFlag = true;

        // Testing the first name
        if (/^\w+( \w+)*$/.test($first.val()) && $first.val().length <= 15 && $first.val().length > 0) {
            $firstValidIcon.removeClass("w3-text-red fa fa-close");
            $firstValidIcon.addClass("w3-text-green fa fa-check");
            $firstValidIcon.text(''); // remove *
        } else {
            formValidFlag = false;
            $firstValidIcon.removeClass("w3-text-green fa fa-check");
            $firstValidIcon.addClass("w3-text-red fa fa-close");
            $firstValidIcon.text('');
        }

        // Testing the last name
        if (/^\w+( \w+)*$/.test($last.val()) && $last.val().length <= 20 && $last.val().length > 0) {
            $lastValidIcon.removeClass("w3-text-red fa fa-close");
            $lastValidIcon.addClass("w3-text-green fa fa-check");
            $lastValidIcon.text('');
        } else {
            formValidFlag = false;
            $lastValidIcon.removeClass("w3-text-green fa fa-check");
            $lastValidIcon.addClass("w3-text-red fa fa-close");
            $lastValidIcon.text('');
        }

        // Testing the phone number
        if (/^\d{10}$/.test($phone.val()) ) {
            $phoneValidIcon.removeClass("w3-text-red fa fa-close");
            $phoneValidIcon.addClass("w3-text-green fa fa-check");
            $phoneValidIcon.text('');
        } else {
            formValidFlag = false;
            $phoneValidIcon.removeClass("w3-text-green fa fa-check");
            $phoneValidIcon.addClass("w3-text-red fa fa-close");
            $phoneValidIcon.text('');
        }

        // Testing the make
        if (/^\w+( \w+)*$/.test($make.val()) && $make.val().length <= 15 && $make.val().length > 0 ) {
            $makeValidIcon.removeClass("w3-text-red fa fa-close");
            $makeValidIcon.addClass("w3-text-green fa fa-check");
            $makeValidIcon.text('');
        } else {
            formValidFlag = false;
            $makeValidIcon.removeClass("w3-text-green fa fa-check");
            $makeValidIcon.addClass("w3-text-red fa fa-close");
            $makeValidIcon.text('');
        }

        // Testing the model
        if (/^\w+( \w+)*$/.test($model.val()) && $model.val().length <= 20 && $model.val().length > 0 ) {
            $modelValidIcon.removeClass("w3-text-red fa fa-close");
            $modelValidIcon.addClass("w3-text-green fa fa-check");
            $modelValidIcon.text('');
        } else {
            formValidFlag = false;
            $modelValidIcon.removeClass("w3-text-green fa fa-check");
            $modelValidIcon.addClass("w3-text-red fa fa-close");
            $modelValidIcon.text('');
        }

        // Testing the license plate
        if (/^\w+( \w+)*$/.test($licensePlate.val()) && $licensePlate.val().length <= 10 && $licensePlate.val().length > 0) {
            $licensePlateValidIcon.removeClass("w3-text-red fa fa-close");
            $licensePlateValidIcon.addClass("w3-text-green fa fa-check");
            $licensePlateValidIcon.text('');
        } else {
            formValidFlag = false;
            $licensePlateValidIcon.removeClass("w3-text-green fa fa-check");
            $licensePlateValidIcon.addClass("w3-text-red fa fa-close");
            $licensePlateValidIcon.text('');
        }

        if ( formValidFlag === false ) {
            e.preventDefault();
        }
    });
});



// window.addEventListener('load', function() {
  
//     'use strict';

//     function validateForm(e) {
//         let firstValidIcon = document.getElementById('firstValidIcon');
//         let lastValidIcon = document.getElementById('lastValidIcon');
//         let phoneValidIcon = document.getElementById('phoneValidIcon');
//         let makeValidIcon = document.getElementById('makeValidIcon');
//         let modelValidIcon = document.getElementById('modelValidIcon');
//         let licensePlateValidIcon = document.getElementById("licensePlateValidIcon");

//         let formValidatedFlag = true;

//         // first name field
//         if ( /^\w+( \w+)*$/.test(first.value) ) {
//             firstValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             firstValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             firstValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             firstValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             firstValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             firstValidIcon.innerHTML = "";
//         }
    
//         // last name field
//         if ( /^\w+( \w+)*$/.test(last.value) ) {
//             lastValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             lastValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             lastValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             lastValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             lastValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             lastValidIcon.innerHTML = "";
//         }

//         // phone number field
//         if ( /^\d{10}$/.test(phone.value) ) {
//             phoneValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             phoneValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             phoneValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             phoneValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             phoneValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             phoneValidIcon.innerHTML = "";
//         }

//         // make field
//         if ( /^\w+( \w+){1,15}$/.test(make.value) || /^\w{1,15}$/.test(make.value)) {
//             makeValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             makeValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             makeValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             makeValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             makeValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             makeValidIcon.innerHTML = "";
//         }

//         // model field
//         if ( /^\w+( \w+){1,30}$/.test(model.value) || /^\w{1,30}$/.test(model.value)) {
//             modelValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             modelValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             modelValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             modelValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             modelValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             modelValidIcon.innerHTML = "";
//         }   
        
//         // licensePlate field
//         if ( /^\w+( \w+){1,10}$/.test(licensePlate.value) || /^\w{1,10}$/.test(licensePlate.value)) {
//             licensePlateValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             licensePlateValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             licensePlateValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             licensePlateValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             licensePlateValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             licensePlateValidIcon.innerHTML = "";
//         }  

//         if ( formValidatedFlag === false ) {
//             e.preventDefault();
//         }
//     }

//     // Cache the form fields
//     let form = this.document.getElementById('permitForm');
//     let first = this.document.getElementById ('first');
//     let last = this.document.getElementById ('last');
//     let phone = this.document.getElementById('phone');
//     let make = this.document.getElementById('make');
//     let model = this.document.getElementById('model');
//     let licensePlate = this.document.getElementById('licensePlate');

//     // Register the form's submit event
//     form.addEventListener('submit', function(e) {
//         validateForm(e);
//     });

// });