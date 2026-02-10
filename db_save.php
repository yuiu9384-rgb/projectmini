<?php
$conn = new mysqli("localhost", "root", "", "loan_db");

if ($conn->connect_error) {
    die("เชื่อมต่อ DB ล้มเหลว: " . $conn->connect_error);
}

if (
    isset($_POST['p']) &&
    isset($_POST['r']) &&
    isset($_POST['m']) &&
    isset($_POST['pay'])
) {
    $p = (float) $_POST['p'];
    $r = (float) $_POST['r'];
    $m = (int) $_POST['m'];
    $pay = (float) $_POST['pay'];

    $stmt = $conn->prepare(
        "INSERT INTO loan_history 
        (principal_amount, interest_rate, loan_term, monthly_payment)
        VALUES (?, ?, ?, ?)"
    );

    // d = decimal, i = int
    $stmt->bind_param("ddid", $p, $r, $m, $pay);

    if ($stmt->execute()) {
        echo "✅ บันทึกข้อมูลเรียบร้อยแล้ว";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "⚠️ ข้อมูลไม่ครบ";
}

$conn->close();
