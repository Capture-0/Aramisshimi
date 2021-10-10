<?php
// --- database tables ---
// orders / id first_name last_name email(null) mobile address(null) content datetime(current) isread(0) / CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,first_name varchar(50) NOT NULL,last_name varchar(50) NOT NULL,email varchar(50),mobile varchar(50) NOT NULL,address varchar(100),content varchar(1000) NOT NULL,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,isread BOOLEAN NOT NULL DEFAULT 0);
// posts / id title(unique) subject image content archive datetime(current) / CREATE TABLE posts (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,title varchar(100) NOT NULL UNIQUE,subject varchar(500) NOT NULL,image varchar(100) NOT NULL,content varchar(5000) NOT NULL,archive INTEGER NOT NULL,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
// messages / id fullname mobile subject content isread(0) attachment(null) datetime(current) / CREATE TABLE messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,fullname varchar(100) NOT NULL,mobile varchar(50) NOT NULL,subject varchar(500) NOT NULL,content varchar(1000) NOT NULL,isread BOOLEAN NOT NULL DEFAULT 0,attachment varchar(100),datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
// comments / id fullname email content post comment(0) datetime(current) / CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,fullname varchar(100) NOT NULL,email varchar(50) NOT NULL,content varchar(1000) NOT NULL,post INTEGER NOT NULL,comment INTEGER DEFAULT 0,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
// archives / id name(unique) priority(2) show(1) / CREATE TABLE archives (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(100) NOT NULL UNIQUE,priority INTEGER DEFAULT 2,show BOOLEAN DEFAULT 1);
// pivot / relation object1 object2 / CREATE TABLE pivot (relation varchar(100) NOT NULL,object1 varchar(100) NOT NULL,object2 varchar(100) NOT NULL);
// tags / id name(unique) / CREATE TABLE tags (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(100) NOT NULL UNIQUE);
// _page / id 
// _setting / id 

// --- other ---
// put intro and outro in etc
// add view column to tags table in manage page
// set default pic in settings
// add validate class to config
// set img, templates and styles path in settings
// create function that gets $_POST and return flash data and functions to change result and message, posted data and related in it
// change config to an object oriented file
// create a form validation class in config
// create a url class that return url params
// create a handler for uploaded files
// 1 melyoono sado panj hezar toman

session_start();
if (empty($_SESSION["role"])) $_SESSION["role"] = "user";
require("my/cnf.php");
// CREATE TABLE _page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(50) NOT NULL,title varchar(70) NOT NULL,description varchar(160) NOT NULL,keywords varchar(100) NOT NULL,styles varchar(100) NOT NULL);


$currentPage = $_SERVER["REQUEST_URI"];
if (m('\/(home)?', $currentPage)) $currentPage = "home";
else if (m('\/login', $currentPage)) $currentPage = "login";
else if (m('\/order', $currentPage)) $currentPage = "order";
else if (m('\/posts', $currentPage)) $currentPage = "posts";
else if (m('\/support', $currentPage)) $currentPage = "support";

$params = preg_split("/\//", $currentPage, -1, PREG_SPLIT_NO_EMPTY);

if (count($params) > 1) { // multi parameter url
    if (strtolower($params[0]) == "posts" && m("\d+", $params[1])) { // viewing a single post
        cnf_page_create(array(
            "title" => $params[0], // 70 chars limit
            "description" => $params[0], // 160 chars limit
            "keywords" => "post,aramis,shimi", // less than 10 phrases recommended
            "name" => $currentPage,
            "styles" => "posts,post,form"
        ));
    }
}

$_PAGE = cnf_page_data($currentPage);
$_FORM["result"] = "none";
$_FORM["message"] = "";
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
    ob_start();
    include(url("@/intro.php"));
    if (file_exists(url("@/" . $params[0] . ".php"))) {
        for ($i = 1; $i < count($params); $i++) $_REQUEST["p$i"] = $params[$i];
        include(url("@/" . $params[0] . ".php"));
    } else {
        header("location:/");
    }
    include(url("@/outro.php"));
    ob_end_flush();
    ?>
</body>

</html>