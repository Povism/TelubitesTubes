<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016)-->



<?php
$conn = new mysqli('localhost', 'root', '', 'telubites_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM items WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Item deleted successfully!'); window.location.href = 'ItemsDashboard.html';</script>";
    } else {
        echo "<script>alert('Failed to delete item.'); window.location.href = 'ItemsDashboard.html';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No ID provided for deletion.'); window.location.href = 'ItemsDashboard.html';</script>";
}

$conn->close();
?>
