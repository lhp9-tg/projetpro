// La modale maison (pas de librairie)

const form = document.querySelector("form")
const modal = document.querySelector(".modal")
const cgu = document.querySelector(".cgu")
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

if (form.length > 0) {
    cgu.addEventListener("click", toggleModal)
    closeButton.addEventListener("click", toggleModal)
    understood.addEventListener("click", toggleModal)
    window.addEventListener("click", windowOnClick)

    // Fermeture de la modale avec la touche "Echap"
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            toggleModal()
        }
    })
}