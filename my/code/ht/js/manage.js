var tagInputFocused = false;
var tags = [];

var editor = CKEDITOR.replace("postDesc", {
    filebrowserBrowseUrl: "my/code/plugin/ckfinder/ckfinder.html",
    filebrowserUploadUrl: "my/code/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
    filebrowserUploadMethod: "form"
});
CKEDITOR.config.toolbarGroups = [{
        groups: ['basicstyles', 'indent', 'clipboard', 'undo']
    }, '/',
    {
        groups: ['insert', 'links', 'list', 'bidi']
    }, '/',
    {
        groups: ['tools', 'document', 'mode', 'styles']
    }
];

CKEDITOR.config.removeButtons = 'Italic,Strike,Subscript,Cut,Paste,Redo,NumberedList,Anchor,Unlink';

CKFinder.setupCKEditor(editor);

window.globalThis.pageLoad.push(async function() {
    document.querySelectorAll(".listBtn>.btn").forEach(el => {
        el.addEventListener("click", (e) => {
            e.stopPropagation();
            var btn = e.target;
            while (!btn.classList.contains("listBtn")) btn = btn.parentNode;
            if (parseInt(btn.lastElementChild.getBoundingClientRect().height) == 0) {
                btn.querySelector("div.btn>div").style.transform = "rotate(0deg)";
                btn.lastElementChild.style.maxHeight = "50vh";
            } else {
                btn.querySelector("div.btn>div").style.transform = "rotate(-90deg)";
                btn.lastElementChild.style.maxHeight = 0;
            }
        });
    });
    document.querySelectorAll("[data-action=server] [data-op]").forEach(async el => {
        var t = el;
        if (!t.hasAttribute("data-op")) t = t.parentNode;
        if (t.dataset.op == "delete") t.innerHTML = '<i class="fas fa-trash"></i>';
        else if (t.dataset.op == "edit") t.innerHTML = '<i class="fas fa-pen"></i>';
        else if (t.dataset.op == "inspect") t.innerHTML = '<i class="fas fa-eye"></i>';
        el.addEventListener("click", async function(e) {
            var t = e.target;
            if (!t.hasAttribute("data-op")) t = t.parentNode;
            var sect = t.parentNode.parentNode.dataset.sect;
            var msg = "";
            var tbl = "";
            switch (sect) {
                case "orders":
                    msg = "سفارش";
                    tbl = "ord";
                    break;
                case "posts":
                    msg = "پست";
                    tbl = "pst";
                    break;
                case "messages":
                    msg = "پیام";
                    tbl = "msg";
                    break;
                case "comments":
                    msg = "کامنت";
                    tbl = "com";
                    break;
                case "archives":
                    msg = "دسته بندی";
                    tbl = "arc";
                    break;
                case "tags":
                    msg = "برچسب";
                    break;
                default:
                    msg = "مورد";
                    break;
            }
            switch (t.dataset.op) {
                case "delete":
                    if (confirm("ایا از حذف این " + msg + " اطمینان دارید؟")) await ajax("d" + tbl + t.parentNode.dataset.identity);
                    break;
            }
            // if (confirm("ایا از حذف این " + msg + " اطمینان دارید؟")) alert("a=db&o=" + t.dataset.op + "&i=" + t.parentNode.dataset.identity + "&s=" + sect);
            // res = await ajax("");
            // alert(res);
        });
    });

    var form = document.querySelector("#manage .posts form").addEventListener("submit", function(event) {
        if (tagInputFocused) {
            event.preventDefault();
            var tagInput = document.querySelector("#manage .posts .compose #tags input");
            if (tagInput.value == "" || tags.includes(tagInput.value) || tagInput.value.indexOf(",") != -1) return false;
            var div = document.createElement("div");
            var i = document.createElement("i");
            i.classList.add("fas");
            i.classList.add("fa-times");
            i.addEventListener("click", function(e) {
                var input = e.target.parentNode.innerText;
                if (tags.indexOf(input.substring(0, input.length - 1)) > -1) tags.splice(tags.indexOf(input.substring(0, input.length - 1)), 1);
                e.target.parentNode.style.display = "none";
                document.querySelector("#manage .posts .compose #tags #tagsArray").value = tags.length > 0 ? tags.join(",") : "";
            });
            tags.push(tagInput.value);
            document.querySelector("#manage .posts .compose #tags #tagsArray").value = tags.length > 0 ? tags.join(",") : "";
            div.append(tagInput.value + " ");
            div.appendChild(i);
            tagInput.value = "";
            document.querySelector("#manage .posts .compose #tags > div").appendChild(div);
        } else if (!confirm("ایا از انتشار این مقاله اطمینان دارید؟")) event.preventDefault();
    });
});