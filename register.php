<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016)-->


<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "telubites_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<script>alert('Connection failed: " . $conn->connect_error . "');</script>");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $FullName = trim($_POST["FullName"]);
    $StudentID = trim($_POST["StudentID"]);
    $Email = trim($_POST["Email"]);
    $Password = trim($_POST["Password"]);
    $ConfirmPassword = trim($_POST["ConfirmPassword"]);
    $UserType = trim($_POST["UserType"]);

    if (empty($FullName) || empty($StudentID) || empty($Email) || empty($Password) || empty($ConfirmPassword) || empty($UserType)) {
        echo "<script>alert('Please fill in all fields!');</script>";
        exit;
    }

    if ($Password !== $ConfirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit;
    }

    $checkEmailQuery = "SELECT * FROM register_userdb WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);

    if (!$stmt) {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
        exit;
    }

    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered! Please use a different email.');</script>";
    } else {
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO register_userdb (full_name, student_id, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);

        if (!$stmt) {
            echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
            exit;
        }

        $stmt->bind_param("sssss", $FullName, $StudentID, $Email, $hashedPassword, $UserType);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href = 'login.html';</script>";
            exit;
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>
