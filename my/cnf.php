<?php
session_start();

//|----------------------------------------
//|     CONSTANTS
//|----------------------------------------

$cnf_db_host = 'sql308.epizy.com';
$cnf_db_user = 'epiz_29160560';
$cnf_db_dbadmin = 'epiz_29160560_admin';
$cnf_db_pass = 'kUgclU3WpboWuR';
/**
 * @var object
 */
$cnf_db_connection = null;

$cnf_page_default_description = "";
$cnf_page_default_keywords = "";

$cnf_path_templates = "my/code/ht/templates";
$cnf_path_styles = "my/code/ht/styles";
$cnf_path_images = "my/media/img";

date_default_timezone_set("Asia/Tehran");

//|----------------------------------------
//|     AJAX
//|----------------------------------------

if (isset($_GET["url"])) {
    echo url($_REQUEST["url"]);
}

if (isset($_GET["cart"])) {
    if ($_GET["cart"] == "get") {
        if (!empty($_SESSION["cart"])) {
            $prds = array();
            $qntt = array();
            foreach ($_SESSION["cart"] as $key => $value) {
                $prds[] = explode("_", $key)[1];
                $qntt[] = $value;
            }
            $res = array();
            $res["items"] = implode(",", $prds);
            $res["counts"] = implode(",", $qntt);
            echo json_encode($res);
        } else echo "null";
    } else if (isset($_GET["p"]) && m("\\d+", $_GET["p"])) {
        if ($_GET["cart"] == "set") {
            if (empty($_SESSION["cart"])) $_SESSION["cart"] = array();
            if (empty($_SESSION["cart"]["p_" . $_GET["p"]])) $_SESSION["cart"]["p_" . $_GET["p"]] = 1;
            else $_SESSION["cart"]["p_" . $_GET["p"]]++;
        } else if ($_GET["cart"] == "remove") {
            if ($_GET["p"] == "0") unset($_SESSION["cart"]);
            else {
                if ($_SESSION["cart"]["p_" . $_GET["p"]] == 1) unset($_SESSION["cart"]["p_" . $_GET["p"]]);
                else if ($_SESSION["cart"]["p_" . $_GET["p"]] > 1) $_SESSION["cart"]["p_" . $_GET["p"]]--;
            }
        }
    } else {
        echo "error";
    }
}

if (isset($_GET["product"])) {
    $cnf_db_connection = new PDO("sqlite:admin.db");
    if (m("\\d+(,\\d+)*", $_GET["product"])) {
        echo json_encode(cnf_db_select("select * from products where id in (" . $_GET["product"] . ")"));
    }
}
if (isset($_GET["store"])) {
    $cnf_db_connection = new PDO("sqlite:admin.db");
    $cat = isset($_GET["c"]) ? (m("\\d+", $_GET["c"]) ? $_GET["c"] : "0") : "0";
    $srch = $_GET["store"] == "null" ? "" : $_GET["store"];
    $ob = isset($_GET["ob"]) ? strtolower($_GET["ob"]) : "";
    $ob = $ob == "name" ? $ob : ($ob == "newest" ? "id" : ($ob == "price" ? $ob : "id"));
    $desc = isset($_GET["desc"]) ? ($_GET["desc"] == "true" ? true : false) : false;
    $desc = $ob == "id" ? $desc : !$desc;
    $qry = "select * from products where " . ($cat != "0" ? " archive = " . $cat . " and " : "") . "(name like ? or description like ?) order by " . $ob . " " . (!$desc ? "desc" : "");
    echo json_encode(cnf_db_select($qry, ["%$srch%", "%$srch%"]));
}

