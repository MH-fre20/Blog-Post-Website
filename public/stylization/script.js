const slideshow = document.querySelector(".slideshow");
const hambargar = document.querySelector(".hambargar");
const overlay = document.querySelector(".overlay");
const closes = document.querySelector("#close");
const header = document.querySelector("#header");
const mynav = document.querySelector("#mynav");
const GoToTop = document.querySelector(".GoToTop");

window.addEventListener("scroll", () => {
    /*  window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    }); */
    if (window.pageYOffset > 100) {
        GoToTop.classList.add("activeToTop");
    } else {
        GoToTop.classList.remove("activeToTop");
    }

    GoToTop.classList.toggle("rotate");
});

let lastScrollY = window.scrollY;

window.addEventListener("scroll", () => {
    if (lastScrollY < window.scrollY) {
        header.classList.add("hidden");
    } else {
        header.classList.remove("hidden");
    }
    lastScrollY = window.scrollY;
});

document.addEventListener("click", (e) => {
    if (e.target.matches(".overlay")) {
        header.classList.toggle("hidden");
        slideshow.classList.toggle("showingslideshow");
        overlay.classList.toggle("visibility");
    }
});

hambargar.addEventListener("click", () => {
    header.classList.toggle("hidden");
    slideshow.classList.toggle("showingslideshow");
    overlay.classList.toggle("visibility");
});

closes.addEventListener("click", () => {
    header.classList.toggle("hidden");
    slideshow.classList.toggle("showingslideshow");
    overlay.classList.toggle("visibility");
});
