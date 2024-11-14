<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['file'];
            $uploadDirectory = 'uploads/' . basename($file['name']);
                // ตรวจสอบและสร้างโฟลเดอร์ uploads หากยังไม่มี
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
                if (move_uploaded_file($file['tmp_name'], $uploadDirectory)) {
                    echo 'File uploaded successfully';
                } else {
                    http_response_code(500);
                    echo 'ไม่สามารถบันทึกไฟล์ได้';
                }
            } else {
                http_response_code(400);
                echo 'ไม่มีไฟล์ที่ถูกต้องถูกอัปโหลด หรือเกิดข้อผิดพลาดในการอัปโหลด';
            }
            } else {
                http_response_code(405);
                echo 'ไม่อนุญาตให้ใช้เมธอดนี้ ควรใช้ POST';
            }

    if($_SERVER['REQUEST_METHOD'] === 'post'){
        if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK){
            $_file = $_FILES['file'];
            $uploadDirectory = 'uploads/' 
        }
    }








?>
