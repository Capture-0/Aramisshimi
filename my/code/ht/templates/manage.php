<?php
$_PAGE = array(
    "title" => "modiriyat", // 70 chars limit
    "description" => "modiriyate website", // 160 chars limit
    "keywords" => "manage,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "form,manage"
);
cnf_page_create($_PAGE);
?>
<main>
    <section id="manage">
        <div class="container">
            <h2>صفحه مدیریت</h2>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> سفارشات</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div>
                    <div class="row">
                        <div>نام</div>
                        <div>شماره</div>
                        <div>ادرس</div>
                        <div>توضیحات</div>
                        <div><i class="fas fa-trash"></i></div>
                        <div><i class="fas fa-pen"></i></div>
                    </div>
                </div>
            </div>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> پست ها</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div>
                    <div class="row">
                        <div>عکس</div>
                        <div>موضوع</div>
                        <div>محتوا</div>
                        <div>برچسب ها</div>
                        <div>بازدید/نظر ها</div>
                        <div>دسته بندی</div>
                        <div>تاریخ</div>
                        <div><i class="fas fa-trash"></i></div>
                        <div><i class="fas fa-pen"></i></div>
                    </div>
                </div>
            </div>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> پیام ها</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div>
                    <div class="row">
                        <div>نام</div>
                        <div>ارتباط</div>
                        <div>موضوع</div>
                        <div>توضیحات</div>
                        <div>تاریخ</div>
                        <div>پیوست</div>
                        <div><i class="fas fa-trash"></i></div>
                        <div><i class="fas fa-pen"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.querySelectorAll(".listBtn>.btn").forEach(el => {
        el.addEventListener("click", (e) => {
            e.stopPropagation();
            var btn = e.target;
            while (!btn.classList.contains("listBtn")) btn = btn.parentNode;
            if (parseInt(btn.lastElementChild.getBoundingClientRect().height) == 0) {
                btn.querySelector("div.btn>div").style.transform = "rotate(0deg)";
                btn.lastElementChild.style.maxHeight = "50vh";
            } else {
                btn.querySelector("div.btn>div").style.transform = "rotate(-90deg)";
                btn.lastElementChild.style.maxHeight = 0;
            }
        });
    });
</script>