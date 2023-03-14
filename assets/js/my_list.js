// Rating 

const stars = document.querySelectorAll(".fa-star");
const count = document.querySelectorAll(".movie_list").length

stars.forEach((star, index) => {
    star.addEventListener("click", (e) => {
        let rating = index % 5 + 1;

        let film_id = e.target.parentElement.parentElement.parentElement.parentElement.dataset.id

        let film_stars = document.querySelectorAll(`.movie_list[data-id="${film_id}"] .fa-star`)

        film_stars.forEach((star, i) => {
            if (i < rating) {
                star.classList.add("gold");
            } else {
                star.classList.remove("gold");
            }
        });

    });
});




        // const form = document.querySelector("form")
        // const ask_rating = document.querySelector(".ask_rating")
        // const user_rating = document.querySelector(".user_rating")

        // form.addEventListener("submit", (e) => {
        //     e.preventDefault()
        //     let rating
        //     stars.forEach((star) => {
        //         if (star.classList.contains("gold")) {
        //             rating++
        //         }
        //     })
        //     if (rating === 0) {
        //         ask_rating.classList = "error_rating"
        //     } else {
        //         user_rating.value = rating
        //         form.submit()
        //     }
        // })