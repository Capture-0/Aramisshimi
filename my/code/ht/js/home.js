var transit = "1.4s ease-out";
var slide = document.querySelector("#carousel .slide");
var images = document.querySelectorAll("#carousel .slide > img");
var slideSize = slide.getBoundingClientRect().width;
slide.prepend(images[images.length - 1].cloneNode());
slide.append(images[0].cloneNode());
slide.style.transform = "translateX(" + slideSize + "px)";
var carouselCurrent = 1;

function carouselNext() {
    slideSize = slide.getBoundingClientRect().width;
    if (carouselCurrent < 1) return;
    slide.style.transition = "transform " + transit;
    carouselCurrent--;
    slide.style.transform = "translateX(" + slideSize * carouselCurrent + "px)";
}

function carouselPrev() {
    slideSize = slide.getBoundingClientRect().width;
    if (carouselCurrent > images.length) return;
    slide.style.transition = "transform " + transit;
    carouselCurrent++;
    slide.style.transform = "translateX(" + slideSize * carouselCurrent + "px)";
}

slide.addEventListener("transitionend", () => {
    if (carouselCurrent == images.length + 1 || carouselCurrent == 0) {
        slide.style.transition = "none";
        carouselCurrent = carouselCurrent == 0 ? images.length : 1;
        slide.style.transform = "translateX(" + slideSize * carouselCurrent + "px)";
    }
});
setInterval(carouselPrev, 20000)