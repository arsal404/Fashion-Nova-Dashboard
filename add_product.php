<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
        <header>
            <h1>Admin Dashboard</h1>
            <nav>
                <a href="add_category.php">Add Category</a>
                <a href="add_subcategory.php">Add Subcategory</a>
                <a href="add_product.php">Add Product</a>
            </nav>
        </header>
		<a href="index.php" class="back-to-dashboard-btn">Back to Dashboard</a>
    <center><h2>Add Product</h2></center>
    <form method="POST" action="" enctype="multipart/form-data">
        <select name="subcategory_id" required>
            <option value="">Select Subcategory</option>
            <?php
            $result = $conn->query("SELECT * FROM subcategories");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['subcategory_name'] . "</option>";
            }
            ?>
        </select>
		<div class="file-input-wrapper">
			<div class="file-input">
				<label for="picture_main">Insert Main Picture</label>
				<input type="file" name="picture_main" id="picture_main" required>
			</div>
			
			<div class="file-input">
				<label for="picture1">Insert Picture One</label>
				<input type="file" name="picture1" id="picture1">
			</div>
			
			<div class="file-input">
				<label for="picture2">Insert Picture Two</label>
				<input type="file" name="picture2" id="picture2">
			</div>
			
			<div class="file-input">
				<label for="picture3">Insert Picture Three</label>
				<input type="file" name="picture3" id="picture3">
			</div>
		</div>
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <select name="payment" required>
            <option value="COD">Cash on Delivery</option>
            <option value="Online">Online Payment</option>
        </select>
        <button type="submit" name="submit">Add Product</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $subcategory_id = $_POST['subcategory_id'];
        $picture_main = $_FILES['picture_main']['name'];
        $picture1 = $_FILES['picture1']['name'];
        $picture2 = $_FILES['picture2']['name'];
        $picture3 = $_FILES['picture3']['name'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $payment = $_POST['payment'];

        move_uploaded_file($_FILES['picture_main']['tmp_name'], "uploads/" . $picture_main);
        if ($picture1) move_uploaded_file($_FILES['picture1']['tmp_name'], "uploads/" . $picture1);
        if ($picture2) move_uploaded_file($_FILES['picture2']['tmp_name'], "uploads/" . $picture2);
        if ($picture3) move_uploaded_file($_FILES['picture3']['tmp_name'], "uploads/" . $picture3);

        $sql = "INSERT INTO products (subcategory_id, picture_main, picture1, picture2, picture3, name, description, price, quantity, payment) 
                VALUES ('$subcategory_id', '$picture_main', '$picture1', '$picture2', '$picture3', '$name', '$description', '$price', '$quantity', '$payment')";

        if ($conn->query($sql) === TRUE) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
