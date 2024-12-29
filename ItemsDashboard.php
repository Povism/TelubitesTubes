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
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "
<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; border-collapse: collapse; text-align: center;'>
    <thead>
        <tr style='background-color: #f8edd5;'>
            <th>ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Types</th>
            <th>Sub Types</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
";

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['item_name']}</td>
            <td>{$row['price']}</td>
            <td>{$row['types']}</td>
            <td>{$row['sub_types']}</td>
            <td>
                <button onclick=\"updateItem({$row['id']})\" style='margin-right: 5px;'>Update</button>
                <button onclick=\"deleteItem({$row['id']})\">Delete</button>
            </td>
        </tr>
        ";
    }
} else {
    echo "
    <tr>
        <td colspan='6' style='text-align: center;'>There's no Data.</td>
    </tr>
    ";
}

echo "
    </tbody>
</table>
";

$conn->close();

?>

<script>
function updateItem(id) {
    window.location.href = `updateItem.php?id=${id}`;
}

function deleteItem(id) {
    if (confirm('Are You Sure Delete This Item?')) {
        window.location.href = `deleteItem.php?id=${id}`;
    }
}
</script>