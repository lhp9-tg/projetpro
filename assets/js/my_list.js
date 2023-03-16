// Rating 

const stars = document.querySelectorAll(".fa-star");

stars.forEach((star, index) => {
    star.addEventListener("click", (e) => {
        let rating = index % 5 + 1;

        let film_id = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.dataset.id

        let film_stars = document.querySelectorAll(`.movie_list[data-id="${film_id}"] .fa-star`)

        film_stars.forEach((star, i) => {
            if (i < rating) {
                star.classList.add("gold");
            } else {
                star.classList.remove("gold");
            }
        });

        let new_rating = document.querySelector(`.movie_list[data-id="${film_id}"] .new_rating`)
        new_rating.value = rating
    });
});




