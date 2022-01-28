<?php
// sort by most viewed, newest and price

?>
<div id="list" class="container">
    <section>
        <div id="bar">
            مرتب سازی بر اساس:
            <ul>
                <li>اسم</li>
                <li>قیمت</li>
                <li>جدید ترین</li>
            </ul>
            نمایش:
            <ul>
                <li onclick="document.querySelector('#list #items').setAttribute('class','grid')">جدول</li>
                <li onclick="document.querySelector('#list #items').setAttribute('class','row')">لیست</li>
            </ul>
        </div>
        <div id="items" class="row">
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
            <a href="">
                <div><img data-src="documentary/image04.jpg" alt=""></div>
                <h4>
                    لورم ایپسوم متن ساختگی با تولید
                </h4>
                <span>680,000</span>
                <button class="addToCart" data-product="4">+ سبد</button>
            </a>
        </div>
    </section>
    <aside>
        <div>
            <h3>دسته بندی ها</h3>
        </div>
        <div class="hr"></div>
        <h3>جدید ترین محصولات</h3>
        <div class="cont">
            <a>
                <div><img data-src="documentary/image22.jpg" alt=""></div>
                <h5>لورم ایپسوم متن ساختگی با تولید</h5>
                <span>بیشتر</span>
            </a>
            <a>
                <div><img data-src="documentary/image34.jpg" alt=""></div>
                <h5>لورم ایپسوم متن ساختگی با تولید</h5>
                <span>بیشتر</span>
            </a>
            <a>
                <div><img data-src="documentary/image61.jpg" alt=""></div>
                <h5>لورم ایپسوم متن ساختگی با تولید</h5>
                <span>بیشتر</span>
            </a>
            <a>
                <div><img data-src="documentary/image11.jpg" alt=""></div>
                <h5>لورم ایپسوم متن ساختگی با تولید</h5>
                <span>بیشتر</span>
            </a>
        </div>
    </aside>
</div>