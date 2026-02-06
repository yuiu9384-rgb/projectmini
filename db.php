<?php
// เชื่อมต่อฐานข้อมูล (XAMPP)
$conn = new mysqli("localhost", "root", "", "loan_db");

if ($conn->connect_error) {
    die("เชื่อมต่อ DB ล้มเหลว: " . $conn->connect_error);
}

// รับค่าจาก JavaScript (fetch)
if (isset($_POST['p'])) {
    $p = $_POST['p'];
    $r = $_POST['r'];
    $m = $_POST['m'];
    $pay = $_POST['pay'];

    // คำสั่ง SQL (ชื่อคอลัมน์ต้องเป๊ะตามรูปที่คุณส่งมา)
    $sql = "INSERT INTO loan_history (principal_amount, interest_rate, loan_term, monthly_payment) 
            VALUES ('$p', '$r', '$m', '$pay')";

    if ($conn->query($sql) === TRUE) {
        echo "บันทึกข้อมูลลงฐานข้อมูลสำเร็จ!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>