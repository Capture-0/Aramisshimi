<main>
    <section id="services">
        <div id="servicesContainer">
            <div>
                <img data-src="default.jpg" src="" alt="">
                <div>
                    <h2></h2>
                </div>
            </div>
            <div>
                <div>کارگاه و کارخانه مواد شوینده</div>
                <div>فرمولاسیون مواد شوینده کاربردی تضمین شده</div>
                <div>خط تولید شوینده با 8.5 میلیون تومان</div>
                <div>خط تولید شوینده با 170 میلیون تومان</div>
                <div>فرمول شامپو کارواش و خط تولید کارواشی</div>
                <div>خط تولید پودر لباسشویی روتاری درایر</div>
                <div>خط تولید پودر لباسشویی اسپری درایر</div>
                <div>خط تولید قرص ظرفشویی</div>
                <div>خط تولید صابون</div>
            </div>
        </div>
    </section>
    <section id="carousel">
        <div class="frame">
            <div class="slide">
                <img data-src="carousel/img 1.jpeg" src="" alt="">
                <img data-src="carousel/img 2.jpeg" src="" alt="">
                <img data-src="carousel/img 3.jpeg" src="" alt="">
                <img data-src="carousel/img 4.jpeg" src="" alt="">
            </div>
        </div>
        <button onclick="carouselPrev()" style="left: 0;"><i class="fas fa-chevron-left"></i></button>
        <button onclick="carouselNext()" style="right: 0;"><i class="fas fa-chevron-right"></i></button>
    </section>
</main>
<script>
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
</script>