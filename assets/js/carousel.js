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


//Defilement des cards
const cards_container = document.querySelector('.cards_container');

document.querySelector('.prev-arrow').addEventListener('click', (e)=>{
    cards_container.append(cards_container.querySelector('.item:first-of-type'));
});

document.querySelector('.next-arrow').addEventListener('click', (e)=>{
    cards_container.prepend(cards_container.querySelector('.item:last-of-type'));
});




