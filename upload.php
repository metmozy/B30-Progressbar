<?php

    //ตรวจว่า http request ที่เข้ามาเป็นแบบ POST ไหม ถ้าไม่ใช่จะตอบกลับด้วยสถานะ 405
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) { //ตรวจว่ามีไฟล์ที่ถูกส่งมาไหม กับ ไม่มีข้อผิดพลาดในการ upload ใช่ไหม UPLOAD_ERR_OK จะเท่ากับ 0
            $file = $_FILES['file'];                                                //เอาข้อมูลไฟล์มาเก็บไว้ในตัวแปร
            $uploadDirectory = 'uploads/' . basename($file['name']);              //basename ใช้ดึงชื่อไฟล์ file ไม่รวมpath 
                // ตรวจสอบและสร้างโฟลเดอร์ uploads ถ้ายังไม่มี
                if(!is_dir('uploads')){
                    mkdir('uploads', 0777, true);                           // 0777 สามารถเข้าถึงได้โดยทุกคน true คือจะสร้างโฟลเดอร์ย่อยให้ถ้าไม่มี
                }
                // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
                if(move_uploaded_file($file['tmp_name'], $uploadDirectory)){  //ย้ายไฟล์ชั่วคราวไปยังตำแหน่งที่กำหนด
                    echo 'File uploaded successfully';
                }else{
                    http_response_code(500);            //จะบอกสถาณะเป็น 500 เพื่อบอกว่ามีข้อผิดพลาดเกิดขึ้นในเซิร์ฟเวอร์   
                    echo 'ไม่สามารถบันทึกไฟล์ได้';
                }
        }else{
            http_response_code(400);    //จะบอกสถานะ 400 เมื่อผู้ใช้ไม่แนบไฟล์หรือส่งไฟล์ที่ไม่ถูกต้อง 
            echo 'ไม่มีไฟล์ที่ถูกต้องถูกอัปโหลด หรือเกิดข้อผิดพลาดในการอัปโหลด';
        }

    }else{
        http_response_code(405);   //ใช้ method ผิดจะบอกสถานะ 405 ไม่อนุญาตหรือไม่ถูกต้องสำหรับเส้นทางที่ร้องขอ
        echo 'ไม่อนุญาตให้ใช้เมธอดนี้ ควรใช้ POST';
    }

?>
