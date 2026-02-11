// main.js

// Vérification que le JS est chargé
console.log("Le site est chargé !");

// Smooth scroll pour les liens internes (À propos / Contact)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if(target) {
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

// Exemple : animation simple sur les cartes lors du hover (optionnel)
const cards = document.querySelectorAll('.card');
cards.forEach(card => {
  card.addEventListener('mouseenter', () => {
    card.style.transform = 'translateY(-5px)';
    card.style.boxShadow = '0 15px 35px rgba(2,6,23,0.6)';
  });
  card.addEventListener('mouseleave', () => {
    card.style.transform = 'translateY(0)';
    card.style.boxShadow = '0 10px 30px rgba(2,6,23,0.6)';
  });
});

document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput");
    const cards = document.querySelectorAll(".card-link");

    input.addEventListener("input", () => {
        const query = input.value.toLowerCase().trim();

        cards.forEach(cardLink => {
            const card = cardLink.querySelector(".card");
            const nom = card.dataset.nom;
            const tag = card.dataset.tag;

            const match =
                nom.includes(query) ||
                tag.includes(query);

            cardLink.style.display = match ? "block" : "none";
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {

    const input = document.getElementById("searchInput");
    const cards = document.querySelectorAll(".card-link");
    const checkboxes = document.querySelectorAll(".filter-checkbox");

    const dropdownBtn = document.getElementById("dropdownBtn");
    const dropdownMenu = document.getElementById("dropdownMenu");

    // Ouvrir / fermer menu
    dropdownBtn.addEventListener("click", () => {
        dropdownMenu.classList.toggle("active");
    });

    // Fermer si clic extérieur
    document.addEventListener("click", (e) => {
        if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove("active");
        }
    });

    function filterArticles() {
        const query = input.value.toLowerCase().trim();

        const selectedTags = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        cards.forEach(cardLink => {
            const card = cardLink.querySelector(".card");
            const nom = card.dataset.nom;
            const tag = card.dataset.tag;

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

});
