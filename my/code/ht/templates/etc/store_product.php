<?php
$_PAGE = array(
    "title" => "آرامیس شیمی - فروشگاه", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "store,aramis,shimi", // less than 10 phrases recommended
    "name" => $currentPage,
    "styles" => "store,etc/store_product"
);
cnf_page_create($_PAGE);
$product = cnf_db_select("select * from products where id = " . $_REQUEST["p1"])[0];
// aks
// tozih 100 kalame ii
// tarikh
// gheymat
// dokme afzoodan be sabad
?>
<div class="container">
    <article>
        <h2><?php echo $product["name"]; ?></h2>
        <span>
            فروشگاه
            <i class="fas fa-chevron-left"></i>
            <?php echo cnf_db_select("SELECT name FROM product_archives WHERE id = " . $product["archive"])[0]["name"]; ?>
            <i class="fas fa-chevron-left"></i>
            <?php echo $product["name"]; ?>
        </span>
        <div class="intro">
            <img src="/my/media/img/posts/files/products/<?php echo $product["image"]; ?>" alt="">
            <div>
                <div class="content"><?php echo $product["description"]; ?></div>
                <span class="date"><?php echo cnf_misc_create_date($product["datetime"], "EEEE d MMMM y"); ?></span>
            </div>
        </div>
        <div class="outro">
            <span>قیمت: <?php echo number_format($product["price"]); ?> تومان</span>
            <button class="addToCart" data-product="<?php echo $product["id"]; ?>"><i class='fas fa-plus-circle'></i> افزودن به سبد</button>
        </div>
    </article>
    <aside>
        <h3>محصولات مشابه</h3>
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