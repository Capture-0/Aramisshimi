<?php
$_FORM["result"] = "none";
$_FORM["message"] = "";
if (isset($_POST["submit"])) {
    $n = $_POST["name"];
    $m = $_POST["mobile"];
    $s = $_POST["subject"];
    $c = $_POST["messageDesc"];
    $_FORM = array();
    if (m("..+", $n) && m("(\+)?[\d\s]+", $m) && (m("..+", $s) || empty($s)) && m("....+", $c)) {
        $_FORM["result"] = "success";
        $_FORM["message"] = "پیام شما با موفقیت ارسال شد.";
        try {
            cnf_db_insert("INSERT INTO messages (fullname, mobile, [subject], content) VALUES (?,?,?,?)", [$n, $m, $s, $c]);
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
        <form method="POST">
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
            <button style="grid-column: 1 / -1;" type="submit" name="submit">ارسال</button>
        </form>
    </section>
    <script src="my/code/plugin/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("messageDesc");
        CKEDITOR.config.toolbarGroups = [{
            groups: ['basicstyles', 'list', 'insert', 'links', 'undo', 'styles']
        }];
        CKEDITOR.config.removeButtons = 'Italic,Strike,Subscript,Superscript,NumberedList,Image,Anchor,Unlink,Redo';
    </script>
</main>