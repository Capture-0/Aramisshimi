<?php
// --- pages ---
// home #
// order #
// manage #
// login #
// support #
// posts #
// one post

// --- database tables ---
// orders
// posts
// messages
// comments
// archives
// tags
// _page #
// _setting

// --- other ---
// 
// 
// 
// 
// 


require("my/cnf.php");
// CREATE TABLE _page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(50) NOT NULL,title varchar(70) NOT NULL,description varchar(160) NOT NULL,keywords varchar(100) NOT NULL,styles varchar(100) NOT NULL);


$currentPage = $_SERVER["REQUEST_URI"];
if (m('\/(home)?', $currentPage)) $currentPage = "home";
else if (m('\/(login)?', $currentPage)) $currentPage = "login";
else if (m('\/(order)?', $currentPage)) $currentPage = "order";
else if (m('\/(posts)?', $currentPage)) $currentPage = "posts";
else if (m('\/(support)?', $currentPage)) $currentPage = "support";
$page_name = $currentPage;

$params = preg_split("/\//", $currentPage, -1, PREG_SPLIT_NO_EMPTY);

if (count($params) > 1) { // multi parameter url
    if (strtolower($params[0]) == "posts" && m("\d+", $params[1])) { // viewing a single post
        cnf_page_create(array(
            "title" => $params[0], // 70 chars limit
            "description" => $params[0], // 160 chars limit
            "keywords" => "post,aramis,shimi", // less than 10 phrases recommended
            "name" => $page_name,
            "styles" => "posts,post,form"
        ));
    }
}

$_PAGE = cnf_page_data($page_name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $_PAGE["keywords"]; ?>">
    <meta name="description" content="<?php echo $_PAGE["description"]; ?>">
    <meta name="robots" content="index, follow">
    <link href="https://aramisshimi.rf.gd/" rel="canonical">
    <title><?php echo $_PAGE["title"]; ?></title>
    <?php
    foreach (explode(",", $_PAGE["styles"]) as $i) {
        echo '<link rel="stylesheet" href="/my/code/ht/styles/' . $i . '.css">';
    }
    ?>
    <link rel="stylesheet" href="/my/code/ht/styles/style.css">
    <link rel="stylesheet" href="/my/code/ht/styles/home.css">
    <link rel="stylesheet" href="/my/code/ht/styles/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="/my/code/ht/js/default.js"></script>
</head>

<body>
    <!-- remove display none to show menu -->
    <div id="lightbox" style="display: none;">
        <div data-toggleable="menu" onclick="toggleLightbox()" class="cancel"></div>
        <div class="content">
            <div id="menu">
                <h3>منوی اصلی</h3>
                <ul>
                    <span>شوینده <i class="fas fa-caret-down" style="font-size: 1em;"></i></span>
                    <li>مایع دسشویی</li>
                    <li>شیشه پاک کن</li>
                    <li>
                        <ul>
                            <span>شوینده <i class="fas fa-caret-down" style="font-size: 1em;"></i></span>
                            <li>مایع دسشویی</li>
                            <li>شیشه پاک کن</li>
                            <li>قرص ظرف شویی</li>
                        </ul>
                    </li>
                    <li>قرص ظرف شویی</li>
                    <li>
                        <ul>
                            <span>شوینده <i class="fas fa-caret-down" style="font-size: 1em;"></i></span>
                            <li>مایع دسشویی</li>
                            <li>شیشه پاک کن</li>
                            <li>قرص ظرف شویی</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- remove display none to show menu button -->
    <button style="display: none;" onclick="menuToggle(true)" id="menuBtn">
        <i class="fas fa-bars" style="font-size: 2em;"></i>
    </button>
    <script>
        window.globalThis.pageLoad = [];
        //menuToggle(true);

        function toggleLightbox() {
            var lightbox = document.querySelector("#lightbox");
            var cancel = lightbox.querySelector(".cancel");
            cancel.style.display = "none";
            eval(cancel.dataset.toggleable + "Toggle(false);");
        }

        function menuToggle(open) {
            var menu = document.querySelector("#lightbox > .content > #menu");
            var cancel = document.querySelector("#lightbox > .cancel");
            // var menuIsOpen = menu.style.right == 0;
            if (open !== true) {
                menu.style.right = -menu.getBoundingClientRect().width + "px";
                cancel.style.display = "none";
            } else {
                menu.style.right = "0";
                cancel.style.display = "block";
            }
        }
    </script>
    <?php
    if (file_exists(url("@/" . $params[0] . ".php"))) {
        for ($i = 1; $i < count($params); $i++) $_REQUEST["p$i"] = $params[$i];
        include(url("@/intro.php"));
        include(url("@/" . $params[0] . ".php"));
        include(url("@/outro.php"));
    } else {
        include(url("@/intro.php"));
        include(url("@/home.php"));
        include(url("@/outro.php"));
    }
    ?>
</body>

</html>