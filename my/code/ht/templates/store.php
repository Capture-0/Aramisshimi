<?php
// 092183868000
$_PAGE = array(
    "title" => "آرامیس شیمی - فروشگاه", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "store,aramis,shimi", // less than 10 phrases recommended
    "name" => $currentPage,
    "styles" => "store,etc/store_list"
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
                <button>سفارش</button>
                <span></span><!-- جمع کل 315,000 -->
            </div>
        </div>
    </div>
    <div id="storeBar">
        <div class="container">
            <div id="search">
                <i class="fas fa-search"></i>
                <input type="search" placeholder="جستجو ..." />
            </div>
            <h3 style="padding: 0.2em 0.4em;">فروشگاه</h3>
            <div onclick="toggleCartManager()" id="cart"><span id="itemCount" style="display: none;"></span><i class="fas fa-shopping-cart"></i></div>
        </div>
    </div>
    <?php
    if (isset($_REQUEST["p1"])) {
        if (m("\\d+", $_REQUEST["p1"])) include(url("@/etc/store_product.php"));
    } else include(url("@/etc/store_list.php"));
    ?>
</main>
<script>
    window.globalThis.pageLoad.push(function() {
        refreshCartItemCounterSpan();
        loadCartItems()
        document.querySelectorAll(".addToCart").forEach(el => {
            el.addEventListener("click", function(e) {
                e.preventDefault();
                let prod = e.target.dataset.product;
                fetch("/my/cnf.php?cart=set&p=" + prod).then(x => x.text()).then(y => {});
                refreshCartItemCounterSpan();
                loadCartItems();
            });
        });
    });

    function refreshCartItemCounterSpan() {
        let cartItemCounterSpan = document.querySelector("#storeBar #cart #itemCount");
        fetch("/my/cnf.php?cart=get").then(x => x.text()).then(y => {
            if (y == "null") cartItemCounterSpan.style.display = "none";
            else {
                cartItemCounterSpan.style.display = "flex";
                cartItemCounterSpan.textContent = JSON.parse(y).items.split(",").length;
            }
        });
    }

    function toggleCartManager() {
        document.querySelector('#cartManager').style.display = document.querySelector('#cartManager').style.display == "block" ? "none" : "block";
    }

    function loadCartItems() {
        document.querySelector("#cartManager .list").textContent = "";
        fetch("/my/cnf.php?cart=get").then(x => x.text()).then(async function(y) {
            if (y == "null") {

            } else {
                let data = JSON.parse(y);
                items = data.items.split(",");
                counts = data.counts.split(",");
                let prods = await getProduct(items.join(","));
                for (item in items) {
                    let row = document.querySelector("[cart-row-template]").content.cloneNode(true).children[0];
                    row.dataset.product = items[item];
                    row.dataset.count = counts[item];
                    row.querySelector("div>img").setAttribute("src", "/my/media/img/posts/files/products/" + prods[item].image);
                    row.querySelector("h4").textContent = prods[item].name;
                    row.querySelector(".qntt>span").textContent = row.dataset.count;
                    row.querySelector(".qntt>button:first-child").addEventListener("click", function(e) {
                        if (e.target.parentNode.parentNode.dataset.count > 0) {
                            e.target.parentNode.parentNode.dataset.count--;
                            row.querySelector(".qntt>span").textContent = row.dataset.count;
                            fetch("/my/cnf.php?cart=remove&p=" + e.target.parentNode.parentNode.dataset.product).then(xx => xx.text()).then(yy => {});
                        }
                    });
                    row.querySelector(".qntt>button:last-child").addEventListener("click", function(e) {
                        e.target.parentNode.parentNode.dataset.count++;
                        row.querySelector(".qntt>span").textContent = row.dataset.count;
                        fetch("/my/cnf.php?cart=set&p=" + e.target.parentNode.parentNode.dataset.product).then(xx => xx.text()).then(yy => {});
                    });
                    document.querySelector("#cartManager .list").appendChild(row);
                }
            }
        });
    }

    document.querySelector("#cartManager").addEventListener("click", function(e) {
        if (e.target.id != "cartManager") return;
        document.querySelector("#cartManager").style.display = "none";
    });

    async function getProduct(numbers) {
        return JSON.parse(await ajax("product=" + numbers.replace(/\s+/img, "")));
    }
</script>