<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <nav>
                <a href="add_category.php">Add Category</a>
                <a href="add_subcategory.php">Add Subcategory</a>
                <a href="add_product.php">Add Product</a>
            </nav>
        </header>
        <main>
            <section class="summary">
                <div class="summary-card">
                    <h3>Total Categories</h3>
                    <p>
                        <?php 
                        $result = $conn->query("SELECT COUNT(*) AS total FROM categories");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        ?>
                    </p>
                </div>
                <div class="summary-card">
                    <h3>Total Subcategories</h3>
                    <p>
                        <?php 
                        $result = $conn->query("SELECT COUNT(*) AS total FROM subcategories");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        ?>
                    </p>
                </div>
                <div class="summary-card">
                    <h3>Total Products</h3>
                    <p>
                        <?php 
                        $result = $conn->query("SELECT COUNT(*) AS total FROM products");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        ?>
                    </p>
                </div>
            </section>
        </main>
    </div>
	
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
       
</body>
</html>
