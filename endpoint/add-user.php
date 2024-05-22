<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['weight'], $_POST['height'], $_POST['birthday'], $_POST['contact_number'], $_POST['email'], $_POST['username'], $_POST['password'])) {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $birthday = $_POST['birthday'];
        $contactNumber = $_POST['contact_number'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_user (first_name, last_name, weight, height, birthday, contact_number, email, username, password) VALUES (:first_name, :last_name, :weight, :height, :birthday, :contact_number, :email, :username, :password)");
            
            $stmt->bindParam("first_name", $firstName, PDO::PARAM_STR);
            $stmt->bindParam("last_name", $lastName, PDO::PARAM_STR);
            $stmt->bindParam("weight", $weight, PDO::PARAM_INT);
            $stmt->bindParam("height", $height, PDO::PARAM_INT);
            $stmt->bindParam("birthday", $birthday, PDO::PARAM_STR);
            $stmt->bindParam("contact_number", $contactNumber, PDO::PARAM_INT);
            $stmt->bindParam("email", $email, PDO::PARAM_STR);
            $stmt->bindParam("username", $username, PDO::PARAM_STR);
            $stmt->bindParam("password", $password, PDO::PARAM_STR);
            
            $stmt->execute();

            echo "
                <script>
                    alert('Account Registered Successfully!');
                    window.location.href = 'http://localhost/workout-journal/';
                </script>
            ";
        } catch (PDOException $e) {
            $conn->rollBack();
            echo "Error:". $e->getMessage();
         }

    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/workout-journal/';
            </script>
        ";
    }
}

?>

