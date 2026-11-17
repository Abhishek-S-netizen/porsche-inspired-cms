const banner = document.getElementById("flash-banner");

if (banner) {
    setTimeout(() => {
        banner.classList.add("show");
    }, 300);

    setTimeout(() => {
        banner.classList.remove("show");
    }, 3000);
}

// Prevent form button spamming during submissions / Cloudinary operations
document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", () => {
        const submitButtons = form.querySelectorAll("button[type='submit'], button:not([type])");
        submitButtons.forEach((btn) => {
            btn.disabled = true;
        });
    });
});
