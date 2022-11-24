/**
 * Gets the elements related to modal and add display logic
 */

const modal = document.getElementById("myModal");

const btn = document.getElementById("signout-btn");

// elements that closes the modal
const span = document.querySelector(".close-icon");
const noBtn = document.querySelector(".modal-no-btn");

btn.onclick = () => {
    modal.style.display = "block";
};
span.onclick = () => {
    modal.style.display = "none";
};
noBtn.onclick = () => {
    modal.style.display = "none";
};
window.onclick = (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};