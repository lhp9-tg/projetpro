// Choix des cards de résultats de recherche et affichage de la modale

const modal = document.querySelector(".modal")
const closeButton = document.querySelector(".close-button")

function toggleModal() {
    modal.classList.toggle("show-modal")
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal()
    }
}

const cards = document.querySelectorAll(".movie")

if (cards.length > 0) {
    cards.forEach(card => {
        card.addEventListener("click", () => {
            toggleModal()

            if (document.querySelectorAll(".modal_movie").length > 0) {
                document.querySelectorAll(".modal_movie").forEach(movie => {
                    movie.remove()
                })
                document.querySelectorAll(".modal_select").forEach(select => {
                    select.remove()
                })
                document.querySelectorAll(".modal_rating").forEach(rating => {
                    rating.remove()
                })
            }
            //Création de la div qui contiendra les infos du film sélectionné
            div_movie = document.createElement("div");
            div_movie.classList.add("modal_movie");
            div_movie.setAttribute("data-id", card.dataset.id);
            div_movie.innerHTML = card.innerHTML;
            modal.firstElementChild.appendChild(div_movie);

            // Système de notation par étoiles en CSS (pas de JS) : https://codepen.io/jmpp/pen/BWjaEM  
            modal_rating = document.createElement("div");
            modal_rating.classList.add("modal_rating");
            modal_rating.innerHTML =

                `
                <div class="stars">
                    <i class="fa-solid fa-star" alt="étoile1"></i>
                    <i class="fa-solid fa-star" alt="étoile2"></i>
                    <i class="fa-solid fa-star" alt="étoile3"></i>
                    <i class="fa-solid fa-star" alt="étoile4"></i>
                    <i class="fa-solid fa-star" alt="étoile5"></i>
                </div>
                `

            modal.firstElementChild.appendChild(modal_rating);

            // Les boutons de la modale
            modal_form = document.createElement("form");
            modal_form.setAttribute("action", "my_retrospective.php");
            modal_form.setAttribute("method", "GET");
            modal_form.classList.add("modal_select");
            modal_form.innerHTML =

                `
                <input type="hidden" name="id" value="${card.dataset.id}">
                <input type="button" onclick="toggleModal()" value="Annuler">
                <button type="submit">Ajouter à ma liste</button>
                `
            modal.firstElementChild.appendChild(modal_form);

        })

    })

    closeButton.addEventListener("click", toggleModal)
    window.addEventListener("click", windowOnClick)

    // Fermeture de la modale avec la touche "Echap"
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            toggleModal()
        }
    })
}