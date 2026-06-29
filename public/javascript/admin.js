banner = document.getElementById("flash-banner");

if (banner) {
    setTimeout(() => {
        banner.classList.add("show");
    }, 300);

    setTimeout(() => {
        banner.classList.remove("show");
    }, 3000);
}