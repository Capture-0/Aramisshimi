<?php

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

//|----------------------------------------
//|     AJAX
//|----------------------------------------

// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_GET["url"])) {
        echo url($_REQUEST["url"]);
    }
// }

//|----------------------------------------
//|     DATABASE
//|----------------------------------------

function cnf_db_connect($dbname)
{
    global $cnf_db_connection, $cnf_db_host, $cnf_db_user, $cnf_db_dbadmin, $cnf_db_pass;
    if ($cnf_db_connection == null) {

        // //selecting database by parameter (default is admin database)
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
    if (str_starts_with(strtolower($qry), "update") || str_starts_with(strtolower($qry), "delete")) {
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
    if (count(cnf_db_select("select name from _page where name = '" . $_PAGE["name"] . "'")) == 0)
        cnf_db_insert("INSERT into _page (name, title, description, keywords, styles) VALUES (?,?,?,?,?)", [$_PAGE["name"], $_PAGE["title"], $_PAGE["description"], $_PAGE["keywords"], $_PAGE["styles"]]);
    else cnf_db_execute("update _page set title = ?, description = ?, keywords = ?, styles = ? where name = ?", [$_PAGE["title"], $_PAGE["description"], $_PAGE["keywords"], $_PAGE["styles"], $_PAGE["name"]]);
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
        "styles" => "form,$page"
    ) : $_PAGE[0];
    if (count($_PAGE) > 1) cnf_db_execute("delete from _page where name = '" . $_PAGE["name"] . "'");
    return $result;
}

//|----------------------------------------
//|     PATH
//|----------------------------------------

function url($path)
{
    global $cnf_path_templates, $cnf_path_styles, $cnf_path_images;
    $p = "";
    if (str_starts_with($path, "i/")) $p = $cnf_path_images;
    else if (str_starts_with($path, "$/")) $p = $cnf_path_styles;
    else if (str_starts_with($path, "@/")) $p = $cnf_path_templates;
    else return $path;

    return $p . "/" . substr($path, 2);
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

function cnf_misc_alert($msg)
{
    echo "<script>alert('" . $msg . "');</script>";
}

function cnf_misc_test()
{
    echo "config test successful";
    return "config test successful";
}
