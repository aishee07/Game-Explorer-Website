document.addEventListener("DOMContentLoaded", () => {
    console.log("Document ready!");

    fetch('fetch_new_games.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("Fetched data:", data);

            const container = document.querySelector(".new .swiper-wrapper");
            if (!container) {
                console.error("Could not find the container for new games.");
                return;
            }

            data.forEach(game => {
                const gameSlide = document.createElement("div");
                gameSlide.classList.add("swiper-slide");
                gameSlide.innerHTML = `
                    <div class="box">
                        <div class="box-inner">
                            <div class="box-front">
                                <img src="${game.g_image_url || 'default_image.jpg'}" alt="${game.g_name}">
                            </div>
                            <div class="box-back">
                                <div class="box-text">
                                    <h2>${game.g_name}</h2>
                                    <h3>${game.g_category || 'Unknown Category'}</h3>
                                    <p>${game.g_description || 'No description available.'}</p>
                                    <div class="rating">
                                        ${generateStars(game.g_rating || 0)}
                                        <span>${game.g_rating || 'N/A'}/10</span>
                                    </div>
                                    <a href="${game.g_download_url || '#'}" class="box-btn">
                                        <i class='bx bx-down-arrow-alt'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(gameSlide);
            });

            // Initialize Swiper
            new Swiper(".new-content", {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    768: { slidesPerView: 3 },
                    1068: { slidesPerView: 4 },
                }
            });
        })
        .catch(error => console.error('Error fetching new games:', error));
});

function generateStars(rating) {
    const normalizedRating = rating / 2; // Convert a 10-point scale into 5-star equivalents
    let stars = "";

    for (let i = 0; i < 5; i++) {
        if (i < Math.floor(normalizedRating)) {
            stars += "<i class='bx bxs-star'></i>"; // Full stars
        } else if (i < normalizedRating) {
            stars += "<i class='bx bxs-star-half'></i>"; // Half stars
        } else {
            stars += "<i class='bx bx-star'></i>"; // Empty stars
        }
    }

    return stars;
}
