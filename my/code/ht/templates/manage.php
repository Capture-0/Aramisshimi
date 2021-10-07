<?php
function wc($input, $seprator = "\s+")
{
    return count(preg_split("/$seprator/", $input, -1, PREG_SPLIT_NO_EMPTY));
}
function bwn($input, $start, $end)
{
    return $input >= $start && $input <= $end;
}
$_FORM["result"] = "none";
$_FORM["message"] = "";
$_PF = array("s" => isset($_POST["post_submit"]), "r" => true);
if ($s_p) {
    $t = array("c" => $_POST["title"], "s" => 3, "e" => 10, "n" => wc($_POST["title"]));
    $s = array("c" => $_POST["subject"], "s" => 20, "e" => 50, "n" => wc($_POST["subject"]));
    $c = array("c" => $_POST["postDesc"], "s" => 300, "e" => 99999, "n" => wc(strip_tags($_POST["postDesc"])));
    $a = $_POST["archive"];
    $tg = array("c" => $_POST["tags"], "s" => 6, "e" => 10, "n" => wc($_POST["tags"], ","));
    $i = $_FILES["image"]; // name type tmp_name error size
    $_FORM = array();
    $erar = array();
    if (bwn($t["n"], $t["s"], $t["e"]) && bwn($s["n"], $s["s"], $s["e"]) && bwn($c["n"], $c["s"], $c["e"]) && bwn($tg["n"], $tg["s"], $tg["e"]) && $i["error"] == 0 || 1 == 1) {
        $_FORM["result"] = "success";
        $_FORM["message"] = "پست با موفقیت منتشر شد.";
        if (!bwn($t["n"], 4, 10)) $erar[] = "عنوان بین 4 تا 10 کلمه (" . $t["n"] . ")";
        if (!bwn($s["n"], 30, 50)) $erar[] = "موضوع بین 30 تا 50 کلمه (" . $s["n"] . ")";
        if (!bwn($c["n"], 400, 99999)) $erar[] = "محتوای بیش از 400 کلمه (" . $c["n"] . ")";
        if (!bwn($tg["n"], 8, 10)) $erar[] = "برچسب بین 8 تا 10 عدد (" . $tg["n"] . ")";
        if (count($erar) > 0) {
            $_FORM["result"] = "info";
            array_splice($erar, 0, 0, "موارد زیر برای seo وبسایت اهمیت دارد.");
            array_splice($erar, 0, 0, "<br>");
        }
        // try {

        //     cnf_db_insert("INSERT INTO posts () VALUES (?,?,?,?,?,?)", [$f, $l, $e, $m, $a, $o]);
        //     $_PF["r"] = false;
        // } catch (Exception $e) {
        //     $_FORM["result"] = "error";
        //     $_FORM["message"] = "سفارش شما ثبت نشد.";
        // }
    } else {
        $_FORM["result"] = "warning";
        $_FORM["message"] = "لطفا موارد زیر را به درستی وارد نمایید.";
        $erar[] = "<br />";
        if (!bwn($t["n"], $t["s"], $t["e"])) $erar[] = "عنوان بین " . $t["s"] . " تا " . $t["e"] . " کلمه" . " (" . $t["n"] . ")";
        if (!bwn($s["n"], $s["s"], $s["e"])) $erar[] = "موضوع بین " . $s["s"] . " تا " . $s["e"] . " کلمه" . " (" . $s["n"] . ")";
        if (!bwn($c["n"], $c["s"], $c["e"])) $erar[] = "محتوای بیش از " . $c["s"] . " کلمه" . " (" . $c["n"] . ")";
        if (!bwn($tg["n"], $tg["s"], $tg["e"])) $erar[] = "برچسب بین " . $tg["s"] . " تا " . $tg["e"] . " عدد" . " (" . $tg["n"] . ")";
        if ($i["error"] != 0) $erar[] = "اپلود عکس";
    }
    if (count($erar) > 1) {
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
                    <div class="flash" data-type="<?php echo $_FORM["message"] == "" ? "none" : $_FORM["result"];  ?>">
                        <?php
                        echo $_FORM["message"];
                        ?>
                    </div>
                    <div>
                        <span>عنوان</span>
                        <input name="title" type="text" value="<?php if ($_PF["r"]) echo $_POST["title"]; ?>" />
                    </div>
                    <div>
                        <span>دسته بندی</span>
                        <select name="archive">
                            <option value="1">powder</option>
                            <option value="3">fluid</option>
                            <option value="2">machine</option>
                        </select>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>موضوع</span>
                        <input name="subject" type="text" value="<?php if ($_PF["r"]) echo $_POST["subject"]; ?>" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>متن پست</span>
                        <textarea name="postDesc" contenteditable="true"><?php if ($_PF["r"]) echo $_POST["postDesc"]; ?></textarea>
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