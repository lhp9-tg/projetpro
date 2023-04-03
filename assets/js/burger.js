function ToggleHideBurger() {
    if (/Android|iPhone/i.test(navigator.userAgent)) {
        document.querySelector(".menu").style.display = "none";
        document.querySelector("#burger").style.display = "inline-block";
      }
        else {
        document.querySelector(".menu").style.display = "flex";
        document.querySelector("#burger").style.display = "none";
    }
}

ToggleHideBurger();

/* Sélection des éléments HTML */
let link = document.getElementById('link')
let burger = document.getElementById('burger')
let ul = document.querySelector('ul')
let main = document.querySelector('main')

/* gestionnaire d'événement sur le a#link pour venir changer l'attribution de la classe .open à la ul et au span#burger */
link.addEventListener('click', function(e) {
  e.preventDefault()

  burger.classList.toggle('open')
  let menu_list = document.querySelector('.menu_list')
  menu_list.classList.toggle('open')

  // Suppression du border bottom sur le header
  let header = document.querySelector('header')
  if (header.getAttribute('style')) {
    header.removeAttribute('style')
  } else {
    header.setAttribute('style', 'border-bottom: 1px #383838 solid')
  }
})