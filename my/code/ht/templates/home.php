<main>
    <section id="services">
        <div id="servicesContainer">
            <div>
                <img data-src="liquid.jpg" src="" alt="">
                <div>
                    <h2>تولید شوینده</h2>
                    <div>خط تولید مواد شوینده کاربردی تضمین شده</div>
                    <button>ثبت سفارش</button>
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
    <section id="emblems" class="dark">
        <div class="container dark">
            <div>
                <h3>موفقیت در کار</h3>
                <p>
                    شما هم به اسانی میتوانید تولید کننده شوینده ها باشید فقط کافی است تجربه و تجهیزات تولید ما را داشته باشید.
                    <br />
                    تخصص ما طراحی ساخت ارایه فرمولاسیون و راه اندازی انواع خط تولید مواد شوینده مایع صابون و پودر رخت شویی سبک می باشد.
                </p>
            </div>
            <div>
                <h3>خود اشتغالی</h3>
                <p>
                    صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    <br />
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.
                </p>
            </div>
            <div>
                <h3>بهترین محصول و خدمات</h3>
                <p>
                    محصولات با بهترین کیفیت و سازگار با انواع پوست و مو.
                    <br />
                    پشتیبانی بلند مدت از فرمولاسون و تجهیزال تولید.
                </p>
            </div>
            <div>
                <h3>تسهیلات هنگام کار</h3>
                <p>
                    با ابزار وسایل و متخصصات حرفه ای کسب و کار بسیاری در اختیارتان قرار می دهیم.
                    <br />
                    خدمات رسانی در تمام نقاط خراسان رضوی و پشتیبانی تلفنی در ساعات کاری
                </p>
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