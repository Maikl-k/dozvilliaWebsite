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


// set max date to to today of realease date
const today = new Date
    const year = today.getFullYear()
    let month = today.getMonth() + 1
    let day = today.getDate()

    if(month < 10){
        month = '0' + month
    }

    if(day < 10){
        day = '0' + day
    }
    const todayFormatedDate = year + "-" + month + "-" + day
    document.getElementById("releasedate").setAttribute("max", todayFormatedDate)

// end of this



const itemTitleMinLength = 2
const itemTitleMaxLength = 60

const itemsSection = ["movie", "book", "serial", "podcast"]

const itemDescrMinLength = 3
const itemDescrMaxLenght = 2000

const whyItemGoodMaxLength = 2000
const whyItemGoodMinLength = 3

const maxSizeForBannerInKB = 1024


const createRecForm = document.getElementById("rec-form")

createRecForm.addEventListener("submit", function(event){

    event.preventDefault()

    let isValid = true

    let cliensideErrors = []

    let errorsClientSide = document.getElementById("clien-side-validation-errors")


    let titleOfItem = document.getElementById("nameofrec").value

    let inputSectionOfItem = document.getElementById("typeofrec").value

    let realeseDate = document.getElementById("releasedate").value
    
    let imageOfItem = posterFileInput.files[0]

    let descrOfItem = document.getElementById("descrofrec").value

    let whyItemGood = document.getElementById("whyitemgood").value


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


    // reselase date validation   
    if(realeseDate > todayFormatedDate){
        isValid = false
        cliensideErrors.push("release date of released can not be in future")
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


    // why item is good validation
    if(whyItemGood.length > whyItemGoodMaxLength || whyItemGood.length < whyItemGoodMinLength){
        isValid = false
        cliensideErrors.push("invalid length of why recomendation is good, must be from " + whyItemGoodMinLength + " to " + whyItemGoodMaxLength)

    }



    if(isValid){
        this.submit();
    }else{
        errorsClientSide.textContent = cliensideErrors
    }

})


