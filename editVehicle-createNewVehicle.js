// File: editVehicle-createNewVehicle.js
// Austhor: Austin Nadler
$(function() { 
    'use strict';

    let $make = $('#make');
    let $model = $('#model');
    let $licensePlate = $('#licensePlate');
    let $makeValidIcon = $('#makeValidIcon');
    let $modelValidIcon = $('#modelValidIcon');
    let $licensePlateValidIcon = $('#licensePlateValidIcon');

    $('#vehicleForm').on('submit', function(e) {
        console.log('submitted')
        let formValidFlag = true;

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
  

// File: createPermitVehicle.js
// // Austhor: Austin Nadler
// window.addEventListener('load', function() {
  
//     'use strict';

//     function validateForm(e) {
//         let makeValidIcon = document.getElementById('makeValidIcon');
//         let modelValidIcon = document.getElementById('modelValidIcon');
//         let licensePlateValidIcon = document.getElementById('licensePlateValidIcon');

//         let formValidatedFlag = true;

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
//         if ( /^\w+( \w+){1,30}$/.test(make.value) || /^\w{1,30}$/.test(make.value)) {
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
//         if ( /^\w+( \w+){1,10}$/.test(make.value) || /^\w{1,10}$/.test(make.value)) {
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
//     let form = this.document.getElementById('vehicleForm');
//     let make = this.document.getElementById('make');
//     let model = this.document.getElementById('model');
//     let licensePlate = this.document.getElementById('licensePlate');

//     // Register the form's submit event
//     form.addEventListener('submit', function(e) {
//         validateForm(e);
//     });

// });
    