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
                        <div data-op="inspect"></div>
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
                        <div data-op="inspect"></div>
                    </div>
                </div>
            </div>
            <div class="extraData" data-action="server">
                <h3>جدول ها</h3>
                <div class="lists">
                    <div>
                        <h4>کامنت ها</h4>
                        <div class="list" data-sect="comments">
                            <div class="row" data-identity="2">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
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
                    <div>
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
                    <div>
                        <h4>برچسب ها</h4>
                        <div class="list" data-sect="tags">
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="posts">
                <h3>نوشتن پست جدید</h3>
                <form method="POST" class="compose">
                    <div>
                        <span>عنوان</span>
                        <input type="text" />
                    </div>
                    <div>
                        <span>موضوع</span>
                        <input type="text" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>متن پست</span>
                        <textarea name="postDesc" contenteditable="true"></textarea>
                    </div>
                    <div>
                        <span>دسته بندی</span>
                        <select name="archive" id="">
                            <option value="powder">powder</option>
                            <option value="fluid">fluid</option>
                            <option value="machine">machine</option>
                        </select>
                    </div>
                    <div id="tags">
                        <span>برچسب ها</span>
                        <input onfocus="tagInputFocused = true;" onblur="tagInputFocused = false;" type="text">
                        <div></div>
                    </div>
                    <div>
                        <span>عکس</span>
                        <input type="file" />
                    </div>
                    <button style="grid-column: 1 / -1;" type="submit" name="submit">ثبت</button>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="my/code/plugin/ckeditor/ckeditor.js"></script>
<script src="my/code/plugin/ckfinder/ckfinder.js"></script>
<script>
    var tagInputFocused = false;
    var tags = [];

    CKEDITOR.replace("postDesc", {
        filebrowserBrowseUrl: "/my/code/plugin/my/ckeditor_browser.php",
        filebrowserUploadUrl: "/my/code/plugin/my/ckeditor_upload.php",
        filebrowserUploadMethod: "form"
    });
    CKEDITOR.config.toolbarGroups = [{
            groups: ['basicstyles', 'indent', 'clipboard', 'undo']
        }, '/',
        {
            groups: ['insert', 'links', 'list', 'bidi']
        }, '/',
        {
            groups: ['tools', 'document', 'mode', 'styles']
        }
    ];

    CKEDITOR.config.removeButtons = 'Italic,Strike,Subscript,Cut,Paste,Redo,NumberedList,Anchor,Unlink';

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
            else if (t.dataset.op == "inspect") t.innerHTML = '<i class="fas fa-eye"></i>';
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

        var form = document.querySelector("#manage .posts form").addEventListener("submit", function(event) {
            if (tagInputFocused) {
                event.preventDefault();
                var tagInput = document.querySelector("#manage .posts .compose #tags input");
                if (tagInput.value == "" || tags.includes(tagInput.value)) return false;
                var div = document.createElement("div");
                var i = document.createElement("i");
                i.classList.add("fas");
                i.classList.add("fa-times");
                i.addEventListener("click", function(e) {
                    var input = e.target.parentNode.innerText;
                    if (tags.indexOf(input.substring(0, input.length - 1)) > -1) tags.splice(tags.indexOf(input.substring(0, input.length - 1)), 1);
                    e.target.parentNode.style.display = "none";
                });
                tags.push(tagInput.value);
                div.append(tagInput.value + " ");
                div.appendChild(i);
                tagInput.value = "";
                document.querySelector("#manage .posts .compose #tags > div").appendChild(div);
            } else if (!confirm("ایا از انتشار این مقاله اطمینان دارید؟")) event.preventDefault();
        });
    });

    function cw(val) {
        console.log(val);
    }
</script>