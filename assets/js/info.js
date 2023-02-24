// La modal "info"

const info = document.querySelectorAll(".info")

info.forEach(infos => {
    infos.addEventListener("click", () => {
        window.location.href = 'home.php'
    })
})
