<?php
$_FORM["result"] = "none";
$_FORM["message"] = "";
if (isset($_POST["post_submit"])) {
    $t = $_POST["title"];
    $s = $_POST["subject"];
    $c = $_POST["postDesc"];
    $a = $_POST["archive"];
    $tg = $_POST["tags"];
    $i = $_FILES["image"]; // name type tmp_name error size
    $_FORM = array();
    $erar = array();
    if (m("...+", $t) && m("(\S+\s+){10,}\S+", $s) && m("(\S+\s+){200,}\S+", strip_tags($c)) && (count(explode(",", $tg)) > 4 && count(explode(",", $tg)) < 11) && count($_FILES) > 0) {
        $_FORM["result"] = "info";
        $_FORM["message"] = "موارد زیر برای seo وبسایت اهمیت دارد.";
        if (m("(\S+\s+){,2}\S+", $t)) $erar[] = "عنوان بین 4 تا 10 کلمه";
        if (m("(\S+\s+){,28}\S+", $s)) $erar[] = "موضوع بین 30 تا 50 کلمه";
        if (m("(\S+\s+){,298}\S+", strip_tags($c))) $erar[] = "محتوای ";
        if (count(explode(",", $tg)) < 8 || count(explode(",", $tg)) > 10) $erar[] = "";
        // try {
        //     cnf_db_insert("INSERT INTO orders (first_name, last_name, email, mobile, [address], content) VALUES (?,?,?,?,?,?)", [$f, $l, $e, $m, $a, $o]);
        // } catch (Exception $e) {
        //     $_FORM["result"] = "error";
        //     $_FORM["message"] = "سفارش شما ثبت نشد.";
        // }
        $_FORM["message"] .= implode("<br />", $erar);
    } else {
        $_FORM["result"] = "warning";
        $_FORM["message"] = "لطفا موارد زیر را به درستی وارد نمایید.<br />";
        if (!m("..+", $f)) $erar[] = "نام";
        if (!m("..+", $l)) $erar[] = "نام خانوادگی";
        if (!m("(\+)?[\d\s]+", $m)) $erar[] = "شماره موبایل";
        if (!m("....+", $a) && !empty($a)) $erar[] = "ادرس";
        if (!m("[\w\.\-]+@[\w\.\-]+\.[\w\.\-]+", $e) && !empty($e)) $erar[] = "ایمیل";
        if (!m("....+", $o)) $erar[] = "شرح سفارش";
        $_FORM["message"] .= implode("<br />", $erar);
    }
}
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
                    <div class="row">
                        <div>نام</div>
                        <div>شماره</div>
                        <div>ادرس</div>
                        <div>توضیحات</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>
                    <?php
                    foreach (cnf_db_select("select * from orders") as $i) {
                        echo '<div class="row" data-identity="' . $i["id"] . '">
                        <div>' . $i["first_name"] . ' ' . $i["last_name"] . '</div>
                        <div>' . $i["mobile"] . '</div>
                        <div>' . $i["address"] . '</div>
                        <div>' . $i["content"] . '</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>';
                    }
                    ?>
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
                    <?php
                    foreach (cnf_db_select("select * from posts") as $i) {
                        echo '<div class="row" data-identity="' . $i["id"] . '">
                        <div>' . $i["image"] . '</div>
                        <div>' . $i["subject"] . '</div>
                        <div>' . $i["content"] . '</div>
                        <div>tags, ad, dawd, awd</div>
                        <div>234,43</div>
                        <div>fluid</div>
                        <div>' . $i["datetime"] . '</div>
                        <div data-op="delete"></div>
                        <div data-op="edit"></div>
                    </div>';
                    }
                    ?>
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
                        <div>شماره موبایل</div>
                        <div>موضوع</div>
                        <div>توضیحات</div>
                        <div>تاریخ</div>
                        <div>پیوست</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>
                    <?php
                    foreach (cnf_db_select("select * from messages") as $i) {
                        echo '<div class="row" data-identity="' . $i["id"] . '">
                        <div>' . $i["fullname"] . '</div>
                        <div>' . $i["mobile"] . '</div>
                        <div>' . $i["subject"] . '</div>
                        <div>' . $i["content"] . '</div>
                        <div>' . $i["datetime"] . '</div>
                        <div>' . ($i["attachment"] == 0 ? "ندارد" : "دارد") . '</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="extraData" data-action="server">
                <h3>جدول ها</h3>
                <div class="lists">
                    <div>
                        <h4>کامنت ها</h4>
                        <div class="list" data-sect="comments">
                            <div class="row">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>ایمیل</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <?php
                            foreach (cnf_db_select("select * from comments") as $i) {
                                echo '<div class="row" data-identity="' . $i["id"] . '">
                                    <div>' . $i["fullname"] . '</div>
                                    <div>' . $i["content"] . '</div>
                                    <div>' . $i["email"] . '</div>
                                    <div>' . $i["datetime"] . '</div>
                                    <div data-op="delete"></div>
                                    <div data-op="edit"></div>
                                    </div>';
                            }
                            ?>
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
                            <?php
                            foreach (cnf_db_select("select * from archives") as $i) {
                                echo '<div class="row" data-identity="' . $i["id"] . '">
                                    <div>' . $i["name"] . '</div>
                                    <div>38</div>
                                    <div data-op="delete"></div>
                                    <div data-op="edit"></div>
                                    </div>';
                            }
                            ?>
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
                            <?php
                            foreach (cnf_db_select("select * from tags") as $i) {
                                echo '<div class="row" data-identity="' . $i["id"] . '">
                                    <div>' . $i["name"] . '</div>
                                    <div>51</div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="posts">
                <h3>نوشتن پست جدید</h3>
                <form method="POST" class="compose" enctype="multipart/form-data">
                    <div>
                        <span>عنوان</span>
                        <input name="title" type="text" />
                    </div>
                    <div>
                        <span>موضوع</span>
                        <input name="subject" type="text" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>متن پست</span>
                        <textarea name="postDesc" contenteditable="true"></textarea>
                    </div>
                    <div>
                        <span>دسته بندی</span>
                        <select name="archive">
                            <option value="1">powder</option>
                            <option value="3">fluid</option>
                            <option value="2">machine</option>
                        </select>
                    </div>
                    <div id="tags">
                        <span>برچسب ها</span>
                        <input onfocus="tagInputFocused = true;" onblur="tagInputFocused = false;" type="text">
                        <input type="hidden" id="tagsArray" name="tags" />
                        <div></div>
                    </div>
                    <div>
                        <span>عکس</span>
                        <input name="image" type="file" />
                    </div>
                    <button style="grid-column: 1 / -1;" type="submit" name="post_submit">ثبت</button>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="my/code/plugin/ckeditor/ckeditor.js"></script>
<script src="my/code/plugin/ckfinder/ckfinder.js"></script>
<script src="my/code/ht/js/manage.js"></script>