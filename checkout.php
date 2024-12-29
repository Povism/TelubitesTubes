<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016) -->

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "telubites_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

if (!isset($_SESSION['student_id']) || !isset($_SESSION['email'])) {
    die(json_encode(["status" => "error", "message" => "User not logged in. Please log in first."]));
}


$user_id = $_SESSION['student_id'];
$username = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);

    $items = json_decode($_POST['items'], true);
    $total_amount = floatval($_POST['total_amount']);
    $order_date = date("Y-m-d H:i:s");
    $status = "unpaid"; 

    $items_json = json_encode($items);

    $conn->begin_transaction();

    try {
        $sql_order = "INSERT INTO orders (user_id, username, items, total_amount, order_date, status) 
                      VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql_order);

        $stmt->bind_param("issdis", $user_id, $username, $items_json, $total_amount, $order_date, $status);
        
        $stmt->execute();

        $conn->commit();

        echo json_encode(["status" => "success", "message" => "Order successfully placed"]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["status" => "error", "message" => "Failed to place order: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
}

$conn->close();
?>
