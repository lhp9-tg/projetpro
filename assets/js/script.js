function addDot () {

    const addbutton = document.querySelector('.addDot')
    const years = document.querySelector('.years')

    addbutton.addEventListener('click', () => {
        let dot = document.createElement('div')
        dot.className = 'dots'
        dot = years.appendChild(dot)
        
    })
}

function removeDot () {
    const removeButton = document.querySelector('.removeDot')
    const years = document.querySelector('.years')

    removeButton.addEventListener('click', () => {
        if (years.children.length > 1) {
            years.children[1].remove()
        }
    })
}

addDot ()
removeDot ()



// // Le carrousel dans son ensemble
// const carrousel = document.querySelector('.carrousel')

// // On récupère le conteneur de tous les éléments
// const container = document.querySelector('.container')

// // Liste des cards
// const cards = Array.from(container.children)

// //Le contenu des cards
// let previouscard = document.querySelector('.previous-card')
// let flipcard = document.querySelector('.flip-card')
// let nextcard = document.querySelector('.next-card')

// //Les boutons
// const previousbutton = document.querySelector('.previous-button')
// const nextbutton = document.querySelector('.next-button')

// // let i = 0

// function cardWidth(card) {
//     return card.getBoundingClientRect().width
// }

// function slideNext(){

//     // i++

//     // // Si on dépasse la fin du diaporama, on repart au début
//     // if(i == cards.length - 1){
//     //     i = 0
//     // }

//     // On calcule la valeur du décalage
//     let decal
//     setTimeout( () => {

//         decal = cardWidth(flipcard)
//         container.children[0].style = `translateX(${decal}px)`
        
        
//         decal = cardWidth(flipcard)
//         container.children[1].style.transform = `translateX(${decal}px)`

//         decal = cardWidth(flipcard)
//         container.children[2].style.transform = `translateX(${decal}px)`
        
//     }, 100)

//     //Re-création d'une previouscard
//     // let newpreviouscard = document.createElement('div')
//     // newpreviouscard.className = 'previous-card'
//     // newpreviouscard = container.insertBefore(newpreviouscard, container.firstChild)

//     //Renaming des cards
//     // container.children[1].className = 'flip-card'
//     // container.children[2].className = 'next-card'

// }

// function slidePrev(){
//     // On décrémente le compteur
//     // i--

//     //Si on dépasse le début du diaporama, on repart à la fin
//     // if(i == -cards.length + 1){
//     //     i = 0
//     // }

//     // On calcule la valeur du décalage
//     let decal
//     setTimeout( () => {

        
//         container.children[0].className = 'flip-card'
//         decal = cardWidth(previouscard) 
//         container.children[0].style.transform = `translateX(${decal}px)`
        
        
//         decal = cardWidth(flipcard) + cardWidth(container)*0.05
//         container.children[1].style.transform = `translateX(${decal}px)`

//         decal = cardWidth(flipcard)
//         container.children[2].style.transform = `translateX(${decal}px)`
        
//     }, 100)
// }


// previousbutton.addEventListener('click', () => {
//     slidePrev()
// })

// nextbutton.addEventListener('click', () => {    
//     slideNext()
// })


// Defilement des cards
const container = document.querySelector('.container');

document.querySelector('.prev-arrow').addEventListener('click', (e)=>{
    container.append(container.querySelector('.item:first-of-type'));
});

document.querySelector('.next-arrow').addEventListener('click', (e)=>{
    container.prepend(container.querySelector('.item:last-of-type'));
});

