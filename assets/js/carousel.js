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


//Defilement des cards ------------------------------------------------------------------------

const cards_container = document.querySelector('.cards_container');

document.querySelector('.prev-arrow').addEventListener('click', (e) => {
    cards_container.prepend(cards_container.querySelector('.item:last-of-type'));
});

document.querySelector('.next-arrow').addEventListener('click', (e) => {
    cards_container.append(cards_container.querySelector('.item:first-of-type'));
});


// Génération des cards pour le défilement ----------------------------------------------------

let increment = 0
api_key = 'c5c6fbf4667f0cc8747fc1393fb89003'

console.log(movies)


document.querySelector('.next-arrow').addEventListener('click', (e) => {

    increment++
    let index = increment

    let result = [];
    console.log(index)

    for (let i = 0; i < 5; i++) {

        result.push(movies[index]); // Ajouter la valeur actuelle à la sortie
        index = (index + 1) % movies.length; // Avancer l'index, en revenant à 0 après la dernière valeur
    }

    console.log(result)

    const container = document.querySelector('.cards_container')
    const front = container.lastElementChild.firstElementChild.firstElementChild
    
    id = result[4].viewing_tmdb_id
    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}&language=fr-FR&adult=false`)
        .then(response => response.json())
        .then((data) => {
            let movie = data
            front.children[1].firstElementChild.textContent = movie.title
        })

})

document.querySelector('.prev-arrow').addEventListener('click', (e) => {

    increment--
    if (increment < 0) {
        increment = movies.length - 1
    }
    let index = increment

    let result = [];
    console.log(index)

    for (let i = 0; i < 5; i++) {

        result.push(movies[index]); // Ajouter la valeur actuelle à la sortie
        index = (index + 1) % movies.length; // Avancer l'index, en revenant à 0 après la dernière valeur
    }

    console.log(result)

    const container = document.querySelector('.cards_container')
    const front = container.lastElementChild.firstElementChild.firstElementChild

    id = result[0].viewing_tmdb_id
    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}&language=fr-FR&adult=false`)
        .then(response => response.json())
        .then((data) => {
            let movie = data
            front.children[1].firstElementChild.textContent = movie.title
        })
})


// Appel API pour récupérer les films TMDB ----------------------------------------------------



        















