function addDot () {

    const addbutton = document.querySelector('.addDot')
    const years = document.querySelector('.years')

    addbutton.addEventListener('click', () => {
        const dot = document.createElement('div')
        dot.className = 'dots'
        dot = years.appendChild(dot)
    })
}

function removeDot () {
    const removeButton = document.querySelector('.removeDot')
    const years = document.querySelector('.years')

    removeButton.addEventListener('click', () => {
        years.firstChild.remove()
    })
}

addDot ()
removeDot ()



// Le carrousel dans son ensemble
const carrousel = document.querySelector('.carrousel')

// On récupère le conteneur de tous les éléments
const container = document.querySelector('.container')

// Liste des cards
const slides = Array.from(container.children)

//Le contenu des cards
const previouscard = document.querySelector('.previous-card')
const flipcardfront = document.querySelector('.flip-card-front')
const flipcardback = document.querySelector('.flip-card-back')
const nextcard = document.querySelector('.next-card')

//Les boutons
const previousbutton = document.querySelector('.previous-button')
const nextbutton = document.querySelector('.next-button')

let i = 0

slideWidth = flipcardfront.getBoundingClientRect().width

function slideNext(){

    i++

    // Si on dépasse la fin du diaporama, on repart au début
    if(i == slides.length - 1){
        i = 0
    }

    // On calcule la valeur du décalage
    let decal = -slideWidth * i
    container.style.transform = `translateX(${decal}px)`
}

function slidePrev(){
    // On décrémente le compteur
    i--

    //Si on dépasse le début du diaporama, on repart à la fin
    if(i == -slideWidth + 1){
        i = 0
    }

    // On calcule la valeur du décalage
    let decal = -slideWidth * i
    container.style.transform = `translateX(${decal}px)`
}


previousbutton.addEventListener('click', () => {
    slidePrev()
})

nextbutton.addEventListener('click', () => {    
    slideNext()
})


