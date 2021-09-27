<?php
if(isset($_FILES["upload"]["name"])){
    $f = $_FILES["upload"]["name"];
    $ft = $_FILES["upload"]["tmp_name"];
    move_uploaded_file($ft,"my/media/uploaded/".$f);
    $fnNo = $_GET["CKEditorFuncNum"];
    $url = "my/media/uploaded/".$f;
    $msg = "file uploaded";
    echo "<script>window.parent.CKEDITOR.tools.callFunction('$fnNo','$url','$msg');</script>";
}
