const rating = document.querySelectorAll(".modal_rating");

if (rating.length > 0) {
    rating.forEach(ratings => {
        ratings.addEventListener("click", () => {
            window.location.href = 'home.php'
        })
    })
}