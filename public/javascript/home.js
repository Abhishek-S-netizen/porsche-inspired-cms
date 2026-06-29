const heroImage = document.getElementById("hero-image");
const navbar = document.querySelector("nav");
const modelCard = document.querySelector(".models-card")

window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;

    if (heroImage) {
        heroImage.style.transform = `translate3D(0, ${scrolled * 0.3}px , 0)`;
    }
}, { passive: true });

function scrolledNavbar(entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            navbar.classList.remove("scrolled");
        }
        else {
            navbar.classList.add("scrolled");
        }
    });
}

const navObserver = new IntersectionObserver(scrolledNavbar, { threshold: 0.1 });
navObserver.observe(heroImage);

