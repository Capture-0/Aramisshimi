<?php
$_PAGE = array(
    "title" => "post ha", // 70 chars limit
    "description" => "modiriyate website", // 160 chars limit
    "keywords" => "posts,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "posts"
);
if (count($_REQUEST) == 0) cnf_page_create($_PAGE);
?>
<main class="container">
    <h2>
        <?php
        if (count($_REQUEST) > 0) echo "poste shomare 2";
        else echo "پست ها";
        ?>
    </h2>
    <?php
    if (count($_REQUEST) > 0) {
        echo '<article>
        <p class="category">مقالات<i class="fas fa-chevron-left"></i>دسته بندی<i class="fas fa-chevron-left"></i>خط تولید صابون</p>
        <div class="info">
            <img data-src="documentary/image61.jpg" src="" alt="">
            <h3></h3>
            <p><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
        </div>
        <div class="content"></div>
        <div class="extra">
            <div class="tags">
                <div>salam</div>
            </div>
            <div class="comments">
                <h3>ثبت نظر</h3>
                <form method="post">
                    <div>
                        <span>نام</span>
                        <input type="text" />
                    </div>
                    <div>
                        <span>ایمیل یا شماره موبایل</span>
                        <input type="text" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>نظر</span>
                        <textarea name="orderDesc" contenteditable="true"></textarea>
                    </div>
                    <button style="grid-column: 1 / -1;" type="submit" name="submit">ثبت</button>
                </form>
                <div class="comment">
                    <div class="head">
                        <img data-src="documentary/image69.jpg" alt="">
                        <div>
                            <h4></h4>
                            <span></span>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <p></p>
                </div>
            </div>
        </div>
    </article>';
    }

    // # aks
    // # onvan 4 - 10 words
    // # mozooe 30 - 50 words
    // # mohtava > 400 words
    // # dastebandi
    // barchasb < 12
    // # comments
    // # bazdid
    // # tarikh
    ?>

    <section>
        <article>
            <div><img data-src="documentary/image55.jpg" src="" alt=""></div>
            <div>
                <h3>خود اشتغالی</h3>
                <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
                <p class="text">صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.</p>
                <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
            </div>
        </article>
        <div class="hr"></div>
        <article>
            <div><img data-src="documentary/image55.jpg" src="" alt=""></div>
            <div>
                <h3>خود اشتغالی</h3>
                <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
                <p class="text">صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.</p>
                <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
            </div>
        </article>
        <div class="hr"></div>
        <article>
            <div><img data-src="documentary/image55.jpg" src="" alt=""></div>
            <div>
                <h3>خود اشتغالی</h3>
                <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
                <p class="text">صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.</p>
                <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
            </div>
        </article>
        <div class="hr"></div>
        <article>
            <div><img data-src="documentary/image55.jpg" src="" alt=""></div>
            <div>
                <h3>خود اشتغالی</h3>
                <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
                <p class="text">صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.</p>
                <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
            </div>
        </article>
        <div class="hr"></div>
        <article>
            <div><img data-src="documentary/image55.jpg" src="" alt=""></div>
            <div>
                <h3>خود اشتغالی</h3>
                <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
                <p class="text">صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.</p>
                <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
            </div>
        </article>
        <div class="hr"></div>
        <article>
            <div><img data-src="documentary/image55.jpg" src="" alt=""></div>
            <div>
                <h3>خود اشتغالی</h3>
                <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>sat 10:06 00/4/25</p>
                <p class="text">صفر تا صد شروع و توسعه انواع خط تولید شوینده در کنار شماییم.
                    در جهت ایجاد اشتغال پایدار در ایران عزیز اقدام به راه اندازی و تاسیس کارخانه تولید مواد شوینده در هر حجمی برای شما می نماییم.</p>
                <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
            </div>
        </article>
        <div class="hr"></div>
        <div id="pageIndex"></div>
    </section>
    <aside>
        <div class="search">
            <input placeholder="جستجو ..." type="text">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="hr"></div>
        <h3>پر بازدید ها</h3>
        <div class="articleContainer">
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="fas fa-eye"></i>289</span>
                </p>
            </article>
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="fas fa-eye"></i>289</span>
                </p>
            </article>
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="fas fa-eye"></i>289</span>
                </p>
            </article>
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="fas fa-eye"></i>289</span>
                </p>
            </article>
        </div>
        <div class="hr"></div>
        <div>
            <h3>دسته بندی ها</h3>
            <div>مایع</div>
            <div>دستگاه ها</div>
            <div>پودر</div>
        </div>
        <div class="hr"></div>
        <h3>جدید ترین مطالب</h3>
        <div class="articleContainer">
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="far fa-calendar-alt"></i>sat 10:06 00/4/25</span>
                </p>
            </article>
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="far fa-calendar-alt"></i>sat 10:06 00/4/25</span>
                </p>
            </article>
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="far fa-calendar-alt"></i>sat 10:06 00/4/25</span>
                </p>
            </article>
            <article>
                <div><img data-src="documentary/image11.jpg" src="" alt=""></div>
                <p>
                    بهترین محصول و خدمات
                    <br>
                    <span><i class="far fa-calendar-alt"></i>sat 10:06 00/4/25</span>
                </p>
            </article>
        </div>
    </aside>
</main>
<script>
    let pages = pagingIndexes(351, 10, 14);
    for (let i = 0; i < pages.length; i++) {
        document.querySelector("main > section > #pageIndex").innerHTML += "<div " + (pages[i] == "..." ? '' : 'data-page="' + pages[i] + '"') + " >" + pages[i] + "<div>";
    }
    <?php
    if (count($_REQUEST) > 0) {
        echo 'document.querySelector("main > section").remove()';
    }
    ?>
</script>