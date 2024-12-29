<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016)-->

    <?php
try {
    $conn = new mysqli('localhost', 'root', '', 'telubites_db');

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['Email']);
        $password = trim($_POST['Password']);
        $role = trim($_POST['role']);

        if (empty($email) || empty($password) || empty($role)) {
            throw new Exception('Please fill all fields!');
        }

        $query = "SELECT * FROM register_userdb WHERE LOWER(Email) = LOWER(?) AND User_Type = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ss", $email, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password == true) {
                if ($role === 'student') {
                    header("Location: homepage.html");
                    exit();
                } elseif ($role === 'admin') {
                    header("Location: dashboard.html");
                    exit();
                }
            } else {
                throw new Exception('Invalid password!');
            }
        } else {
            throw new Exception('Email or role not found!');
        }

        $stmt->close();
    } else {
        throw new Exception('Invalid request method!');
    }
} catch (Exception $e) {
    echo "<script>alert('" . $e->getMessage() . "');</script>";
} finally {
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
    $conn->close();
}

?>
