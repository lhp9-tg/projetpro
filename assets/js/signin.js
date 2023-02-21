// La modale maison (pas de librairie)

const modal = document.querySelector(".modal")
const trigger = document.querySelector(".modal_trigger")
const closeButton = document.querySelector(".close-button")
const understood = document.querySelector(".modern_button")

function toggleModal() {
modal.classList.toggle("show-modal")
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal()
    }
}

trigger.addEventListener("click", toggleModal)
closeButton.addEventListener("click", toggleModal)
understood.addEventListener("click", toggleModal)
window.addEventListener("click", windowOnClick)