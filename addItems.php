<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016)-->
     
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemName = $_POST['itemName'];
    $price = $_POST['price'];
    $types = $_POST['types'];
    $subTypes = $_POST['sub-types'];

    $conn = new mysqli('localhost', 'root', '', 'telubites_db');

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO items (item_name, price, types, sub_types)
            VALUES ('$itemName', '$price', '$types', '$subTypes')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ItemsDashboard.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
