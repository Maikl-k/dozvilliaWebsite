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


