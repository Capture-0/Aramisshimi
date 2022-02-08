<?php
// sort by name, newest and price

?>
<div id="list" class="container">
    <section>
        <div id="bar">
            مرتب سازی بر اساس:
            <ul>
                <li>اسم</li>
                <li>قیمت</li>
                <li>جدید ترین</li>
            </ul>
            نمایش:
            <ul>
                <li onclick="document.querySelector('#list #items').setAttribute('class','grid')">جدول</li>
                <li onclick="document.querySelector('#list #items').setAttribute('class','row')">لیست</li>
            </ul>
        </div>
        <div id="items" class="row">
        </div>
        <template item-template>
            <a href="">
                <div><img src="documentary/image04.jpg" alt=""></div>
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
        <div class="hr"></div>
        <h3>جدید ترین محصولات</h3>
        <div class="cont">
            <?php
            foreach (cnf_db_select("SELECT * FROM products ORDER BY id DESC LIMIT 4") as $i) {
                echo '<a href="">
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
    window.globalThis.pageLoad.push(function() {});
    loadList();

    async function loadList(search = "", category = "0", orderby = "newest", desc = false) {
        items = JSON.parse(await ajax("store=" + (search != "" ? search : "null") + "&c=" + category + "&ob=" + orderby + "&desc=" + (desc ? "true" : "false")));
        items.forEach(i => {
            a = document.querySelector("[item-template]").content.cloneNode(true).children[0];
            a.firstElementChild.firstElementChild.setAttribute("src", "/my/media/img/posts/files/products/" + i.image);
            a.querySelector("h4").textContent = i.name;
            a.querySelector("span").textContent = String(i.price).replace(/(.)(?=(\d{3})+$)/g, '$1,') + " تومان";
            a.querySelector("button").dataset.product = i.id;
            document.querySelector("#list > section > #items").appendChild(a);
        });
    }
</script>