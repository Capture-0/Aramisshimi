<?php
$_PAGE = array(
    "title" => "post ha", // 70 chars limit
    "description" => "modiriyate website", // 160 chars limit
    "keywords" => "posts,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "posts"
);
$post = array("isPost" => count($_REQUEST) > 0 ? m("\d+", $_REQUEST["p1"]) : false);
if ($post["isPost"]) {
    $r = cnf_db_select("select * from posts where id = " . $_REQUEST["p1"]);
    if (count($r) == 0) header("location: /Posts");
    else $post["c"] = $r[0];
}
$_FORM["result"] = "none";
$_FORM["message"] = "";
if (isset($_POST["submit"])) {
    $p = array("n" => $_POST["name"], "e" => $_POST["email"], "c" => $_POST["content"]);
    if (!empty($p["n"]) && m("[\w\-\.]+@[\w\-\.]+\.[\w\-\.]+", $p["e"]) && !empty($p["c"])) {
        cnf_db_insert("INSERT INTO comments (fullname, email, content, post) VALUES (?,?,?,?)", [$p["n"], $p["e"], $p["c"], $post["c"]["id"]]);
        $_FORM["result"] = "success";
        $_FORM["message"] = "نظر شما با موفقیت ثبت شد.";
        $_FORM["message"] .= "<br />";
        $_FORM["message"] .= "پاسخ شما در صورت نیاز به شما از طریق ایمیل ارسال خواهد شد.";
    } else {
        $_FORM["result"] = "warning";
        $_FORM["message"] = "لطفا موارد را به درستی وارد کنید.";
    }
}
if (!$post["isPost"]) cnf_page_create($_PAGE);
?>
<main class="container">
    <h2>
        <?php
        if ($post["isPost"]) echo $post["c"]["title"];
        else echo "پست ها";
        ?>
    </h2>
    <?php
    if ($post["isPost"]) {
        $tmptg = array();
        foreach (cnf_db_select("select * from pivot where relation = 'post_tag' and object1 = " . $post["c"]["id"]) as $j) {
            $tmptg[] = $j["object2"];
        }
        $tmpres = array();
        foreach (cnf_db_select("SELECT * FROM tags WHERE id IN (" . implode(",", $tmptg) . ")") as $j) {
            $tmpres[] = $j["name"];
        }
        $post["tags"] = $tmpres;
        $tmp = "";
        foreach ($post["tags"] as $item) {
            $tmp .= "<div>$item</div>";
        }

        echo '<article>
        <p class="category">مقالات<i class="fas fa-chevron-left"></i>' . cnf_db_select("select name from archives where id = " . $post["c"]["archive"])[0]["name"] . '<i class="fas fa-chevron-left"></i>خط تولید صابون</p>
        <div class="info">
            <img data-src="posts/' . $post["c"]["image"] . '" src="" alt="">
            <h3>' . $post["c"]["subject"] . '</h3>
            <p><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>' . cnf_misc_create_date($post["c"]["datetime"], "EEEE d MMMM y")  . '</p>
        </div>
        <div class="content">' . $post["c"]["content"] . '</div>
        <div class="extra">
            <div class="tags">
            ' . $tmp . '
            </div>
            <div class="comments">
                <h3>ثبت نظر</h3>
                <form method="post">
                    <div class="flash" data-type="' . ($_FORM["message"] == "" ? "none" : $_FORM["result"]) . '">' . $_FORM["message"] . '</div>
                    <div>
                        <span>نام</span>
                        <input name="name" type="text" />
                    </div>
                    <div>
                        <span>ایمیل</span>
                        <input name="email" type="text" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>نظر</span>
                        <textarea name="content"></textarea>
                    </div>
                    <button style="grid-column: 1 / -1;" type="submit" name="submit">ثبت</button>
                </form>';
        foreach (cnf_db_select("select * from comments where post =" . $post["c"]["id"] . " order by id desc") as $i) {
            echo '<div class="comment">
                <div class="head">
                    <img src="' . cnf_misc_avatar(md5($i["email"])) . '" alt="">
                    <div>
                        <h4>' . $i["fullname"] . '</h4>
                        <span>' . cnf_misc_create_date($i["datetime"], "H:m EEEE d MMMM y")  . '</span>
                    </div>
                </div>
                <div class="hr"></div>
                <p>' . $i["content"] . '</p>
            </div>';
        }
        echo '</div>
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
        <?php
        foreach (cnf_db_select("select * from posts") as $i) {
            echo '<a href="/Posts/' . $i["id"] . '">
                <article>
                    <div><img data-src="posts/' . $i["image"] . '" src="" alt=""></div>
                    <div>
                        <h3>' . $i["title"] . '</h3>
                        <p class="info"><span><i class="fas fa-eye"></i></span>364<span><i class="fas fa-comment"></i></span>59<span><i class="far fa-calendar-alt"></i></span>' . cnf_misc_create_date($i["datetime"], "EEEE d MMMM y")  . '</p>
                        <p class="text">' . $i["subject"] . '</p>
                        <button class="dark">ادامه <i class="fas fa-arrow-left"></i></button>
                    </div>
                </article>
            </a>
            <div class="hr"></div>';
        }
        ?>
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
    if ($post["isPost"]) {
        echo 'document.querySelector("main > section").remove()';
    }
    ?>
</script>