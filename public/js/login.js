const form = document.getElementById("login-form-item")

let maxLengthLoginname = 30;
let minLengthLoginname = 3;

let minPasswordLength = 8;
let maxPasswordLength = 64;

form.addEventListener("submit", function(event){

    event.preventDefault()

    // get user input values
    let loginName = document.getElementById("login-name").value;
    let password = document.getElementById("user-password").value;

    let errors = document.getElementById("errors")
    let errorMassage = []

    let isValid = true

    // validation login name
    if(loginName.length > maxLengthLoginname || loginName.length < minLengthLoginname){
        isValid = false;
        errorMassage.push("invalid length of login name valid is from " +minLengthLoginname + " to " +maxLengthLoginname + " chars!");
    }

    if(loginName === ""){
        errorMassage.push("login name is required!");
        isValid = false;
    }


    // password validation
    if(password === ""){
        isValid = false;
        errorMassage.push("password is required");
    }

    if(password.length > maxPasswordLength || password.length < minPasswordLength){
        isValid = false;
        errorMassage.push("invalid length of password valid is from "+ minPasswordLength +" to " + maxPasswordLength + " chars!")
    }


    // sumiting or output errors
    if(isValid){
        this.submit();
    }else{
        errors.textContent = errorMassage;
    }
})