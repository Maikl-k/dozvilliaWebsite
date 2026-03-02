const posterFileInput = document.getElementById("itemimage")
const imagePreview = document.getElementById("previewimage")


posterFileInput.addEventListener("change", function(event){

    const inputFile = event.target.files[0]
    if(inputFile && inputFile.type.startsWith("image/")){
        const Reader = new FileReader

        Reader.onload = function(e){
            imagePreview.src = e.target.result
            imagePreview.style.display = "flex"
        }

        Reader.readAsDataURL(inputFile)
    }


})



const itemTitleMinLength = 2
const itemTitleMaxLength = 60

const itemsSection = ["movie", "book", "serial", "podcast"]

const itemDescrMinLength = 3
const itemDescrMaxLenght = 2000

const maxSizeForBannerInKB = 1024


const createRecForm = document.getElementById("rec-form")

createRecForm.addEventListener("submit", function(event){

    event.preventDefault()

    let isValid = true

    let cliensideErrors = []

    let errorsClientSide = document.getElementById("clien-side-validation-errors")


    let titleOfItem = document.getElementById("nameofrec").value

    let inputSectionOfItem = document.getElementById("typeofrec").value
    
    let imageOfItem = posterFileInput.files[0]

    let descrOfItem = document.getElementById("descrofrec").value


    //title validation
    if(titleOfItem.length > itemTitleMaxLength || titleOfItem.length < itemTitleMinLength){
        isValid = false
        cliensideErrors.push("invalid length in field name of recomandation must be from " +  itemTitleMinLength  + " to " + itemTitleMaxLength)
    }

    // section of item validation
    if(!itemsSection.includes(inputSectionOfItem)){
        isValid = false
        cliensideErrors.push("invalid name of section choose one of next list " + itemsSection)
    }



    // input image validation
    
    //file size in bytes
    const sizeInBytes = imageOfItem.size
    const sizeInKB = (sizeInBytes / 1024).toFixed(2)
    if(sizeInKB > maxSizeForBannerInKB){
        isValid = false
        cliensideErrors.push("to large image, maximum size is " + maxSizeForBannerInKB / 1024 + " MB")
        posterFileInput.value = ""
        //not dispaly image if to large
        imagePreview.src = ""
        imagePreview.style.display = "none"

    }

    // description of item validation
    if(descrOfItem.length > itemDescrMaxLenght || descrOfItem.length < itemDescrMinLength){
        isValid = false
        cliensideErrors.push("invalid length of desrciption for item, valid is from " + itemDescrMinLength + " to " + itemDescrMaxLenght)
        
    }



    if(isValid){
        this.submit();
    }else{
        errorsClientSide.textContent = cliensideErrors
    }

})


