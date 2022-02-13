<?php
// sort by name, newest and price
$_PAGE = array(
    "title" => "آرامیس شیمی - فروشگاه", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "store,aramis,shimi", // less than 10 phrases recommended
    "name" => $currentPage,
    "styles" => "store,etc/store_list"
);
cnf_page_create($_PAGE);
?>
<div id="loading">
    <div>
        <div></div>
        <span>در حال بارگیری ...</span>
    </div>
</div>
<div id="list" class="container">
    <section>
        <div id="bar">
            مرتب سازی بر اساس:
            <ul>
                <li onclick="loadList('o','name')">اسم</li>
                <li onclick="loadList('o','price')">قیمت</li>
                <li onclick="loadList('o','newest')">جدید ترین</li>
            </ul>
            نمایش:
            <ul>
                <li onclick="document.querySelector('#list #items').setAttribute('class','grid')">جدول</li>
                <li onclick="document.querySelector('#list #items').setAttribute('class','row')">لیست</li>
            </ul>
            پاک کردن فیلتر ها:
            <ul>
                <li onclick="loadList('s',null)">جستجو</li>
                <li onclick="loadList('c',null)">دسته بندی</li>
            </ul>
        </div>
        <div id="items" class="row">
        </div>
        <template item-template>
            <a href="">
                <div><img alt=""></div>
                <h4>
                </h4>
                <span></span>
                <button class="addToCart" data-product="">+ سبد</button>
            </a>
        </template>
    </section>
    <aside>
        <div>
            <h3>دسته بندی ها</h3>
        </div>
        <?php
        foreach (cnf_db_select("SELECT * FROM product_archives ORDER BY id DESC") as $i) {
            echo '<a data-add-category="' . $i["id"] . '" href="/Store/s?c=' . $i["id"] . '">' . $i["name"] . '</a>';
        }
        ?>
        <div class="hr"></div>
        <h3>جدید ترین محصولات</h3>
        <div class="cont">
            <?php
            foreach (cnf_db_select("SELECT * FROM products ORDER BY id DESC LIMIT 4") as $i) {
                echo '<a href="/Store/' . $i["id"] . '">
                    <div><img src="/my/media/img/posts/files/products/' . $i["image"] . '" alt=""></div>
                    <h5>' . $i["name"] . '</h5>
                    <span>بیشتر</span>
                </a>';
            }
            ?>
        </div>
    </aside>
</div>
<script>
    let qs = new URLSearchParams(window.location.search);
    loadList(null);

    async function loadList(key = null, value = null) {
        showLoading();
        if (qs.get(key) == value) qs.set("d", qs.get("d") == null ? "1" : (qs.get("d") == "1" ? "0" : "1"));
        if (key != null) qs.set(key, value);
        search = qs.get("s") == null ? "" : qs.get("s");
        category = qs.get("c") == null ? "0" : qs.get("c");
        orderby = qs.get("o") == null ? "newest" : qs.get("o");
        desc = qs.get("d") == null ? false : (qs.get("d") == "1" ? true : false);
        items = JSON.parse(await ajax("store=" + (search != "" ? search : "null") + "&c=" + category + "&ob=" + orderby + "&desc=" + (desc ? "true" : "false")));
        document.querySelector("#list > section > #items").innerHTML = "";
        items.forEach(i => {
            a = document.querySelector("[item-template]").content.cloneNode(true).children[0];
            a.setAttribute("href", "/Store/" + i.id);
            a.firstElementChild.firstElementChild.setAttribute("src", "/my/media/img/posts/files/products/" + i.image);
            a.querySelector("h4").textContent = i.name;
            a.querySelector("span").textContent = String(i.price).replace(/(.)(?=(\d{3})+$)/g, '$1,') + " تومان";
            a.querySelector("button").dataset.product = i.id;
            document.querySelector("#list > section > #items").appendChild(a);
        });
        showLoading(false);
    }

    function showLoading(show = true) {
        let overlay = document.querySelector("#loading");
        if (show) {
            overlay.style.display = "flex";
            overlay.style.opacity = "1";
        } else {
            overlay.style.opacity = "0";
            setTimeout(() => {
                overlay.style.display = "none";
            }, 300);
        }
    }

    document.querySelectorAll("[data-add-category]").forEach(el => {
        el.addEventListener("click", function(e) {
            e.preventDefault();
            loadList("c", e.target.dataset.addCategory);
        });
    });
    document.querySelector("#storeBar #search input").addEventListener("keyup", function(e) {
        if (e.keyCode == 13) loadList("s", e.target.value);
    });
</script>