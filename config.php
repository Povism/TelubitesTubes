
<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016)-->

<?php
$conn = mysqli_connect("localhost", "root", "", "telubites_db");  // Ganti dengan kredensial yang sesuai

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection successful!";
}
?>
