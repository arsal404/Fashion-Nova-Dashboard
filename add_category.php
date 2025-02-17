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
    
    <center><h2>Add Category</h2></center>
    <form method="POST" action="">
                                       
        <button type="submit" name="submit">Add Category</button>
    </form>                  

    <?php
    if (isset($_POST['submit'])) {
        $category_name = $_POST['category_name'];

        if (!empty($category_name)) {
            $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
            if ($conn->query($sql) === TRUE) {
                // Category added successfully, now redirect to another page
                echo "<p>Category added successfully! Redirecting...</p>";
                header("Location: add_subcategory.php");
                exit();
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Please select a category.</p>";
        }
    }
    ?>
</body>
</html>