if (isset($_GET["req"]) && isset($_GET["p"]) && isset($_SESSION["role"])) {
    $cnf_db_connection = new PDO("sqlite:admin.db");
    if ($_GET["req"] == "delete" && $_SESSION["role"] == "admin") {
        $qry = $_GET["p"];
        $sql = array("table" => substr($qry, 0, 3), "id" => substr($qry, 3));
        if ("arc" == $sql["table"]) $res = "archives";
        else if ("ord" == $sql["table"]) $res = "orders";
        else if ("prd" == $sql["table"]) $res = "products";
        else if ("pst" == $sql["table"]) $res = "posts";
        else if ("msg" == $sql["table"]) $res = "messages";
        else if ("com" == $sql["table"]) $res = "comments";
        if ($res == "archives") {
            foreach (cnf_db_select("select id from posts where archive = " . $sql["id"]) as $i) {
                util_delete_post($i["id"]);
            }
        } else if ($res == "products") {
            util_delete_product($sql["id"]);
        } else if ($res == "posts") {
            util_delete_post($sql["id"]);
        } else if ($res == "messages") {
            unlink("media/uploaded/messages/" . cnf_db_select("select attachment from messages where id = " . $sql["id"])[0]["attachment"]);
        } else if ($res == "orders") {
            unlink("media/uploaded/orders/" . cnf_db_select("select attachment from orders where id = " . $sql["id"])[0]["attachment"]);
        }
        echo cnf_db_execute("delete from $res where id = " . $sql["id"]);
    }
    if ($_GET["req"] == "test") {
    }
    if ($_GET["req"] == "insert" && $_SESSION["role"] == "admin") {
        $s = explode(",", $_GET["p"]);
        if (count($s) < 2) {
            echo "more than 1 arguments needed seprated by comma";
        } else {
            if (m("archives?", $s[0]) && count($s) == 4) {
                cnf_db_insert("insert into archives(name,priority,show) values(?,?,?)", [$s[1], $s[2], $s[3]]);
                echo "success";
            }
        }
    }
}

function util_delete_product($id, $path = "media/img/posts/files/products/")
{
    $p = cnf_db_select("select * from products where id = $id")[0];
    unlink($path . $p["image"]);
    return cnf_db_execute("delete from products where id = $id");
}

function util_delete_post($id, $path = "media/img/posts/files/thumbnails/")
{
    $p = cnf_db_select("select * from posts where id = $id")[0];
    unlink($path . $p["image"]);
    cnf_db_execute("delete from comments where post = $id");
    cnf_db_execute("delete from pivot where relation like 'post%' and object1 = '$id'");
    return cnf_db_execute("delete from posts where id = $id");
}

//|----------------------------------------
//|     DATABASE
//|----------------------------------------

function cnf_db_connect($dbname)
{
    global $cnf_db_connection, $cnf_db_host, $cnf_db_user, $cnf_db_dbadmin, $cnf_db_pass;
    if ($cnf_db_connection == null) {

        //selecting database by parameter (default is admin database)
        // $db = $cnf_db_dbadmin;
        // if ($dbname == "admin") $db = $cnf_db_dbadmin;

        // $cn = new PDO("mysql:host=" . $cnf_db_host . ";dbname=" . $db, $cnf_db_user, $cnf_db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $cn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // $cn->exec("SET CHARACTER SET utf8");
        // $cn->exec("SET NAMES utf8");
        // $cnf_db_connection = $cn;
        // return $cn; //return connection statment
        $cnf_db_connection = new PDO("sqlite:my/admin.db");
        return $cnf_db_connection;
    }
    return null; //already connected
}

function cnf_db_insert($qry, $vals = null)
{
    if (strtolower(substr($qry, 0, 6)) != "insert") return null; // check if its an insert command
    global $cnf_db_connection;
    //connect to admin database if not connected to any database
    if ($cnf_db_connection == null) cnf_db_connect("admin");

    // if $vals has value use BindValue function
    $sth = $cnf_db_connection->prepare($qry);
    if ($vals != null) {
        for ($i = 1; $i <= count($vals); $i++) $sth->bindValue($i, $vals[$i - 1]);
    }
    //execute insertion and return last inserted id
    $sth->execute();
    return $cnf_db_connection->lastInsertId();
}

function cnf_db_execute($qry, $vals = null)
{
    global $cnf_db_connection;
    //connect to admin database if not connected to any database
    if ($cnf_db_connection == null) cnf_db_connect("admin");

    // if $vals has value use BindValue function
    $sth = $cnf_db_connection->prepare($qry);
    if ($vals != null) {
        for ($i = 1; $i <= count($vals); $i++) $sth->bindValue($i, $vals[$i - 1]);
    }
    //execute update or delete and return rows affected if successful
    if (substr(strtolower($qry), 0, 6) == "update" || substr(strtolower($qry), 0, 6) == "delete") {
        if ($sth->execute()) return $sth->rowCount();
        else return null;
    } else return $sth->fetchAll();
}

