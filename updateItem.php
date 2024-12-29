<!-- Kelas: SI-48-INT  -->
    <!-- Kelompok: 01  -->
    <!--Anggota Kelompok: -->
    <!-- 1. Maya Radina Putri (102022400015)  -->
    <!-- 2. Nadila Naurah Rayyani Himawan (102022400145) -->
    <!-- 3. Muhammad Fazshyerra Pradichwa Raksaragana (102022440006)-->
    <!-- 4. Muhammad Mumtaz (102022400299) -->
    <!-- 5. Naufal Ghazika Fadhlurahman (102022440016)-->

    <?php
// Pastikan kode PHP dimulai langsung tanpa spasi atau karakter apapun
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $itemName = $_POST['itemName'];
    $price = $_POST['price'];
    $types = $_POST['types'];
    $subTypes = $_POST['subTypes'];

    $conn = new mysqli('localhost', 'root', '', 'telubites_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE items SET item_name='$itemName', price='$price', types='$types', sub_types='$subTypes' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Panggil header() sebelum ada output lain
        header("Location: ItemsDashboard.html");
        exit;
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'telubites_db');
    $result = $conn->query("SELECT * FROM items WHERE id=$id");
    $item = $result->fetch_assoc();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #F6E9CF;
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            padding: 20px;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form-container {
            background-color: #f8edd5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 25px;
            text-align: center;
            background-color: white;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .button-group button {
            padding: 8px 20px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 25px;
            background-color: #e8e4dd;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button-group button:hover {
            background-color: #d3cdc1;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            background-color: #fff;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer button {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: none;
            border: none;
            cursor: pointer;
            text-align: center;
            color: #000;
            font-size: 14px;
        }

        .footer button:hover {
            color: #007BFF;
        }

        .footer button img {
            height: 20px;
        }

        .footer button:focus {
            outline: none;
        }
        </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <img src="images/Logo.png" alt="UBites Logo" style="width: 150px; margin-right: 1rem;">
            </div>
            <div class="logo">
                <h1>UPDATE ITEM</h1>
            </div>
        </header>

        <div class="form-container">
            <form action="updateItem.php" method="POST">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <div class="form-group">
                    <label for="itemName">Item Name</label>
                    <input type="text" id="itemName" name="itemName" value="<?= $item['item_name'] ?>" placeholder="Item Name" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="<?= $item['price'] ?>" placeholder="Price" required>
                </div>

                <div class="form-group">
                    <label for="types">Types</label>
                    <input type="text" id="types" name="types" value="<?= $item['types'] ?>" placeholder="Types" required>
                </div>

                <div class="form-group">
                    <label for="subTypes">SubTypes</label>
                    <input type="text" id="subTypes" name="subTypes" value="<?= $item['sub_types'] ?>" placeholder="SubTypes" required>
                </div>

                <div class="button-group">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <button onclick="window.location.href='dashboard.html'">
            <img src="images/Home.png" alt="Dashboard Icon">
            <p>Dashboard</p>
        </button>
        <button onclick="window.location.href='items.html'">
            <img src="images/Items.png" alt="Items Icon">
            <p>Items</p>
        </button>
        <button onclick="window.location.href='orders.html'">
            <img src="images/Cart.png" alt="Orders Icon">
            <p>Orders</p>
        </button>
        <button onclick="window.location.href='analysis.html'">
            <img src="images/analysis.png" alt="Analysis Icon">
            <p>Analysis</p>
        </button>
    </div>
</body>
</html>