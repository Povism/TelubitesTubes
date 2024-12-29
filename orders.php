<?php
$conn = new mysqli("localhost", "root", "", "telubites_db");

$action = isset($_GET['action']) ? $_GET['action'] : ''; 


if ($action == 'read') {
    $result = $conn->query("SELECT * FROM orders");
    $orders = [];

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);
    exit;
}

if ($action == 'update') {
    $order_id = $_POST['order_id'];
    $status = ucfirst(strtolower($_POST['status'])); 
    if (in_array($status, ['Paid', 'Unpaid', 'Canceled'])) {
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $status, $order_id);
        if ($stmt->execute()) {
            echo json_encode(['message' => "Order status updated to $status"]);
        } else {
            echo json_encode(['message' => 'Failed to update order status']);
        }
        $stmt->close();
    } else {
        echo json_encode(['message' => 'Invalid status value']);
    }
    exit;
}


if ($action == 'delete') {
    $order_id = $_POST['order_id'];
    
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Order deleted successfully']);
    } else {
        echo json_encode(['message' => 'Failed to delete order']);
    }
    $stmt->close();
    exit;
}
?>
