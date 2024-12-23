// Select elements
const modal = document.getElementById("photoModal");
const modalImage = document.getElementById("modalImage");
const closeModal = document.getElementById("closeModal");

// All images inside the grid
const gridImages = document.querySelectorAll(".photo-grid img");

// Show modal with the clicked image
gridImages.forEach(image => {
    image.addEventListener("click", () => {
        modal.style.display = "flex";
        modalImage.src = image.src;
    });
});

// Close the modal
closeModal.addEventListener("click", () => {
    modal.style.display = "none";
});

// Close modal on clicking outside the image
modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});
