<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $phone_model = $_POST['phone_model'];

    // Determine price
    $prices = [
        "iPhone 6s" => 1200,
        "iPhone 8 Plus" => 1800,
        "iPhone XR" => 2000,
        "iPhone XS Max" => 2200,
        "iPhone 11" => 3800,
        "iPhone 11 Pro" => 4000,
        "iPhone 12" => 4300,
        "iPhone 13 Mini" => 5000,
        "iPhone 13 Pro Max" => 6000,
        "iPhone 14" => 7000,
        "iPhone 14 Pro Max" => 8000
    ];
    $price = $prices[$phone_model];

    // Connect to the database
    $conn = new mysqli('127.0.0.1', 'root', '', 'iphone_store', 3309); // Notice port 3309

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO customers (name, surname, phone, address, phone_model, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $surname, $phone, $address, $phone_model, $price);

    if ($stmt->execute()) {
        echo "Purchase successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
