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
        <div class="container" data-action="server">
            <h2>صفحه مدیریت</h2>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> سفارشات</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div data-sect="orders">
                    <div class="row" data-identity="2">
                        <div>نام</div>
                        <div>شماره</div>
                        <div>ادرس</div>
                        <div>توضیحات</div>
                        <div data-op="delete"></div>
                        <div data-op="edit"></div>
                    </div>
                </div>
            </div>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> پست ها</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div data-sect="posts">
                    <div class="row">
                        <div>عکس</div>
                        <div>موضوع</div>
                        <div>محتوا</div>
                        <div>برچسب ها</div>
                        <div>بازدید/نظر ها</div>
                        <div>دسته بندی</div>
                        <div>تاریخ</div>
                        <div data-op="delete"></div>
                        <div data-op="edit"></div>
                    </div>
                </div>
            </div>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> پیام ها</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div data-sect="messages">
                    <div class="row">
                        <div>نام</div>
                        <div>ارتباط</div>
                        <div>موضوع</div>
                        <div>توضیحات</div>
                        <div>تاریخ</div>
                        <div>پیوست</div>
                        <div data-op="delete"></div>
                        <div data-op="edit"></div>
                    </div>
                </div>
            </div>
            <div class="extraData" data-action="server">
                <h3>جدول ها</h3>
                <div class="lists">
                    <div class="users">
                        <h4>کاربران</h4>
                        <div class="list" data-sect="users">
                            <div class="row">
                                <div>نام</div>
                                <div>شماره</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>شماره</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>شماره</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
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
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>کاربر</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>کاربر</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
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
                    <div class="tags">
                        <h4>برچسب ها</h4>
                        <div class="list" data-sect="tags">
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
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
                    <div class="archives">
                        <h4>دسته بندی ها</h4>
                        <div class="list" data-sect="archives">
                            <div class="row">
                                <div>نام</div>
                                <div>زیرمجموعه ها</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>زیرمجموعه ها</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
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
    window.globalThis.pageLoad.push(function() {
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
        document.querySelectorAll("[data-action=server] [data-op]").forEach(el => {
            var t = el;
            if (!t.hasAttribute("data-op")) t = t.parentNode;
            if (t.dataset.op == "delete") t.innerHTML = '<i class="fas fa-trash"></i>';
            else if (t.dataset.op == "edit") t.innerHTML = '<i class="fas fa-pen"></i>';
            el.addEventListener("click", function(e) {
                var t = e.target;
                if (!t.hasAttribute("data-op")) t = t.parentNode;
                var sect = t.parentNode.parentNode.dataset.sect;
                var msg = "";
                switch (sect) {
                    case "orders":
                        msg = "سفارش";
                        break;
                    case "posts":
                        msg = "پست";
                        break;
                    case "messages":
                        msg = "پیام";
                        break;
                    case "users":
                        msg = "کاربر";
                        break;
                    case "comments":
                        msg = "کامنت";
                        break;
                    case "tags":
                        msg = "برچسب";
                        break;
                    case "archives":
                        msg = "دسته بندی";
                        break;
                    default:
                        msg = "مورد";
                        break;
                }
                if (confirm("ایا از حذف این " + msg + " اطمینان دارید؟")) alert("a=db&o=" + t.dataset.op + "&i=" + t.parentNode.dataset.identity + "&s=" + sect);
            });
        });
    });
</script>