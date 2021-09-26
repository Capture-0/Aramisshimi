<?php
$_PAGE = array(
    "name" => explode(".", basename(__FILE__))[0],
    "title" => "sabte sefaresh", // 70 chars limit
    "description" => "baraye daryafte khadamate ma dar in safhe sefareshate khod ra sabt konid", // 160 chars limit
    "keywords" => "sefaresh,aramis,shimi", // less than 10 phrases recommended
    "styles" => "form,order"
);
cnf_page_create($_PAGE);
?>
<main>
    <form method="POST">
        <input />
        <input />
        <textarea></textarea>
    </form>
</main>