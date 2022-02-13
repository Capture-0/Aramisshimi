<?php
// 092183868000
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
    <div id="cartManager">
        <div>
            <div id="header">
                <h3>سبد شما</h3>
                <span onclick='fetch("/my/cnf.php?cart=remove&p=0").then(x => x.text()).then(y => {loadCartItems();refreshCartItemCounterSpan();});'>&times; حذف همه</span>
            </div>
            <div class="list">
            </div>
            <template cart-row-template>
                <div class="row">
                    <div><img alt=""></div>
                    <h4>Lorem ipsum dolor sit.</h4>
                    <div class="qntt">
                        <button>-</button>
                        <span>4</span>
                        <button>+</button>
                    </div>
                </div>
            </template>
            <div id="terminal">
                <button><a href="/Order">سفارش</a></button>
                <span></span><!-- جمع کل 315,000 -->
            </div>
        </div>
    </div>
    <div id="storeBar">
        <div class="container">
            <div id="search">
                <i class="fas fa-search" onclick="if(window.location.pathname != '/Store/s')window.location.href = '/Store/s?s=' + document.querySelector('#storeBar #search input').value"></i>
                <input type="search" placeholder="جستجو ..." onkeyup="handleSearch()" />
            </div>
            <h3 style="padding: 0.2em 0.4em;position: absolute;left: 50%;transform: translateX(-50%);">فروشگاه</h3>
            <div onclick="toggleCartManager()" id="cart"><span id="itemCount" style="display: none;"></span><i class="fas fa-shopping-cart"></i></div>
        </div>
    </div>
    <?php
    if (isset($_REQUEST["p1"])) {
        if (m("\\d+", $_REQUEST["p1"])) include(url("@/etc/store_product.php"));
        else if (m("s\\?.*", $_REQUEST["p1"])) include(url("@/etc/store_list.php"));
    } else {
        $_PAGE = array(
            "title" => "آرامیس شیمی - فروشگاه", // 70 chars limit
            "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
            "keywords" => "store,aramis,shimi", // less than 10 phrases recommended
            "name" => $currentPage,
            "styles" => "store,etc/store_home"
        );
        cnf_page_create($_PAGE);
        include(url("@/etc/store_home.php"));
    }
    ?>
</main>
<script src="/my/code/ht/js/store.js"></script>