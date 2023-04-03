const cards_container = document.querySelector('.cards_container');

// Le flip de la carte -------------------------------------------------------------

// Sélectionnez l'élément sur lequel vous voulez ajouter l'effet de clic


function flipCard(element) {
    let card = element.querySelector('.flip-card')
    let rotation = card.dataset.rotation || 0
    rotation = parseInt(rotation) + 180
    card.style.transform = `rotateY(${rotation}deg)`
    card.dataset.rotation = rotation
}

let item = cards_container.children[2]

let flipCallback = function () {
    flipCard(item)
}

function enableFlip() {
    item.addEventListener('click', flipCallback)
}

function disableFlip() {
    item.removeEventListener('click', flipCallback)
}

window.onload = enableFlip()


//Defilement des cards ------------------------------------------------------------------------

document.querySelector('.prev-arrow').addEventListener('click', (e) => {
    disableFlip()
    cards_container.prepend(cards_container.querySelector('.item:last-of-type'));
});

document.querySelector('.next-arrow').addEventListener('click', (e) => {
    disableFlip()
    cards_container.append(cards_container.querySelector('.item:first-of-type'));
});

// La fonction minify pour réduire la taille des textes trop longs ------------------------------

function minify(overview) {
    if (overview.length <= 500) {
        return overview;
    }

    // Sépare le paragraphe en phrases en utilisant un point, un point d'exclamation ou un point d'interrogation comme séparateurs
    let phrases = overview.split(/(?<=[.!?])\s+/);

    // Supprime les phrases en trop jusqu'à ce que la longueur de l'overview soit égale ou inférieure à 300 caractères
    while (overview.length > 500) {
        phrases.pop();
        overview = phrases.join(' ');
    }

    return overview;
}

// Fonction date pour afficher la date de sortie du film en format français ---------------------------------------

function formatDate(inputDate) {
    const dateParts = inputDate.split('-');
    return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
}


// Les variables utiles  ----------------------------------------------------

let increment = 0
api_key = 'c5c6fbf4667f0cc8747fc1393fb89003'

// Avancer dans le carousel de film ------------------------------------------------------------

document.querySelector('.next-arrow').addEventListener('click', (e) => {

    // Fermer la carte si elle est ouverte
    let close_card = cards_container.children[1].firstElementChild
    if (close_card.dataset.rotation % 360 != 0) {
        close_card.style.transform = `rotateY(${close_card.dataset.rotation - 180}deg)`
        if (close_card.dataset.rotation >= 0) {
            close_card.dataset.rotation = close_card.dataset.rotation - 180
        }
    }

    // Désactiver le clic sur la carte précédente
    let previous_item = cards_container.children[2]
    previous_item.pointerEvent = 'none'

    increment++
    let index = increment

    let result = [];

    for (let i = 0; i < 5; i++) {

        result.push(movies[index]); // Ajouter la valeur actuelle à la sortie
        index = (index + 1) % movies.length; // Avancer l'index, en revenant à 0 après la dernière valeur
    }

    // Récupérer les éléments de la carte
    const container = document.querySelector('.cards_container')
    const front = container.lastElementChild.firstElementChild.firstElementChild
    const back = container.lastElementChild.firstElementChild.lastElementChild
    const stars = document.querySelectorAll(".fa-solid")

    let id = result[4].viewing_tmdb_id

    // Appel de l'API en Javasript pour récupérer le poster du film

    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}&language=fr-FR&adult=false`)
        .then(response => response.json())
        .then((data) => {
            let movie_api_data = data
            container.lastElementChild.dataset.tmdb_id = movie_api_data.id
            front.style = `background-image: url("https://image.tmdb.org/t/p/w500${movie_api_data.poster_path}"); background-size: cover; background-position: center;`

            back.firstElementChild.innerHTML = movie_api_data.title
            back.children[1].innerHTML = minify(movie_api_data.overview)
            back.children[2].innerHTML = 'Date de sortie : ' + formatDate(movie_api_data.release_date)
            movies.forEach(movie => {
                if (movie.viewing_tmdb_id == id) {
                    rate = movie.rating_rates
                    for (let i = 0; i < rate; i++) {
                        stars[i].classList.add('gold')
                    }
                }
            })
        })

    item = cards_container.children[2]

    function enableFlip() {
        item.addEventListener('click', flipCallback)
    }

    enableFlip()
})

// Revenir dans le carousel de film ------------------------------------------------------------

document.querySelector('.prev-arrow').addEventListener('click', (e) => {

    let close_card = cards_container.children[3].firstElementChild
    if (close_card.dataset.rotation % 360 != 0) {
        close_card.style.transform = `rotateY(${close_card.dataset.rotation - 180}deg)`
        if (close_card.dataset.rotation >= 0) {
            close_card.dataset.rotation = close_card.dataset.rotation - 180
        }
    }

    let previous_item = cards_container.children[2]
    previous_item.pointerEvent = 'none'

    increment--
    if (increment < 0) {
        increment = movies.length - 1
    }
    let index = increment

    let result = [];

    for (let i = 0; i < 5; i++) {

        result.push(movies[index]); // Ajouter la valeur actuelle à la sortie
        index = (index + 1) % movies.length; // Avancer l'index, en revenant à 0 après la dernière valeur
    }

    const container = document.querySelector('.cards_container')
    const front = container.firstElementChild.firstElementChild.firstElementChild
    const back = container.lastElementChild.firstElementChild.lastElementChild
    const stars = document.querySelectorAll(".fa-solid")

    id = result[0].viewing_tmdb_id

    // Appel de l'API en Javasript pour récupérer le titre du film
    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}&language=fr-FR&adult=false`)
        .then(response => response.json())
        .then((data) => {
            let movie = data
            container.firstElementChild.dataset.tmdb_id = movie.id
            front.style = `background-image: url("https://image.tmdb.org/t/p/w500${movie.poster_path}"); background-size: cover; background-position: center;`

            back.firstElementChild.innerHTML = movie_api_data.title
            back.children[1].innerHTML = minify(movie_api_data.overview)
            back.children[2].innerHTML = `Date de sortie : ${movie_api_data.release_date}`
            movies.forEach(movie => {
                if (movie.viewing_tmdb_id == id) {
                    rate = movie.rating_rates
                    for (let i = 0; i < rate; i++) {
                        stars[i].classList.add('gold')
                    }
                }
            })
        })

    item = cards_container.children[2]

    function enableFlip() {
        item.addEventListener('click', flipCallback)
    }

    enableFlip()
})


































