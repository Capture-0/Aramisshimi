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
    if (document.querySelector("#cartManager .list").innerHTML == "") document.querySelector("#cartManager .list").innerHTML = `
    <div style="justify-content: center;" class="row">
        <h4>سبد شما خالی است.</h4>
    </div>`;

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

document.querySelector("#storeBar #search input").addEventListener("keypress", function(e) {
    if (e.keyCode == 13 && window.location.pathname != "/Store/s") window.location.href = "/Store/s?s=" + e.target.value;
});