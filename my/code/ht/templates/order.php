<?php
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
        <form method="POST">
            <div>
                <span><span style="color: red;">*</span> نام</span>
                <input type="text" />
            </div>
            <div>
                <span><span style="color: red;">*</span> نام خانوادگی</span>
                <input type="text" />
            </div>
            <div>
                <span><span style="color: red;">*</span> شماره موبایل</span>
                <input type="text" />
            </div>
            <div>
                <span>ادرس</span>
                <input type="text" />
            </div>
            <div>
                <span>ایمیل</span>
                <input type="text" />
            </div>
            <div style="grid-column: 1 / -1;">
                <span><span style="color: red;">*</span> شرح سفارش</span>
                <textarea name="orderDesc" contenteditable="true"></textarea>
            </div>
            <button style="grid-column: 1 / -1;" type="submit" name="submit">ثبت</button>
        </form>
    </section>
    <script src="my/code/plugin/ckeditor/ckeditor.js"></script>
    <script src="my/code/ht/js/order.js"></script>
</main>