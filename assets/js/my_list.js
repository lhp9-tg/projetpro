// Rating 

const stars = document.querySelectorAll(".fa-star");

stars.forEach((star, index) => {
    star.addEventListener("click", (e) => {
        let rating = index % 5 + 1;

        let film_id = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.dataset.id

        let film_stars = document.querySelectorAll(`.movie_list[data-id="${film_id}"] .fa-star`)

        film_stars.forEach((star, i) => {
            if (i < rating) {
                star.classList.add("gold");
            } else {
                star.classList.remove("gold");
            }
        });

        const url = `../helpers/ajax.php?tmdb_id=${film_id}&rating=${rating}`
        
        fetch(url)
        .then(responce => console.log(responce))

        let new_rating = document.querySelector(`.movie_list[data-id="${film_id}"] .new_rating`)
        new_rating.value = rating
    });
});

// Changement de la date 

function updateDate(element) {
    console.log(element.target.parentElement.parentElement.parentElement.parentElement.dataset.id)
    let date = element.target.value
    let film_id = element.target.parentElement.parentElement.parentElement.parentElement.dataset.id

    const url = `../helpers/ajax.php?tmdb_id=${film_id}&viewing_date=${date}`
    console.log(url)

    fetch(url)
    .then(responce => console.log(responce))
}

// La modale maison (pas de librairie)

const form = document.querySelector("form")
const modal = document.querySelector(".modal")
const del = document.querySelector(".delete")
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

form.addEventListener("submit", (e) => {
    e.preventDefault()

    del.addEventListener("click", toggleModal)
    closeButton.addEventListener("click", toggleModal)
    window.addEventListener("click", windowOnClick)

    // Fermeture de la modale avec la touche "Echap"
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            toggleModal()
        }
    })

    understood.addEventListener("click", toggleModal)

})


