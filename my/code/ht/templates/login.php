<?php
if (isset($_POST["submit"])) {
    $p = array("u" => $_POST["username"], "p" => $_POST["password"]);
    if ($p["u"] === "00000000" && $p["p"] === "00000000") {
        $_SESSION["role"] = "admin";
        header("location:/Manage");
    } else {
        $_FORM["result"] = "error";
        $_FORM["message"] = "نام کاربری یا رمز عبور اشتباه است.";
    }
}
$_PAGE = array(
    "title" => "vorood", // 70 chars limit
    "description" => "vorood be website", // 160 chars limit
    "keywords" => "login,aramis,shimi", // less than 10 phrases recommended
    "name" =>  $currentPage,
    "styles" => "form,login"
);
cnf_page_create($_PAGE);
?>
<main>
    <section class="container dark" style="max-width: 600px;">
        <h3>ورود</h3>
        <form method="POST">
            <div class="flash" data-type="<?php echo $_FORM["message"] == "" ? "none" : $_FORM["result"];  ?>">
                <?php
                echo $_FORM["message"];
                ?>
            </div>
            <div>
                <span>نام کاربری</span>
                <input name="username" type="text" />
            </div>
            <div>
                <span>رمز عبور</span>
                <input name="password" type="password" />
            </div>
            <button style="grid-column: 1 / -1;" type="submit" name="submit">ورود</button>
        </form>
    </section>
</main>