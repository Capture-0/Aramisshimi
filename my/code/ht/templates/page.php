<?php
$loadablePages = ["certificates","test"];
if (!(count($_REQUEST) > 0) || !in_array(strtolower($_REQUEST["p1"]), $loadablePages)) {
    header("location:/");
}
$_REQUEST["p1"] = strtolower($_REQUEST["p1"]);
if ($_REQUEST["p1"] == "certificates") {
    cnf_page_create(array(
        "title" => "govahiname ha", // 70 chars limit
        "description" => "govahiname haye aramis shimi", // 160 chars limit
        "keywords" => "certificates,aramis,shimi", // less than 10 phrases recommended
        "name" => $currentPage,
        "styles" => "form,etc/certificates"
    ));
    include("etc/certificates.php");
} else if ($_REQUEST["p1"] == "test") {
    cnf_page_create(array(
        "title" => "test", // 70 chars limit
        "description" => "test page desc", // 160 chars limit
        "keywords" => "test,aramis,shimi", // less than 10 phrases recommended
        "name" => $currentPage,
        "styles" => ""
    ));
    include("etc/" . $_REQUEST["p1"] . ".php");
}
