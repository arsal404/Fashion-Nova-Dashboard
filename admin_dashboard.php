<?php
// Check if form is submitted to add a featured product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_featured_product'])) {
    $product_id = $_POST['product_id']; // Get the selected product ID

    // Insert into featured_products table
    $sql = "INSERT INTO featured_products (product_id) VALUES ('$product_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Featured product added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- Form to add a Featured Product -->
<form method="POST">
    <label for="product_id">Select Product for Featured Section:</label>
    <select name="product_id" id="product_id" required>
        <!-- Dynamically load products from the database -->
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select>
    <button type="submit" name="add_featured_product">Add to Featured</button>
</form>
<?php
// Check if form is submitted to add a new arrival
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_new_arrival'])) {
    $product_id = $_POST['product_id']; // Get the selected product ID

    // Insert into new_arrivals table
    $sql = "INSERT INTO new_arrivals (product_id) VALUES ('$product_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New arrival added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- Form to add a New Arrival -->
<form method="POST">
    <label for="product_id">Select Product for New Arrivals:</label>
    <select name="product_id" id="product_id" required>
        <!-- Dynamically load products from the database -->
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select>
    <button type="submit" name="add_new_arrival">Add to New Arrivals</button>
</form>

<?php
// Display Newsletter Subscribers
$sql = "SELECT * FROM newsletter_subscribers";
$result = $conn->query($sql);

echo "<table>";
echo "<tr><th>ID</th><th>Email</th><th>Subscribed At</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['subscribed_at'] . "</td></tr>";
}

echo "</table>";
?>
