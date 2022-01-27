<?php
// 092183868000
$_PAGE = array(
    "title" => "آرامیس شیمی - فروشگاه", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "store,aramis,shimi", // less than 10 phrases recommended
    "name" => $currentPage,
    "styles" => "store,etc/store_home"
);
cnf_page_create($_PAGE);
/*
search
basket
banner
featured, offers and limited time section
a basket icon on top counting items, on submit order bring to order page adding items to order page
notes included: submit your order and our staff will call you within 24 hours, pay the bills when you receive the goods, before submiting you can manage your orders at the end of the page
on clicking on the basket icon it should open item managing page
*/
?>
<main>
    <div id="storeBar">
        <div class="container">
            <div id="search">
                <i class="fas fa-search"></i>
                <input type="search" placeholder="جستجو ..." />
            </div>
            <h3 style="padding: 0.2em 0.4em;">فروشگاه</h3>
            <div id="cart"><span>3</span><i class="fas fa-shopping-cart"></i></div>
        </div>
    </div>
    <?php
    include(url("@/etc/store_home.php"));
    ?>
</main>