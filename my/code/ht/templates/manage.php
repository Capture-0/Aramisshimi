<?php
$_PAGE = array(
    "title" => "modiriyat", // 70 chars limit
    "description" => "modiriyate website", // 160 chars limit
    "keywords" => "manage,aramis,shimi", // less than 10 phrases recommended
    "name" => explode(".", basename(__FILE__))[0],
    "styles" => "form,manage"
);
cnf_page_create($_PAGE);
?>
<main>
    <section id="manage">
        <div class="container" data-action="server">
            <h2>صفحه مدیریت</h2>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> سفارشات</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div data-sect="orders">
                    <div class="row" data-identity="2">
                        <div>نام</div>
                        <div>شماره</div>
                        <div>ادرس</div>
                        <div>توضیحات</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>
                </div>
            </div>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> پست ها</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div data-sect="posts">
                    <div class="row">
                        <div>عکس</div>
                        <div>موضوع</div>
                        <div>محتوا</div>
                        <div>برچسب ها</div>
                        <div>بازدید/نظر ها</div>
                        <div>دسته بندی</div>
                        <div>تاریخ</div>
                        <div data-op="delete"></div>
                        <div data-op="edit"></div>
                    </div>
                </div>
            </div>
            <div class="listBtn">
                <div class="btn">
                    <h3><span>0</span> پیام ها</h3>
                    <div><i class="fas fa-chevron-down"></i></div>
                </div>
                <div data-sect="messages">
                    <div class="row">
                        <div>نام</div>
                        <div>ارتباط</div>
                        <div>موضوع</div>
                        <div>توضیحات</div>
                        <div>تاریخ</div>
                        <div>پیوست</div>
                        <div data-op="delete"></div>
                        <div data-op="inspect"></div>
                    </div>
                </div>
            </div>
            <div class="extraData" data-action="server">
                <h3>جدول ها</h3>
                <div class="lists">
                    <div>
                        <h4>کامنت ها</h4>
                        <div class="list" data-sect="comments">
                            <div class="row" data-identity="2">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>نظر</div>
                                <div>ارتباط</div>
                                <div>تاریخ</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                        </div>
                        <div class="manage">
                            <h5>پاسخ</h5>
                            <div>
                                <input type="text">
                                <button>ok</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4>دسته بندی ها</h4>
                        <div class="list" data-sect="archives">
                            <div class="row">
                                <div>نام</div>
                                <div>زیرمجموعه ها</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>زیرمجموعه ها</div>
                                <div data-op="delete"></div>
                                <div data-op="edit"></div>
                            </div>
                        </div>
                        <div class="manage">
                            <h5>اضافه کردن</h5>
                            <div>
                                <input type="text">
                                <button>ok</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4>برچسب ها</h4>
                        <div class="list" data-sect="tags">
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                            </div>
                            <div class="row">
                                <div>نام</div>
                                <div>دفعات استفاده</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="posts">
                <h3>نوشتن پست جدید</h3>
                <form method="POST" class="compose">
                    <div>
                        <span>عنوان</span>
                        <input type="text" />
                    </div>
                    <div>
                        <span>موضوع</span>
                        <input type="text" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <span>متن پست</span>
                        <textarea name="postDesc" contenteditable="true"></textarea>
                    </div>
                    <div>
                        <span>دسته بندی</span>
                        <select name="archive" id="">
                            <option value="powder">powder</option>
                            <option value="fluid">fluid</option>
                            <option value="machine">machine</option>
                        </select>
                    </div>
                    <div id="tags">
                        <span>برچسب ها</span>
                        <input onfocus="tagInputFocused = true;" onblur="tagInputFocused = false;" type="text">
                        <div></div>
                    </div>
                    <div>
                        <span>عکس</span>
                        <input type="file" />
                    </div>
                    <button style="grid-column: 1 / -1;" type="submit" name="submit">ثبت</button>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="my/code/plugin/ckeditor/ckeditor.js"></script>
<script src="my/code/plugin/ckfinder/ckfinder.js"></script>
<script src="my/code/ht/js/manage.js"></script>