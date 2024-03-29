<footer id="outro">
    <div class="container">
        <ul>
            <li><img style="width: 10em;" data-src="logo-secondary.png" src="" alt="" /></li>
            <li>
                <p><i class="fas fa-map-marker-alt"></i>
                <address style="white-space: normal;">خراسان رضوی - قوچان شهرک صنعتی 1 بلوار تلاش 2 پلاک 5 </address>
                </p>
            </li>
            <li><a href="tel:05137136472"><span><i class="fas fa-phone"></i> 05137645799</span></a></li>
            <li style="white-space: normal;"><i class="fas fa-mobile-alt"></i><br /><a href="tel:+989019966591"><span>09019966591</span>, <a href="tel:+989015555101"><span>09015555101</span></a>, <a href="tel:+989128005712"><span>09128005712</span></li>
            <li><a href="mailto:majid13590606@gmail.com"><span><i class="fas fa-envelope"></i> majid13590606@gmail.com</span></a></li>
        </ul>
        <ul>
            <li>
                <h4>لینک های مفید</h4>
            </li>
            <li><a href="">کارگاه و کارخانه</a></li>
            <li><a href="">تجهیزات متخصصان</a></li>
            <li><a href="">تجهیزات محل کار</a></li>
            <li><a href="/Page/Certificates">گواهینامه ها</a></li>
            <li><a href="/Support">ارتباط با ما</a></li>
        </ul>
        <ul>
            <li>
                <h4>خدمات</h4>
            </li>
            <li><a href="">مواد شوینده کاربردی تضمین شده</a></li>
            <li><a href="">خط تولید با 8.5 میلیون تومان</a></li>
            <li><a href="">خط تولید با 170 میلیون تومان</a></li>
            <li><a href="">خط تولید کارواشی</a></li>
        </ul>
        <ul>
            <li>
                <h4>محصولات</h4>
            </li>
            <li><a href="">شامپو کارواش</a></li>
            <li><a href="">پودر روتاری درایر</a></li>
            <li><a href="">پودر اسپری درایر</a></li>
            <li><a href="">قرص ظرفشویی</a></li>
            <li><a href="">صابون</a></li>
        </ul>
        <ul>
            <li>
                <h4>شبکه های اجتماعی</h4>
            </li>
            <li>
                <a href=""><i style="color: #db4a39;" class="fab fa-google-plus-square"></i></a>
                <a href="instagram://user?username=aramisshimi"><i style="color: #bc2a8d;" class="fab fa-instagram-square"></i></a>
                <a href=""><i style="color: #0077b5;" class="fab fa-linkedin"></i></a>
                <a href="https://api.whatsapp.com/send?phone=989019966591"><i style="color: #4FCE5D;" class="fab fa-whatsapp-square"></i></a>
            </li>
        </ul>
    </div>
</footer>

<script>
    window.onload = async function() {
        if (window.globalThis.pageLoad != undefined) {
            window.globalThis.pageLoad.forEach(i => {
                i();
            });
        }
        loadImages();
    };
    window.addEventListener("scroll", function() {
        scrollReached(document.querySelectorAll("[data-height]"), function(element) {
            element.style.height = element.dataset.height;
            element.style.opacity = 1;
        });
    });
    document.querySelectorAll("nav ul a").forEach(e => {
        if (e.attributes.href.value.toLowerCase() == document.querySelector("nav ul").dataset.highlight.toLowerCase()) {
            e.addEventListener("click", event => {
                event.preventDefault();
            });
            e.querySelector("li").classList.add("active-page");
            return;
        }
    });
</script>