function cnf_db_select($qry, $vals = null)
{
    if (strtolower(substr($qry, 0, 6)) != "select") return null; // check if its a select command
    global $cnf_db_connection;
    //connect to admin database if not connected to any database
    if ($cnf_db_connection == null) cnf_db_connect("admin");

    // if $vals has value use BindValue function
    $sth = $cnf_db_connection->prepare($qry);
    if ($vals != null) {
        for ($i = 1; $i <= count($vals); $i++) $sth->bindValue($i, $vals[$i - 1]);
    }
    $sth->execute();
    //fetch all data
    return $sth->fetchAll();
}

//|----------------------------------------
//|     PAGE
//|----------------------------------------

function cnf_page_create($_PAGE)
{
    if (count(cnf_db_select("select name from _page where name = '" . strtolower($_PAGE["name"]) . "'")) == 0)
        cnf_db_insert("INSERT into _page (name, title, description, keywords, styles) VALUES (?,?,?,?,?)", [strtolower($_PAGE["name"]), $_PAGE["title"], $_PAGE["description"], $_PAGE["keywords"], $_PAGE["styles"]]);
    else cnf_db_execute("UPDATE `_page` SET `title`=?,`description`=?,`keywords`=?,`styles`=? WHERE `name`=?", [$_PAGE["title"], $_PAGE["description"], $_PAGE["keywords"], $_PAGE["styles"], strtolower($_PAGE["name"])]);
}

function cnf_page_data($page)
{
    global $cnf_page_default_description, $cnf_page_default_keywords;
    $_PAGE = cnf_db_select("SELECT * FROM _page WHERE name = '$page' order by id desc");
    $result = count($_PAGE) == 0 ? array(
        "name" => $page,
        "title" => $page, // 70 chars limit
        "description" => $cnf_page_default_description, // default description
        "keywords" => $cnf_page_default_keywords, // default keywords
        "styles" => "form" // default styles
    ) : $_PAGE[0];
    if (count($_PAGE) > 1) cnf_db_execute("delete from _page where name = '" . strtolower($_PAGE["name"]) . "'");
    return $result;
}

//|----------------------------------------
//|     PATH
//|----------------------------------------

function url($path)
{
    global $cnf_path_templates, $cnf_path_styles, $cnf_path_images;
    $strt = substr($path, 0, 2);
    $p = "";
    if ($strt == "i/") $p = $cnf_path_images;
    else if ($strt == "$/") $p = $cnf_path_styles;
    else if ($strt == "@/") $p = $cnf_path_templates;
    else return $path;

    return $p . "/" . substr($path, 2);
}

function dirs()
{
    $items = array();
    if ($handle = opendir('.')) {
        while (false !== ($entry = readdir($handle))) if ($entry != "." && $entry != "..") $items[] = $entry;
        closedir($handle);
    }
    return $items;
}

//|----------------------------------------
//|     MISC
//|----------------------------------------

function cnf_misc_jalali_date($date = null, $format = "yyyy/MM/dd")
{
    $d = $date ? new DateTime($date) : new DateTime();
    $formatter = new IntlDateFormatter("fa_IR@calendar=persian", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL, $format);
    $string = $formatter->format($d); // output: 1396/12/14

    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

    $num = range(0, 9);
    return str_replace($arabic, $num, str_replace($persian, $num, $string));
}

function cnf_misc_create_date($input, $toformat, $fromformat = "Y-m-d H:i:s")
{ // intl formats -> https://pub.dev/documentation/intl/latest/intl/DateFormat-class.html
    $formatter = new IntlDateFormatter("fa_IR@calendar=persian", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL, $toformat);
    return $formatter->format(DateTime::createFromFormat($fromformat, $input));
}

function cnf_misc_alert($msg)
{
    echo "<script>alert('" . $msg . "');</script>";
}

function cnf_misc_avatar($id = "", $type = 1)
{
    return "https://avatars.dicebear.com/api/" . ($type == 1 ? "jdenticon" : ($type == 2 ? "initials" : "identicon")) . "/" . md5($id) . ".svg";
}

function cnf_misc_random_string($length = 32, $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789")
{
    $res = "";
    for ($i = 0; $i < $length; $i++) $res .= $chars[rand(0, strlen($chars) - 1)];
    return $res;
}

function m($pattern, $input, $caseInsensetive = true)
{
    return preg_match('/^' . $pattern . '$/' . ($caseInsensetive ? 'i' : ''), $input);
}

function cnf_misc_test()
{
    echo "config test successful";
    return "config test successful";
}
