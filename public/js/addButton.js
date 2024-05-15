const addImageButton = document.querySelector(".add-image-button");
const imageInput = document.getElementById("image-input");
const inputTitle = document.querySelector(".input-title");
const clearButton = document.querySelector(".clear-button");
const addedImage = document.querySelector(".added-image-button");

const originalButton = document.querySelector(".button-content");

clearButton.addEventListener("click", () => {
  inputTitle.value = "";
  addImageButton.replaceChildren(originalButton);
});

addImageButton.addEventListener("click", () => {
  imageInput.click();
});

imageInput.addEventListener("change", () => {
  if (imageInput.files && imageInput.files[0]) {
    const imageURL = URL.createObjectURL(imageInput.files[0]);
    const imageElement = document.createElement("img");
    imageElement.src = imageURL;
    imageElement.style.height = "60px";
    addImageButton.replaceChildren(imageElement);
  }
});
