<?php
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
                <span>ایمیل</span>
                <input type="text" />
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