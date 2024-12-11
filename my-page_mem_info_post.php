<?php
$id = $_REQUEST["id"];
$name = $_REQUEST["name"];
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];
$email = $email1 . "@" . $email2;
$phone = $_POST["phone"];
$birth = $_POST["birth"];

if ($name != "" && $email != "" && $phone != "" && $birth != "") {
    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    
    // 아이디와 이름이 같은지 확인
    $check_sql = "SELECT * FROM members WHERE id = :id AND name = :name";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $check_stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $check_stmt->execute();
    
    if ($check_stmt->rowCount() > 0) {
        // 아이디와 이름이 일치하면 정보 업데이트
        $update_sql = "UPDATE members SET name = :name, phone = :phone, birth = :birth, email = :email WHERE id = :id";
        $update_stmt = $db->prepare($update_sql);
        $update_stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $update_stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $update_stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $update_stmt->bindParam(':birth', $birth, PDO::PARAM_STR);
        $update_stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $update_stmt->execute();

        echo '<script>alert("정보를 성공적으로 수정하였습니다.");</script>';
        echo '<script>
                // setTimeout(function() {
                    window.location.href = "my-page_member_pwd.php";
                // }, 1000);
              </script>';
        exit;
    } else {
        echo '<script>alert("아이디와 이름이 일치하지 않습니다.");</script>';
        echo '<script>
                // setTimeout(function() {
                    window.location.href = "my-page_member_pwd.php";
                // }, 1000);
              </script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>

    <script>
        alert('모든 항목이 빈칸 없이 입력되어야 합니다.');
        setTimeout(function() {
            history.back();
        }, 3000);
    </script>

</body>