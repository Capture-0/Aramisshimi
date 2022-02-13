<?php

?>
<article id="banner" class="container">
    <div id="featured"><img data-src="documentary/image13.jpg" alt="" /></div>
    <div id="offers"><img data-src="documentary/image05.jpg" alt="" /></div>
    <div id="limited"><img data-src="documentary/image55.jpg" alt="" /></div>
</article>
<?php
foreach (cnf_db_select("SELECT * FROM product_archives where show = 0 LIMIT 2") as $i) {
    echo '<section class="item-slide">
        <h2><span>' . $i["name"] . '</span><a href="/Store/s?c=' . $i["id"] . '">مشاهده همه <i class="fas fa-arrow-left"></i></a></h2>
        <div>
            <div id="items">';
    foreach (cnf_db_select("SELECT * FROM products where archive = " . $i["id"] . " order by id desc limit 8") as $j) {
        echo '<div><a href="/Store/' . $j["id"] . '">
                <div>
                    <img src="/my/media/img/posts/files/products/' . $j["image"] . '" alt="">
                </div>
                <div>
                    <h3>' . $j["name"] . '</h3>
                    <i>' . substr(strip_tags($j["description"]), 0, 160) . ' ...</i>
                    <span>' . number_format($j["price"]) . ' تومان</span>
                    <button class="addToCart" data-product="' . $j["id"] . '">+ سبد</button>
                </div>
            </a></div>';
    }
    echo '</div>
            <div id="hud">
                <div id="right" style="right: 0;left: unset;"><i class=\'fas fa-chevron-right\'></i></div>
                <div id="left"><i class=\'fas fa-chevron-left\'></i></div>
            </div>
        </div>
    </section>';
}
?>
<section class="introduction container">
    <a href="" style="background: linear-gradient(to left, #6FC691, #8de4af);">
        <div>
            <h3>حرفه ای</h3>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و</p>
        </div>
        <div><img data-src="documentary/image23.jpg" alt=""></div>
    </a>
    <a href="" style="background: linear-gradient(to left, #7ac, #96caef);">
        <div>
            <h3>تازه کار</h3>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و</p>
        </div>
        <div><img data-src="documentary/image41.jpg" alt=""></div>
    </a>
</section>
<?php
foreach (cnf_db_select("SELECT * FROM product_archives where show = 1 order by id desc") as $i) {
    echo '<section class="item-slide">
        <h2><span>' . $i["name"] . '</span><a href="/Store/s?c=' . $i["id"] . '">مشاهده همه <i class="fas fa-arrow-left"></i></a></h2>
        <div>
            <div id="items">';
    foreach (cnf_db_select("SELECT * FROM products where archive = " . $i["id"] . " order by id desc limit 8") as $j) {
        echo '<div><a href="/Store/' . $j["id"] . '">
                <div>
                    <img src="/my/media/img/posts/files/products/' . $j["image"] . '" alt="">
                </div>
                <div>
                    <h3>' . $j["name"] . '</h3>
                    <i>' . substr(strip_tags($j["description"]), 0, 160) . ' ...</i>
                    <span>' . number_format($j["price"]) . ' تومان</span>
                    <button class="addToCart" data-product="' . $j["id"] . '">+ سبد</button>
                </div>
            </a></div>';
    }
    echo '</div>
            <div id="hud">
                <div id="right" style="right: 0;left: unset;"><i class=\'fas fa-chevron-right\'></i></div>
                <div id="left"><i class=\'fas fa-chevron-left\'></i></div>
            </div>
        </div>
    </section>';
}
?>
<script>
    [...document.querySelectorAll(".item-slide #hud #right"), ...document.querySelectorAll(".item-slide #hud #left")].forEach(dkm => {
        if (dkm.id == "right") {
            dkm.addEventListener("click", function(e) {
                let t = e.target;
                if (t.tagName.toLowerCase() == "i") t = t.parentNode;
                let itms = t.parentNode.parentNode.firstElementChild;
                itms.scrollBy(itms.getBoundingClientRect().width * 0.6, 0);
            });
        } else {
            dkm.addEventListener("click", function(e) {
                let t = e.target;
                if (t.tagName.toLowerCase() == "i") t = t.parentNode;
                let itms = t.parentNode.parentNode.firstElementChild;
                itms.scrollBy(-itms.getBoundingClientRect().width * 0.6, 0);
            });
        }
    });
</script>