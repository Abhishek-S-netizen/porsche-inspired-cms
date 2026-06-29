const gallerySection = document.querySelector(".gallery-section");
const galleryImage1 = document.getElementById("gallery-1");
const galleryImage2 = document.getElementById("gallery-2");
const galleryImage3 = document.getElementById("gallery-3");
const highlightsContainer = document.querySelector(".highlights-container");
const driveContainer = document.querySelector(".drive-container");
const driveImage = document.getElementById("drive-parallax-image");
const driveSection = document.querySelector(".drive-parallax-container");

// gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(Draggable);

window.addEventListener("scroll", () => {
    const rect = gallerySection.getBoundingClientRect();
    // Get the section's position relative to the screen

    const scrollProgress = Math.min(
        Math.max(
            (window.innerHeight - rect.top) / (window.innerHeight + rect.height), 0
        ), 1
    );

    const scale = 1.3 - (scrollProgress * 0.3);
    galleryImage1.style.transform = `scale(${scale})`;

    const translateY2 = 300 - (scrollProgress * 500);
    galleryImage2.style.transform = `translateX(80%) translateY(${translateY2}px) scale(1.5)`;

    const scaleImage3 = 1.5 + (scrollProgress * 0.3);
    galleryImage3.style.transform = `scale(${scaleImage3})`;
});

let isDown = false;
let startX;
let scrollLeft;

highlightsContainer.addEventListener("mousedown", (e) => {
    isDown = true;
    startX = e.pageX;
    highlightsContainer.style.scrollSnapType = "none"; // disable snap while dragging
    scrollLeft = highlightsContainer.scrollLeft;
});

driveContainer.addEventListener("mousedown", (e) => {
    isDown = true;
    startX = e.pageX;
    driveContainer.style.scrollSnapType = "none";
    scrollLeft = driveContainer.scrollLeft;
});

highlightsContainer.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const walk = startX - e.pageX;
    highlightsContainer.scrollLeft = scrollLeft + walk;
});

driveContainer.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const walk = startX - e.pageX;
    driveContainer.scrollLeft = scrollLeft + walk;
})

function driveSnapToNearest() {
    const driveCard = driveContainer.querySelector("div");
    const driveCardWidth = driveCard.offsetWidth;
    const driveGap = 32;
    const driveStep = driveCardWidth + driveGap;

    const driveNearestIndex = Math.round(driveContainer.scrollLeft / driveStep);
    const driveTargetScroll = driveNearestIndex * driveStep;

    driveContainer.scrollTo({
        left: driveTargetScroll,
        behavior: "smooth"
    });

}

function snapToNearest() {
    const card = highlightsContainer.querySelector("div");
    const cardWidth = card.offsetWidth;
    const gap = 32; // 2rem gap in px
    const step = cardWidth + gap;

    const nearestIndex = Math.round(highlightsContainer.scrollLeft / step);
    const targetScroll = nearestIndex * step;

    highlightsContainer.scrollTo({
        left: targetScroll,
        behavior: "smooth" // <-- smooth animation
    });
}

["mouseup", "mouseleave"].forEach(evt => {
    highlightsContainer.addEventListener(evt, () => {
        if (isDown) {
            isDown = false;
            snapToNearest(); // smooth snap when drag ends
        }
        highlightsContainer.style.scrollSnapType = "x mandatory";
    });
});

["mouseup", "mouseleave"].forEach(evt => {
    driveContainer.addEventListener(evt, () => {
        if (isDown) {
            isDown = false;
            driveSnapToNearest(); // smooth snap when drag ends
        }
        driveContainer.style.scrollSnapType = "x mandatory";
    });
});

window.addEventListener('scroll', () => {
    const rect = driveSection.getBoundingClientRect();
    const offset = rect.top * -0.3;
    driveImage.style.transform = `translate3d(0,${offset}px , 0)`;
}, { passive: true });