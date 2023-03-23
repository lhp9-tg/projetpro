function addDot() {

    const addbutton = document.querySelector('.addDot')
    const years = document.querySelector('.years')

    addbutton.addEventListener('click', () => {
        let dot = document.createElement('div')
        dot.className = 'dots'
        dot = years.appendChild(dot)

    })
}

function removeDot() {
    const removeButton = document.querySelector('.removeDot')
    const years = document.querySelector('.years')

    removeButton.addEventListener('click', () => {
        if (years.children.length > 1) {
            years.children[1].remove()
        }
    })
}

addDot()
removeDot()

const cards_container = document.querySelector('.cards_container');

// Le flip de la carte -------------------------------------------------------------

// Sélectionnez l'élément sur lequel vous voulez ajouter l'effet de clic

let cardFlipped = false;

function flipCard(element) {
    cardFlipped = !cardFlipped
    let rotation = cardFlipped ? 180 : 0
    element.querySelector('.flip-card').style.transform = `rotateY(${rotation}deg)`
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


// Génération des cards pour le défilement ----------------------------------------------------

let increment = 0
api_key = 'c5c6fbf4667f0cc8747fc1393fb89003'

// Avancer dans le carousel de film ------------------------------------------------------------

document.querySelector('.next-arrow').addEventListener('click', (e) => {

    let previous_item = cards_container.children[2]
    previous_item.pointerEvent = 'none'

    increment++
    let index = increment

    let result = [];

    for (let i = 0; i < 5; i++) {

        result.push(movies[index]); // Ajouter la valeur actuelle à la sortie
        index = (index + 1) % movies.length; // Avancer l'index, en revenant à 0 après la dernière valeur
    }

    const container = document.querySelector('.cards_container')
    const front = container.lastElementChild.firstElementChild.firstElementChild

    id = result[4].viewing_tmdb_id

    // Appel de l'API en Javasript pour récupérer le titre du film

    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}&language=fr-FR&adult=false`)
        .then(response => response.json())
        .then((data) => {
            let movie = data
            container.lastElementChild.dataset.tmdb_id = movie.id
            front.style = `background-image: url("https://image.tmdb.org/t/p/w500${movie.poster_path}"); background-size: cover; background-position: center;`
        })

    item = cards_container.children[2]

    function enableFlip() {
        item.addEventListener('click', flipCallback)
    }

    enableFlip()
})

// Revenir dans le carousel de film ------------------------------------------------------------

document.querySelector('.prev-arrow').addEventListener('click', (e) => {

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

    id = result[0].viewing_tmdb_id

    // Appel de l'API en Javasript pour récupérer le titre du film
    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}&language=fr-FR&adult=false`)
        .then(response => response.json())
        .then((data) => {
            let movie = data
            container.firstElementChild.dataset.tmdb_id = movie.id
            front.style = `background-image: url("https://image.tmdb.org/t/p/w500${movie.poster_path}"); background-size: cover; background-position: center;`
        })

    item = cards_container.children[2]

    function enableFlip() {
        item.addEventListener('click', flipCallback)
    }

    enableFlip()
})



















