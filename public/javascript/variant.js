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

function clearMobileGalleryTransforms() {
    if (window.innerWidth <= 768) {
        if (galleryImage1) galleryImage1.style.transform = "";
        if (galleryImage2) galleryImage2.style.transform = "";
        if (galleryImage3) galleryImage3.style.transform = "";
    }
}

window.addEventListener("resize", clearMobileGalleryTransforms);

window.addEventListener("scroll", () => {
    if (!gallerySection || window.innerWidth <= 768) {
        clearMobileGalleryTransforms();
        return;
    }

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

function enableDragScroll(container) {
    if (!container) return;

    let isDown = false;
    let startX = 0;
    let scrollLeft = 0;
    let lastPageX = 0;
    let velocity = 0;
    let momentumId = null;

    function cancelMomentum() {
        if (momentumId) {
            cancelAnimationFrame(momentumId);
            momentumId = null;
        }
    }

    function applyMomentum() {
        if (Math.abs(velocity) < 0.5) {
            velocity = 0;
            momentumId = null;
            return;
        }

        container.scrollLeft += velocity;
        velocity *= 0.95; // friction damping (coasts smoothly to a stop)
        momentumId = requestAnimationFrame(applyMomentum);
    }

    function stopDragging() {
        if (!isDown) return;
        isDown = false;
        cancelMomentum();
        momentumId = requestAnimationFrame(applyMomentum);
    }

    container.addEventListener("mousedown", (e) => {
        if (e.button !== 0) return; // left click only
        e.preventDefault(); // prevent browser native image ghost-drag
        cancelMomentum();
        isDown = true;
        startX = e.pageX;
        lastPageX = e.pageX;
        velocity = 0;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const delta = lastPageX - e.pageX;
        lastPageX = e.pageX;
        velocity = delta * 1.4; // flick sensitivity
        const walk = startX - e.pageX;
        container.scrollLeft = scrollLeft + walk;
    });

    container.addEventListener("mouseup", stopDragging);
    container.addEventListener("mouseleave", stopDragging);
    window.addEventListener("mouseup", stopDragging);
}

enableDragScroll(highlightsContainer);
enableDragScroll(driveContainer);

window.addEventListener('scroll', () => {
    const rect = driveSection.getBoundingClientRect();
    const offset = rect.top * -0.3;
    driveImage.style.transform = `translate3d(0,${offset}px , 0)`;
}, { passive: true });