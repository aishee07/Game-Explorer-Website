document.addEventListener("DOMContentLoaded", () => {
    fetch('fetch_trending_games.php')
        .then(response => response.json())
        .then(data => {
            const container = document.querySelector(".swiper-wrapper");

            data.forEach(game => {
                const gameSlide = document.createElement("div");
                gameSlide.classList.add("swiper-slide");
                gameSlide.innerHTML = `
                    <div class="box">
                        <div class="box-inner">
                            <div class="box-front">
                                <img src="${game.image_url}" alt="${game.name}">
                            </div>
                            <div class="box-back">
                                <div class="box-text">
                                    <h2>${game.name}</h2>
                                    <h3>${game.category}</h3>
                                    <p>${game.description}</p>
                                    <div class="rating">
                                        ${generateStars(game.rating)}
                                        <span>${game.rating}/10</span>
                                    </div>
                                    <a href="${game.download_url}" class="box-btn">
                                        <i class='bx bx-down-arrow-alt'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(gameSlide);
            });
            

            // Reinitialize Swiper
            new Swiper(".trending-content", {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: { // Add navigation buttons
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 10 },
                    768: { slidesPerView: 3, spaceBetween: 15 },
                    1068: { slidesPerView: 4, spaceBetween: 20 },
                },
            });
        });
});

function generateStars(rating) {
    const normalizedRating = rating / 2; // Normalize 10-point scale into 5-star scale
    let stars = "";

    for (let i = 0; i < 5; i++) {
        if (i < Math.floor(normalizedRating)) {
            stars += "<i class='bx bxs-star'></i>"; // Full star
        } else if (i < normalizedRating) {
            stars += "<i class='bx bxs-star-half'></i>"; // Half star
        } else {
            stars += "<i class='bx bx-star'></i>"; // Empty star
        }
    }

    return stars;
}

// Toggle Menu
let menu = document.querySelector('.menu-icon');
let navbar = document.querySelector('.menu');

menu.onclick = () => {
    navbar.classList.toggle('active');
    menu.classList.toggle('move');
};
