<?php
if ($_SESSION["role"] != "admin") header("location:/");
function wc($input, $seprator = "\s+")
{
    return count(preg_split("/$seprator/", $input, -1, PREG_SPLIT_NO_EMPTY));
}
function bwn($input, $start, $end)
{
    return $input >= $start && $input <= $end;
}
$_PF = array("s" => isset($_POST["post_submit"]), "r" => isset($_POST["post_submit"]));
if ($_PF["s"]) {
    $t = array("c" => $_POST["title"], "s" => 3, "e" => 10, "n" => wc($_POST["title"]));
    $s = array("c" => $_POST["subject"], "s" => 20, "e" => 50, "n" => wc($_POST["subject"]));
    $c = array("c" => $_POST["postDesc"], "s" => 300, "e" => 99999, "n" => wc(strip_tags($_POST["postDesc"])));
    $a = $_POST["archive"];
    $tg = array("c" => $_POST["tags"], "s" => 6, "e" => 10, "n" => wc($_POST["tags"], ","));
    $i = $_FILES["image"]; // name type tmp_name error size
    $_FORM = array();
    $erar = array();
    if (bwn($t["n"], $t["s"], $t["e"]) && bwn($s["n"], $s["s"], $s["e"]) && bwn($c["n"], $c["s"], $c["e"]) && bwn($tg["n"], $tg["s"], $tg["e"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
        $_FORM["result"] = "success";
        if (!bwn($t["n"], 4, 10)) $erar[] = "عنوان بین 4 تا 10 کلمه (" . $t["n"] . ")";
        if (!bwn($s["n"], 30, 50)) $erar[] = "موضوع بین 30 تا 50 کلمه (" . $s["n"] . ")";
        if (!bwn($c["n"], 400, 99999)) $erar[] = "محتوای بیش از 400 کلمه (" . $c["n"] . ")";
        if (!bwn($tg["n"], 8, 10)) $erar[] = "برچسب بین 8 تا 10 عدد (" . $tg["n"] . ")";
        if (count($erar) > 0) {
            $_FORM["result"] = "info";
            array_splice($erar, 0, 0, "موارد زیر برای seo وبسایت اهمیت دارد.");
        }
        try {
            // file settings
            $_F = array(
                "str" => "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                "rand" => "", "len" => 32, "ext" => strtolower(pathinfo(basename($i["name"]), PATHINFO_EXTENSION)), "i" => $_FILES["image"], "lim" => 20
            );
            // create random name for the image
            for ($i = 0; $i < $_F["len"]; $i++) $_F["rand"] .= $_F["str"][rand(0, strlen($_F["str"]) - 1)];
            $_F["rand"] = url("i/posts/files/thumbnails/" . $_F["rand"] . "." . $_F["ext"]);
            while (file_exists($_F["rand"])) {
                $_F["rand"] = "";
                for ($i = 0; $i < $_F["len"]; $i++) $_F["rand"] .= $_F["str"][rand(0, strlen($_F["str"]) - 1)];
                $_F["rand"] = url("i/posts/files/thumbnails/" . $_F["rand"] . "." . $_F["ext"]);
            }
            // check whether file has certain conditions
            if (
                in_array($_F["ext"], explode(",", "jpg,jpeg,png,gif,apng,avif,jfif,pjpeg,pjp,svg,webp")) == 1 &&
                getimagesize($_F["i"]["tmp_name"]) && $_F["i"]["size"] < $_F["lim"] * 1024 * 1024
            ) {
                // check whether file has been uploaded and inputs inserted to database
                if (move_uploaded_file($_F["i"]["tmp_name"], $_F["rand"])) {
                    $insertedPostId = cnf_db_insert("INSERT INTO posts (title, `subject`, `image`, content, archive) VALUES (?,?,?,?,?)", [$t["c"], $s["c"], basename($_F["rand"]), $c["c"], $a]);
                    $tagsArray = array();
                    foreach (explode(",", $tg["c"]) as $item) {
                        $inTable = cnf_db_select("select * from tags where name= ?", [$item]);
                        if (count($inTable) == 0) {
                            $insertedId = cnf_db_insert("INSERT INTO tags (`name`) VALUES (?)", [$item]);
                            $tagsArray[] = $insertedId;
                        } else {
                            $tagsArray[] = $inTable[0]["id"];
                        }
                    }
                    foreach ($tagsArray as $item) {
                        cnf_db_insert("INSERT INTO pivot (relation, object1, object2) VALUES (?,?,?)", ["post_tag", $insertedPostId, $item]);
                    }
                    $_PF["r"] = false;
                    $_FORM["message"] = "پست با موفقیت منتشر شد.";
                } else throw new Exception();
            } else throw new Exception();
        } catch (Exception $e) {
            $_FORM["result"] = "error";
            $_FORM["message"] = "پست منتشر نشد.";
            $erar[] = "لطفا موارد زیر را رعایت کنید.";
            $erar[] = "نوع فایل عکس باشد (jpg,jpeg,png,gif,svg,webp,...)";
            $erar[] = "حجم فایل زیر 20 مگابایت باشد";
        }
    } else {
        $_FORM["result"] = "warning";
        $_FORM["message"] = "لطفا موارد زیر را به درستی وارد نمایید.";
        if (!bwn($t["n"], $t["s"], $t["e"])) $erar[] = "عنوان بین " . $t["s"] . " تا " . $t["e"] . " کلمه" . " (" . $t["n"] . ")";
        if (!bwn($s["n"], $s["s"], $s["e"])) $erar[] = "موضوع بین " . $s["s"] . " تا " . $s["e"] . " کلمه" . " (" . $s["n"] . ")";
        if (!bwn($c["n"], $c["s"], $c["e"])) $erar[] = "محتوای بیش از " . $c["s"] . " کلمه" . " (" . $c["n"] . ")";
        if (!bwn($tg["n"], $tg["s"], $tg["e"])) $erar[] = "برچسب بین " . $tg["s"] . " تا " . $tg["e"] . " عدد" . " (" . $tg["n"] . ")";
        if (!is_uploaded_file($_FILES["image"]["tmp_name"])) $erar[] = "اپلود عکس";
    }
    if (count($erar) > 1) {
        array_splice($erar, 0, 0, "<br>");
        $_FORM["message"] .= implode("<br />", $erar);
    }
}
$_PAGE = array(
    "title" => "ارامیس شیمی - مدیریت", // 70 chars limit
    "description" => "modiriyate website", // 160 chars limit
    "keywords" => "manage,aramis,shimi", // less than 10 phrases recommended
    "name" => $currentPage,
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
                        <div>تاریخ</div>
                        <div>پیوست</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>
                    <?php
                    foreach (cnf_db_select("select * from orders order by id desc") as $i) {
                        echo '<div class="row" data-identity="' . $i["id"] . '">
                        <div>' . $i["first_name"] . ' ' . $i["last_name"] . '</div>
                        <div>' . $i["mobile"] . '</div>
                        <div>' . $i["address"] . '</div>
                        <div>' . $i["content"] . '</div>
                        <div>' . cnf_misc_create_date($i["datetime"], "EEEE d MMMM y | H:m") . '</div>
                        <div>' . (strlen($i["attachment"]) < 10 ? "ندارد" : "دارد") . '</div>
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
                        <div>نظر ها/بازدید</div>
                        <div>دسته بندی</div>
                        <div>تاریخ</div>
                        <div data-op="delete"></div>
                        <div data-op="edit"></div>
                    </div>
                    <?php
                    foreach (cnf_db_select("select * from posts order by id desc") as $i) {
                        $tmptg = array();
                        foreach (cnf_db_select("select * from pivot where relation = 'post_tag' and object1 = " . $i["id"]) as $j) {
                            $tmptg[] = $j["object2"];
                        }
                        $tmpres = array();
                        foreach (cnf_db_select("SELECT * FROM tags WHERE id IN (" . implode(",", $tmptg) . ")") as $j) {
                            $tmpres[] = $j["name"];
                        }

                        echo '<div class="row" data-identity="' . $i["id"] . '">
                        <div><img data-src="posts/files/thumbnails/' . $i["image"] . '" src="">' . $i["title"] . '</div>
                        <div>' . $i["subject"] . '</div>
                        <div>' . strip_tags($i["content"]) . '</div>
                        <div>' . implode(", ", $tmpres) . '</div>
                        <div>' . cnf_db_select("SELECT COUNT(*) AS res FROM pivot WHERE relation = 'post_view' AND object1 = '" . $i["id"] . "'")[0]["res"] . '/' . cnf_db_select("select count(id) as res from comments where post = " . $i["id"])[0]["res"] . '</div>
                        <div>' . cnf_db_select("SELECT * FROM archives WHERE id = " . $i["archive"])[0]["name"] . '</div>
                        <div>' . cnf_misc_create_date($i["datetime"], "EEEE d MMMM y | H:m") . '</div>
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
                    foreach (cnf_db_select("select * from messages order by id desc") as $i) {
                        echo '<div class="row" data-identity="' . $i["id"] . '">
                        <div>' . $i["fullname"] . '</div>
                        <div>' . $i["mobile"] . '</div>
                        <div>' . $i["subject"] . '</div>
                        <div>' . $i["content"] . '</div>
                        <div>' . cnf_misc_create_date($i["datetime"], "EEEE d MMMM y | H:m") . '</div>
                        <div>' . (strlen($i["attachment"]) < 10 ? "ندارد" : "دارد") . '</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="extraData" data-action="server">
                <h3 class="btn">جدول ها <i class="fas fa-caret-down"></i></h3>
                <div class="lists">
                    <div>
                        <h4>کامنت ها</h4>
                        <div class="list" data-sect="comments">
                            <div class="row">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>پست</div>
                                <div>ایمیل</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <?php
                            foreach (cnf_db_select("select * from comments order by id desc") as $i) {
                                echo '<div class="row" data-identity="' . $i["id"] . '">
                                    <div>' . $i["fullname"] . '</div>
                                    <div>' . $i["content"] . '</div>
                                    <div>' . cnf_db_select("select title from posts where id = " . $i["post"])[0]["title"] . '</div>
                                    <div>' . $i["email"] . '</div>
                                    <div>' . cnf_misc_create_date($i["datetime"], "d MMMM y | H:m") . '</div>
                                    <div data-op="delete"></div>
                                    <div data-op="edit"></div>
                                    </div>';
                            }
                            ?>
                        </div>
                        <div class="manage">
                            <h5>پاسخ</h5>
                            <div>
                                جواب
                                <input type="text">
                            </div>
                            <button id="answerComment">ok</button>
                        </div>
                    </div>
                    <div>
                        <h4>دسته بندی ها</h4>
                        <div class="list" data-sect="archives">
                            <div class="row">
                                <div>نام</div>
                                <div>زیرمجموعه ها</div>
                                <div>اولویت</div>
                                <div>قابل نمایش</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <?php
                            foreach (cnf_db_select("select * from archives order by id desc") as $i) {
                                echo '<div class="row" data-identity="' . $i["id"] . '">
                                    <div>' . $i["name"] . '</div>
                                    <div>' . cnf_db_select("select count(id) as res from posts where archive = " . $i["id"])[0]["res"] . '</div>
                                    <div>' . ($i["priority"] == 0 ? "کم" : ($i["priority"] == 1 ? "متوسط" : "زیاد")) . '</div>
                                    <div>' . ($i["show"] == 0 ? "خیر" : "بله") . '</div>
                                    <div data-op="delete"></div>
                                    <div data-op="edit"></div>
                                    </div>';
                            }
                            ?>
                        </div>
                        <div class="manage">
                            <h5>اضافه کردن</h5>
                            <div>
                                نام
                                <input type="text" id="f_name">
                            </div>
                            <div>
                                اولویت
                                <select id="f_priority">
                                    <option value="2">زیاد</option>
                                    <option value="1">متوسط</option>
                                    <option value="0">کم</option>
                                </select>
                            </div>
                            <div>
                                قابل نمایش
                                <input type="checkbox" checked="true" id="f_show">
                            </div>
                            <button id="archiveAdd">ok</button>
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
                            foreach (cnf_db_select("select * from tags order by id desc") as $i) {
                                echo '<div class="row" data-identity="' . $i["id"] . '">
                                    <div>' . $i["name"] . '</div>
                                    <div>' . cnf_db_select("select count(*) as res from pivot where relation = 'post_tag' and object2 = " . $i["id"])[0]["res"] . '</div>
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
                            <?php
                            foreach (cnf_db_select("select * from archives order by id desc") as $item) {
                                echo '<option value="' . $item["id"] . '">' . $item["name"] . '</option>';
                            }
                            ?>
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