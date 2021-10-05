CKEDITOR.replace("orderDesc", {
    filebrowserBrowseUrl: "/my/code/plugin/my/ckeditor_browser.php",
    filebrowserUploadUrl: "/my/code/plugin/my/ckeditor_upload.php",
    filebrowserUploadMethod: "form"
});
CKEDITOR.config.toolbarGroups = [{
    groups: ['basicstyles', 'list', 'insert', 'links', 'undo', 'styles']
}];
CKEDITOR.config.removeButtons = 'Italic,Strike,Subscript,Superscript,NumberedList,Image,Anchor,Unlink,Redo';