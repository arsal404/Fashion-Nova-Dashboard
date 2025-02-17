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
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="add_category.php">Add Category</a>
            <a href="add_subcategory.php">Add Subcategory</a>
            <a href="add_product.php">Add Product</a>
        </nav>
    </header>
    <a href="index.php" class="back-to-dashboard-btn">Back to Dashboard</a>

    <center><h2>Add Subcategory</h2></center>

    <form method="POST" action="">
        <select name="category_id" id="category_id" required onchange="updateSubcategories()">
            <option value="">Select Category</option>
            <?php
            $result = $conn->query("SELECT * FROM categories");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
            }
            ?>
        </select>
        
        <select name="subcategory_name" id="subcategory_name" required>
            <option value="">Select Subcategory</option>
        </select>

        <button type="submit" name="submit">Add Subcategory</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $subcategory_name = $_POST['subcategory_name'];
        $category_id = $_POST['category_id'];
        $sql = "INSERT INTO subcategories (subcategory_name, category_id) VALUES ('$subcategory_name', '$category_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Subcategory added successfully!";
            header("Location: add_product.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <script>
        function updateSubcategories() {
            var categoryId = document.getElementById("category_id").value;
            var subcategorySelect = document.getElementById("subcategory_name");

            // Clear current options
            subcategorySelect.innerHTML = "<option value=''>Select Subcategory</option>";

            var subcategories = {};

            // Define subcategories for each category
            subcategories['analog'] = ['Rolex', 'Dior'];
            subcategories['digital'] = ['Tomi', 'Gucci'];
            subcategories['smart'] = ['Sveston Prime', 'Sveston', 'Sveston Watch'];

            // Get the category name based on categoryId, assuming you have category data
            if (categoryId) {
                <?php
                    // Fetch categories from database for checking
                    $categories = $conn->query("SELECT id, category_name FROM categories");
                    while ($row = $categories->fetch_assoc()) {
                        echo "if (categoryId == '" . $row['id'] . "') {
                            var categoryName = '" . $row['category_name'] . "';
                        }";
                    }
                ?>

                // Update subcategories based on category
                if (subcategories[categoryName.toLowerCase()]) {
                    var subcategoryList = subcategories[categoryName.toLowerCase()];
                    subcategoryList.forEach(function(subcategory) {
                        var option = document.createElement("option");
                        option.value = subcategory;
                        option.textContent = subcategory;
                        subcategorySelect.appendChild(option);
                    });
                }
            }
        }
    </script>

    <script src="script.js"></script>
</body>
</html>
