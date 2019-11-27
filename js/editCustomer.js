// File: editCustomer.js
// Austhor: Austin Nadler
$(function() {
    "use strict";

    let $first = $('#first');
    let $last = $('#last');
    let $phone = $('#phone');
    let $firstValidIcon = $('#firstValidIcon');
    let $lastValidIcon = $('#lastValidIcon');
    let $phoneValidIcon = $('#phoneValidIcon');

    $('#customerForm').on('submit', function(e) {
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

//         let formValidatedFlag = true;

//         // make field
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

//         // model field
//         if ( /^\w+( \w+)*$/.test(last.value)  ) {
//             lastValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             lastValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             lastValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             lastValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             lastValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             lastValidIcon.innerHTML = "";
//         }   
        
//         // model field
//         if ( /^\w+( \w+)*$/.test(phone.value) ) { 
//             phoneValidIcon.classList.remove("w3-text-red", "fa", "fa-close");
//             phoneValidIcon.classList.add("w3-text-green", "fa", "fa-check");
//             phoneValidIcon.innerHTML = "";
//         } else {
//             formValidatedFlag = false;
//             phoneValidIcon.classList.remove("w3-text-green", "fa", "fa-check");
//             phoneValidIcon.classList.add("w3-text-red", "fa", "fa-close");
//             phoneValidIcon.innerHTML = "";
//         }  

//         if ( formValidatedFlag === false ) {
//             e.preventDefault();
//         }
//     }

//     // Cache the form fields
//     let form = this.document.getElementById('customerForm');
//     let first = this.document.getElementById('first');
//     let last = this.document.getElementById('last');
//     let phone = this.document.getElementById('phone');

//     // Register the form's submit event
//     form.addEventListener('submit', function(e) {
//         validateForm(e);
//     });

// });