<?php
error_reporting(0);
if (!empty($_FILES)){

    if($_FILES['file_upload']['error'] > 0){
        die('Upload file không thành công.');
    }

    if(stripos($_FILES['file_upload']['type'], 'image/') !== 0){
        die('Định dạng file này không được hỗ trợ.');
    }

    if($_FILES['file_upload']['size'] > 1000){
        die('Dịch vụ chỉ hỗ trợ upload file dưới 1kb.');
    }

    if(!is_uploaded_file($_FILES['file_upload']['tmp_name'])) {
        die('File không hợp lệ.');
    }

    $ext = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
    if (!in_array($ext, ['gif', 'png', 'jpg', 'jpeg'])) {
        die('Dịch vụ chỉ hỗ trợ định dạng gif, png, jpg, jpeg.');
    }
	
    $new_name = __DIR__ . '/uploadfiles/' . md5($_FILES['file_upload']['name']) . ".{$ext}";
    if(!move_uploaded_file($_FILES['file_upload']['tmp_name'], $new_name)){
        die('Có lỗi xảy ra, vui lòng liên lạc với d4rkmod3 để được hỗ trợ.');
    }

    die('Upload file thành công, file của bạn sẽ nằm tại đường dẫn: ' . $new_name);
}
?>

