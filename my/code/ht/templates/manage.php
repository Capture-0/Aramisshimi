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
<<<<<<< HEAD
                    <h3><span>0</span> سفارشات</h3>
=======
                    <h3>سفارشات</h3>
>>>>>>> 715a8ae8fc9daaf9b3a83e4447d0198994ca0892
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
<<<<<<< HEAD
                    <h3><span>0</span> پست ها</h3>
=======
                    <h3>پست ها</h3>
>>>>>>> 715a8ae8fc9daaf9b3a83e4447d0198994ca0892
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
<<<<<<< HEAD
                    <h3><span>0</span> پیام ها</h3>
=======
                    <h3>پیام ها</h3>
>>>>>>> 715a8ae8fc9daaf9b3a83e4447d0198994ca0892
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
            <div class="extraData" data-action="server">
                <h3>جدول ها</h3>
                <div class="lists">
                    <div class="users">
                        <h4>کاربران</h4>
                        <div class="list">
                            <div class="row">
                                <div>نام</div>
                                <div>شماره</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>شماره</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>شماره</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                        </div>
                        <div class="manage">
                            <h5>ارسال پیام</h5>
                            <div>
                                <input type="text">
                                <button>ok</button>
                            </div>
                        </div>
                    </div>
                    <div class="comments">
                        <h4>کامنت ها</h4>
                        <div class="list" data-sect="comments">
                            <div class="row" data-identity="2">
                                <div>کاربر</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"><i class="fas fa-trash"></i></div>
                                <div data-op="edit"><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div>کاربر</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div>کاربر</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                        </div>
                        <div class="manage">
                            <h5>پاسخ</h5>
                            <div>
                                <input type="text">
                                <button>ok</button>
                            </div>
                        </div>
                    </div>
                    <div class="categories">
                        <h4>برچسب ها</h4>
                        <div class="list">
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                                <div><i class="fas fa-trash"></i></div>
                                <div><i class="fas fa-pen"></i></div>
                            </div>
                        </div>
                        <div class="manage">
                            <h5>اضافه کردن</h5>
                            <div>
                                <input type="text">
                                <button>ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="posts">

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
    window.globalThis.pageLoad.push(function() {
        document.querySelectorAll("[data-action=server] [data-op=delete]").forEach(el => {
            el.addEventListener("click", async function(e) {
                var t = e.target;
                // if(!t.dataset.contains("op")){
                //     t=t.parentNode;
                // }
                my = 
                console.log(t);
            });
        });
    });
</script>