
// todo fix or rewrite
const form = document.getElementById('sign-up-form-item');




let maxLengthLoginname = 30;
let minLengthLoginname = 3;

let maxLengthFirstName = 50;
let minLengthFirstName = 2;

let maxLengthLastName = 50;
let minLengthLastName = 2;

let digitPattern = /\d+/;

let maxLengthEmail = 254;
let minLengthEmail = 4;

let minPasswordLength = 8;
let maxPasswordLength = 64;




form.addEventListener("submit", function(event){

    event.preventDefault();

    // get user input values
    let loginName = document.getElementById('login-name').value;
    let firstName = document.getElementById("first-name").value;
    let lastName = document.getElementById('last-name').value;
    let email = document.getElementById('user-email').value;
    let gender = document.querySelectorAll('input[name="gender"]:checked');
    let dateOfBirth = document.getElementById('date-of-birth').value;
    let password = document.getElementById("user-password").value;
    let confPassword = document.getElementById("conf-password").value;

    let errors = document.getElementById("errors");

    errors.textContent = "";
    let errorMassage = [];


    let isValid = true;


    // validation login name
    if(loginName.length > maxLengthLoginname || loginName.length < minLengthLoginname){
        isValid = false;
        errorMassage.push("invalid length of login name valid is from " +minLengthLoginname + " to " +maxLengthLoginname + " chars!");
    }

    if(loginName === ""){
        errorMassage.push("login name is required!");
        isValid = false;
    }

    //validation fisrt name

    if(firstName === ""){
        isValid = false;
        errorMassage.push(" first name is required!");

    }


    if(digitPattern.test(firstName)){
        isValid = false;
        errorMassage.push("first name musv do not have digits!")
    }

    if(firstName.length > maxLengthFirstName || firstName < minLengthFirstName){
        isValid = false;
        errorMassage.push("invalid length of fisrt name, valid is from "+ minLengthFirstName+" to " + maxLengthFirstName+" chars!");

    }


    //validation last name
    if(lastName === ""){
        isValid = false;
        errorMassage.push("last name is required!")
    }

    if(lastName.length > maxLengthLastName || lastName.length < minLengthLastName){
        isValid = false;
        errorMassage.push("invalid length of last name, valid is from " + minLengthLastName +" to " + maxLengthLastName + " chars!");

    }

    if(digitPattern.test(lastName)){
        isValid = false;
        errorMassage.push("last name must not have digits!");
    }


    //validation email

    if(email === ""){
        isValid = false;
        errorMassage.push("email is required!")
    }

    if(email.length > maxLengthEmail || email.length < minLengthEmail){
        isValid = false;
        errorMassage.push("invalid length of email, valid length from " + minLengthEmail + " to " + maxLengthEmail + " chars!");

    }

    // gedner input validation
    if(gender.length === 0){
        isValid = false;
        errorMassage.push("select gender, it is required!")
    }


    // date of birth input validation
    if(dateOfBirth == ""){
        isValid = false;
        errorMassage.push("date of birth is required!")
    }


    // passwords validation
    if(password === "" || confPassword === ""){
        isValid = false;
        errorMassage.push("password is required, confirm password too");
    }

    if(password.length > maxPasswordLength || password.length < minPasswordLength){
        isValid = false;
        errorMassage.push("invalid length of password valid is from "+ minPasswordLength +" to " + maxPasswordLength + " chars!")
    }


    if(password === confPassword){
        isValid = false;
        errorMassage.push("password must = confirm password!")
    }




    // sumiting or output errors
    if(isValid){
        this.submit();
    }else{
        errors.textContent = errorMassage;
    }

});