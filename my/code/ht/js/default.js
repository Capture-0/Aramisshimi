// |-------------------------
// |--- CONSTANTS
// |-------------------------

const DEFAULT_CONFIG_PATH = "/my/cnf.php";

function getAllQueryStrings() {
    ar = window.location.href.toString().split("?");
    if (ar.length == 1) return null;
    ar = ar[1].split("&");
    res = [];
    for (i in ar) {
        arg = ar[i].split("=");
        res.push({ key: arg[0], value: arg[1] });
    }
    return res;
}

function getQueryString(key) {
    qs = getAllQueryStrings();
    for (var i in qs)
        if (qs[i].key == key) return qs[i].value;
    return null;
}

function setQueryString(key, value) {
    qs = getAllQueryStrings();
    q = "";
    if (qs) {
        for (var i in qs) {
            if (qs[i].key == key) qs[i].value = value;
            q += qs[i].key + "=" + qs[i].value + "&";
        }
        q = "?" + q.substring(0, q.length - 1);
    } else {
        q = "?" + key + "=" + value;
    }
    if (getQueryString(key) == null) q += "&" + key + "=" + value;
    return window.location.href.toString().split("?")[0] + q;
}

async function url(path) {
    return "/" + (await (await fetch(DEFAULT_CONFIG_PATH + "?url=" + path)).text());
}

async function loadImages() { document.querySelectorAll("img[data-src]").forEach(async(img) => { img.src = await url("i/" + img.dataset.src); }); }

/**
 * @param {Function} callback
 */
function scrollReached(elements, callback) {
    elements.forEach(element => {
        if (element.dataset.passed != undefined) return;
        if (window.scrollY > (element.offsetTop - window.innerHeight)) {
            element.dataset.passed = "yes";
            callback(element);
        }
    });
}

async function ajax(qry, req) {
    return await (await fetch(DEFAULT_CONFIG_PATH + "?req=" + encodeURIComponent(req) + "&p=" + encodeURIComponent(qry))).text();
}

function pagingIndexes(rows, divideBy, currentPage) {
    var ar = [],
        etcs = [],
        pages = Math.floor(rows / divideBy) + 1;
    currentPage = currentPage < 1 ? 1 : currentPage > pages ? pages : currentPage;
    for (i = 1; i <= pages; i++) ar.push(i);
    if (ar.length > 5) {
        ar.splice(1, ar.indexOf(currentPage) - 2);
        ar.splice(ar.indexOf(currentPage) + 2, ar.length - ar.indexOf(currentPage) - 3);
        if (ar[0] != (ar[1] - 1)) ar.splice(1, 0, "...");
        if (ar[ar.length - 2] != (ar[ar.length - 1] - 1)) ar.splice(ar.length - 1, 0, "...");
    }
    return ar;
}

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

window.globalThis.pageLoad = [];