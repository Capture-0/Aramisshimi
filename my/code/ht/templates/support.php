<?php
if (isset($_POST["submit"])) {
    $n = $_POST["name"];
    $m = $_POST["mobile"];
    $s = $_POST["subject"];
    $c = $_POST["messageDesc"];
    $f = array(
        "lim" => 4,
        "str" => "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        "len" => 32,
        "rand" => ""
    );
    $_FORM = array();
    if (m("..+", $n) && m("(\+)?[\d\s]+", $m) && (m("..+", $s) || empty($s)) && m("....+", $c)) {
        if ($_FILES["attachment"]["size"] > 0 || !empty($_FILES["attachment"]["name"])) {
            $f["c"] = $_FILES["attachment"];
            $f["ext"] = strtolower(pathinfo(basename($_FILES["attachment"]["name"]), PATHINFO_EXTENSION));
        }
        try {
            if (!empty($f["c"])) {
                // create random name for the image
                for ($i = 0; $i < $f["len"]; $i++) $f["rand"] .= $f["str"][rand(0, strlen($f["str"]) - 1)];
                $f["rand"] = "my/media/uploaded/messages/" . $f["rand"] . "." . $f["ext"];
                while (file_exists($f["rand"])) {
                    $f["rand"] = "";
                    for ($i = 0; $i < $f["len"]; $i++) $f["rand"] .= $f["str"][rand(0, strlen($f["str"]) - 1)];
                    $f["rand"] = url("my/media/uploaded/messages/" . $f["rand"] . "." . $f["ext"]);
                }
                // check whether file has certain conditions
                if (
                    in_array($f["ext"], explode(",", "jpg,jpeg,png,gif,apng,avif,jfif,pjpeg,pjp,svg,webp")) &&
                    getimagesize($f["c"]["tmp_name"]) && $f["c"]["size"] < $f["lim"] * 1024 * 1024
                ) {
                    // check whether file has been uploaded and inputs inserted to database
                    if (move_uploaded_file($f["c"]["tmp_name"], $f["rand"])) {
                    } else throw new Exception();
                } else throw new Exception();
            }
            cnf_db_insert("INSERT INTO messages (fullname, mobile, [subject], content, attachment) VALUES (?,?,?,?,?)", [$n, $m, $s, $c, basename($f["rand"])]);
            $_FORM["result"] = "success";
            $_FORM["message"] = "پیام شما ارسال شد.";
        } catch (Exception $e) {
            $_FORM["result"] = "error";
            $_FORM["message"] = "پیام شما ارسال نشد.";
        }
    } else {
        $_FORM["result"] = "warning";
        $_FORM["message"] = "لطفا موارد زیر را به درستی وارد نمایید.<br />";
        $erar = array();
        if (!m("..+", $n)) $erar[] = "نام و نام خانوادگی";
        if (!m("(\+)?[\d\s]+", $m)) $erar[] = "شماره موبایل";
        if (!m("..+", $s) && !empty($s)) $erar[] = "موضوع";
        if (!m("....+", $c)) $erar[] = "متن پیام";
        $_FORM["message"] .= implode(", ", $erar);
    }
}
$_PAGE = array(
    "title" => "poshtibani", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "support,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "form,support"
);
cnf_page_create($_PAGE);
?>
<main>
    <section class="container" style="max-width: 780px;">
        <h3>پشتیبانی</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="flash" data-type="<?php echo $_FORM["message"] == "" ? "none" : $_FORM["result"];  ?>">
                <?php
                echo $_FORM["message"];
                if ($_FORM["result"] == "success") {
                    header("location:/");
                    $_SESSION["form_message"] = $_FORM["message"];
                    $_SESSION["form_result"] = $_FORM["result"];
                }
                ?>
            </div>
            <div>
                <span><span style="color: red;">*</span> نام و نام خانوادگی</span>
                <input name="name" type="text" />
            </div>
            <div>
                <span><span style="color: red;">*</span> شماره موبایل</span>
                <input name="mobile" type="text" />
            </div>
            <div style="grid-column: 1 / -1;">
                <span>موضوع</span>
                <input name="subject" type="text" />
            </div>
            <div style="grid-column: 1 / -1;">
                <span><span style="color: red;">*</span> پیام شما</span>
                <textarea name="messageDesc" contenteditable="true"></textarea>
            </div>
            <div>
                <span>پیوست</span>
                <input name="attachment" type="file" />
            </div>
            <button style="grid-column: 1 / -1;" type="submit" name="submit">ارسال</button>
        </form>
    </section>
</main>