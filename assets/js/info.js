// La modal "info"

const info = document.querySelectorAll(".info")

info.forEach(infos => {
    infos.addEventListener("click", () => {
        window.location.href = 'home.php'
    })
})

const error = document.querySelectorAll(".error")

error.forEach(errors => {
    errors.addEventListener("click", () => {
        window.location.href = '../controllers/explorer.php';
    })
})
