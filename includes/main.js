// main.js

document.addEventListener("DOMContentLoaded", () => {

    console.log("Le site est chargé !");

    /* =========================
       Smooth scroll
    ========================== */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    /* =========================
       Animation hover cartes
    ========================== */
    const simpleCards = document.querySelectorAll('.card');
    simpleCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 15px 35px rgba(2,6,23,0.6)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 10px 30px rgba(2,6,23,0.6)';
        });
    });

    /* =========================
       Recherche + Filtres (articles.php uniquement)
    ========================== */
    const input = document.getElementById("searchInput");
    const cardLinks = document.querySelectorAll(".card-link");
    const checkboxes = document.querySelectorAll(".filter-checkbox");

    const dropdownBtn = document.getElementById("dropdownBtn");
    const dropdownMenu = document.getElementById("dropdownMenu");

    // 👉 Si on n’est pas sur la page articles, on arrête ici
    if (input && cardLinks.length > 0) {

        function filterArticles() {
            const query = input.value.toLowerCase().trim();

            const selectedTags = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            cardLinks.forEach(cardLink => {
                const card = cardLink.querySelector(".card");
                if (!card) return;

                const nom = card.dataset.nom || "";
                const tag = card.dataset.tag || "";

                const matchSearch =
                    nom.includes(query) ||
                    tag.includes(query);

                const matchTag =
                    selectedTags.length === 0 ||
                    selectedTags.includes(tag);

                cardLink.style.display =
                    matchSearch && matchTag ? "block" : "none";
            });
        }

        input.addEventListener("input", filterArticles);
        checkboxes.forEach(cb =>
            cb.addEventListener("change", filterArticles)
        );

        // Dropdown sécurisé
        if (dropdownBtn && dropdownMenu) {

            dropdownBtn.addEventListener("click", () => {
                dropdownMenu.classList.toggle("active");
            });

            document.addEventListener("click", (e) => {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove("active");
                }
            });

        }
    }

    /* =========================
       Bouton retour en haut
    ========================== */
    const scrollBtn = document.getElementById("scrollTopBtn");

    if (scrollBtn) {

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                scrollBtn.style.display = "flex";
            } else {
                scrollBtn.style.display = "none";
            }
        });

        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }

});
