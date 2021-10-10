<?php
$_FORM["result"] = "none";
$_FORM["message"] = "";
if (isset($_POST["submit"])) {
    $f = $_POST["first_name"];
    $l = $_POST["last_name"];
    $m = $_POST["mobile"];
    $a = $_POST["address"];
    $e = $_POST["email"];
    $o = $_POST["orderDesc"];
    $ig = array(
        "lim" => 4,
        "str" => "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        "len" => 32,
        "rand" => ""
    );
    $_FORM = array();
    if (m("..+", $f) && m("..+", $l) && m("(\+)?[\d\s]+", $m) && (m("....+", $a) || empty($a)) && (m("[\w\.\-]+@[\w\.\-]+\.[\w\.\-]+", $e) || empty($e)) && m("....+", $o)) {
        if ($_FILES["attachment"]["size"] > 0 || !empty($_FILES["attachment"]["name"])) {
            $ig["c"] = $_FILES["attachment"];
            $ig["ext"] = strtolower(pathinfo(basename($_FILES["attachment"]["name"]), PATHINFO_EXTENSION));
        }
        try {
            if (!empty($ig["c"])) {
                // create random name for the image
                for ($i = 0; $i < $ig["len"]; $i++) $ig["rand"] .= $ig["str"][rand(0, strlen($ig["str"]) - 1)];
                $ig["rand"] = "my/media/uploaded/orders/" . $ig["rand"] . "." . $ig["ext"];
                while (file_exists($ig["rand"])) {
                    $ig["rand"] = "";
                    for ($i = 0; $i < $ig["len"]; $i++) $ig["rand"] .= $ig["str"][rand(0, strlen($ig["str"]) - 1)];
                    $ig["rand"] = url("my/media/uploaded/orders/" . $ig["rand"] . "." . $ig["ext"]);
                }
                // check whether file has certain conditions
                if (
                    in_array($ig["ext"], explode(",", "jpg,jpeg,png,gif,apng,avif,jfif,pjpeg,pjp,svg,webp")) &&
                    getimagesize($ig["c"]["tmp_name"]) && $ig["c"]["size"] < $ig["lim"] * 1024 * 1024
                ) {
                    // check whether file has been uploaded and inputs inserted to database
                    if (move_uploaded_file($ig["c"]["tmp_name"], $ig["rand"])) {
                    } else throw new Exception();
                } else throw new Exception();
            }
            cnf_db_insert("INSERT INTO orders (first_name, last_name, email, mobile, [address], content, attachment) VALUES (?,?,?,?,?,?,?)", [$f, $l, $e, $m, $a, $o, basename($ig["rand"])]);
            $_FORM["result"] = "success";
            $_FORM["message"] = "سفارش شما با موفقیت ثبت شد.";
        } catch (Exception $e) {
            $_FORM["result"] = "error";
            $_FORM["message"] = "سفارش شما ثبت نشد.";
        }
    } else {
        $_FORM["result"] = "warning";
        $_FORM["message"] = "لطفا موارد زیر را به درستی وارد نمایید.<br />";
        $erar = array();
        if (!m("..+", $f)) $erar[] = "نام";
        if (!m("..+", $l)) $erar[] = "نام خانوادگی";
        if (!m("(\+)?[\d\s]+", $m)) $erar[] = "شماره موبایل";
        if (!m("....+", $a) && !empty($a)) $erar[] = "ادرس";
        if (!m("[\w\.\-]+@[\w\.\-]+\.[\w\.\-]+", $e) && !empty($e)) $erar[] = "ایمیل";
        if (!m("....+", $o)) $erar[] = "شرح سفارش";
        $_FORM["message"] .= implode(", ", $erar);
    }
}
$_PAGE = array(
    "title" => "sabte sefaresh", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "sefaresh,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "form,order"
);
cnf_page_create($_PAGE);
?>
<main>
    <section class="container" style="max-width: 780px;">
        <h3>ثبت سفارش</h3>
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
                <span><span style="color: red;">*</span> نام</span>
                <input name="first_name" type="text" required />
            </div>
            <div>
                <span><span style="color: red;">*</span> نام خانوادگی</span>
                <input name="last_name" type="text" required />
            </div>
            <div>
                <span><span style="color: red;">*</span> شماره موبایل</span>
                <input name="mobile" type="text" required />
            </div>
            <div>
                <span>ادرس</span>
                <input name="address" type="text" />
            </div>
            <div>
                <span>ایمیل</span>
                <input name="email" type="text" />
            </div>
            <div>
                <span>پیوست</span>
                <br />
                <input name="attachment" type="file" />
            </div>
            <div style="grid-column: 1 / -1;">
                <span><span style="color: red;">*</span> شرح سفارش</span>
                <textarea name="orderDesc" contenteditable="true"></textarea>
            </div>
            <button style="grid-column: 1 / -1;" type="submit" name="submit">ثبت</button>
        </form>
    </section>
    <script src="my/code/ht/js/order.js"></script>
</main>