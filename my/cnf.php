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

if (isset($_GET["req"]) && $_SESSION["role"]) {
    if ($_GET["req"] == "sql" && isset($_GET["p"])) {
        $qry = $_GET["p"];
        $sql = array("operation" => substr($qry, 0, 1), "table" => substr($qry, 1, 3), "id" => substr($qry, 4));
        $res = "";
        if ("d" == $sql["operation"] && $_SESSION["role"] == "admin") $res .= "delete from ";
        else if ("s" == $sql["operation"]) $res .= "select * from ";
        if ("arc" == $sql["table"]) $res .= "archives ";
        else if ("com" == $sql["table"]) $res .= "comments ";
        else if ("msg" == $sql["table"]) $res .= "messages ";
        else if ("ord" == $sql["table"]) $res .= "orders ";
        else if ("pst" == $sql["table"]) $res .= "posts ";
        $res .= m("\d+", $sql["id"]) ? "where id = " . $sql["id"] : "";
        $cnf_db_connection = new PDO("sqlite:admin.db");
        if (substr(strtolower($res),0,6) == "delete") cnf_db_execute($res);
        else echo json_encode(cnf_db_select($res)[0]);
    }
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
    if (substr(strtolower($qry),0,6) == "update" || substr(strtolower($qry),0,6) == "delete") {
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
    $strt = substr($path,0,2);
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

function m($pattern, $input, $caseSensetive = true)
{
    return preg_match('/^' . $pattern . '$/' . ($caseSensetive ? 'i' : ''), $input);
}

function cnf_misc_test()
{
    echo "config test successful";
    return "config test successful";
}
