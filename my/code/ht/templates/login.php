<?php
$_PAGE = array(
    "title" => "vorood", // 70 chars limit
    "description" => "vorood be website", // 160 chars limit
    "keywords" => "login,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "form,login"
);
cnf_page_create($_PAGE);
?>
<main>
    <section class="container dark" style="max-width: 600px;">
    <h3>ورود</h3>
        <form method="POST">
            <div>
                <span>نام کاربری</span>
                <input type="text" />
            </div>
            <div>
                <span>رمز عبور</span>
                <input type="password" />
            </div>
            <button style="grid-column: 1 / -1;" type="submit" name="submit">ورود</button>
        </form>
    </section>
</main>