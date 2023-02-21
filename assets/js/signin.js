// La modale maison (pas de librairie)

const modal = document.querySelector(".modal")
const trigger = document.querySelector(".modal_trigger")
const closeButton = document.querySelector(".close-button")
const understood = document.querySelector(".modern_button")
const form = document.querySelector("form")

function toggleModal() {
modal.classList.toggle("show-modal")
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal()
    }
}

if (form) {
    trigger.addEventListener("click", toggleModal)
    closeButton.addEventListener("click", toggleModal)
    understood.addEventListener("click", toggleModal)
    window.addEventListener("click", windowOnClick)

    // Fermeture de la modale avec la touche "Echap"
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            toggleModal()
        }
    })
}


// Redirection vers la page d'accueil après l'affichage du message de confirmation
//Si la class .success est présente dans le body, alors on redirige vers la page d'accueil


const trigger_redirection = document.getElementsByTagName('main')[0] 

function redirect() {
    window.location.href = "home.php"
}

if (!form) {
    window.addEventListener("click", redirect)
}




