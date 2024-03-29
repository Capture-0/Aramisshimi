<?php
// --- database tables ---
// orders / id first_name last_name email(null) mobile address(null) content datetime(current) isread(0) / CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,first_name varchar(50) NOT NULL,last_name varchar(50) NOT NULL,email varchar(50),mobile varchar(50) NOT NULL,address varchar(100),content varchar(1000) NOT NULL,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,isread BOOLEAN NOT NULL DEFAULT 0);
// posts / id title(unique) subject image content archive datetime(current) / CREATE TABLE posts (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,title varchar(100) NOT NULL UNIQUE,subject varchar(500) NOT NULL,image varchar(100) NOT NULL,content varchar(5000) NOT NULL,archive INTEGER NOT NULL,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
// messages / id fullname mobile subject content isread(0) attachment(null) datetime(current) / CREATE TABLE messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,fullname varchar(100) NOT NULL,mobile varchar(50) NOT NULL,subject varchar(500) NOT NULL,content varchar(1000) NOT NULL,isread BOOLEAN NOT NULL DEFAULT 0,attachment varchar(100),datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
// comments / id fullname email content post comment(0) datetime(current) / CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,fullname varchar(100) NOT NULL,email varchar(50) NOT NULL,content varchar(1000) NOT NULL,post INTEGER NOT NULL,comment INTEGER DEFAULT 0,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
// archives / id name(unique) priority(2) show(1) / CREATE TABLE archives (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(100) NOT NULL UNIQUE,priority INTEGER DEFAULT 2,show BOOLEAN DEFAULT 1);
// pivot / relation object1 object2 / CREATE TABLE pivot (relation varchar(100) NOT NULL,object1 varchar(100) NOT NULL,object2 varchar(100) NOT NULL);
// tags / id name(unique) / CREATE TABLE tags (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(100) NOT NULL UNIQUE);
// products / id name description price ordered image archive datetime / CREATE TABLE products (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(100) NOT NULL UNIQUE,description varchar(1000) NOT NULL, price varchar(100) NOT NULL, ordered INTEGER NOT NULL DEFAULT 0,image varchar(100) NOT NULL,archive INTEGER NOT NULL,datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)
// _page / id 
// _setting / id 

// --- other ---
// reset the database tables query being shown beyond
// add intro and outro and remove name columns from _page table
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
// change _page to data which has 2 columns key and value which key is page name and value is json of title, description, keywords, styles and page visits

if (empty($_SESSION["role"])) $_SESSION["role"] = "user";
require("my/cnf.php");
// CREATE TABLE _page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name varchar(50) NOT NULL,title varchar(70) NOT NULL,description varchar(160) NOT NULL,keywords varchar(100) NOT NULL,styles varchar(100) NOT NULL);

// prevent browser from caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$currentPage = strtolower($_SERVER["REQUEST_URI"]);

$params = preg_split("/\//", $currentPage, -1, PREG_SPLIT_NO_EMPTY);

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
    <title><?php echo $_PAGE["title"]; ?></title>
    <?php
    foreach (explode(",", $_PAGE["styles"]) as $i) {
        echo '<link rel="stylesheet" href="/my/code/ht/styles/' . $i . '.css">';
    }
    ?>
    <link href="http://aramisshimi.ir/Home" rel="canonical">
    <link rel="icon" type="image/png" href="/favicon.png" />
    <link rel="stylesheet" href="/my/code/ht/styles/style.css">
    <link rel="stylesheet" href="/my/code/ht/styles/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="/my/code/ht/js/default.js"></script>
</head>

<body>
    <input type="hidden" id="isPageLoaded" value="<?php echo $_PAGE["description"] == "" ? "false" : "true"; ?>" />
    <script>
        if (document.querySelector("input#isPageLoaded").value != "true") window.location.reload();
    </script>
    <?php
    ob_start();
    include(url("@/intro.php"));
    if (file_exists(url("@/" . $params[0] . ".php"))) {
        for ($i = 1; $i < count($params); $i++) $_REQUEST["p$i"] = $params[$i];
        include(url("@/" . $params[0] . ".php"));
    } else {
        header("location:/Home");
    }
    include(url("@/outro.php"));
    ob_end_flush();
    ?>
</body>

</html>