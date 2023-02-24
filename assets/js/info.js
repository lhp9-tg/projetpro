// La modal "info"

const info = document.querySelectorAll(".info")

if (info.length > 0) {
    info.forEach(infos => {
        infos.addEventListener("click", () => {
            window.location.href = 'home.php'
        })
    })
}