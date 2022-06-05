const slideshow = document.querySelector(".slideshow");
const hambargar = document.querySelector(".hambargar");
const overlay = document.querySelector(".overlay");
const closes = document.querySelector("#close");

document.addEventListener("click", (e) => {
    if (e.target.matches(".overlay")) {
        slideshow.classList.toggle("showingslideshow");
        overlay.classList.toggle("visibility");
    }
});

hambargar.addEventListener("click", () => {
    slideshow.classList.toggle("showingslideshow");
    overlay.classList.toggle("visibility");
});

closes.addEventListener('click', () => {
    slideshow.classList.toggle("showingslideshow");
    overlay.classList.toggle("visibility");
});
