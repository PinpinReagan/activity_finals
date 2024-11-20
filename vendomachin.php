<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendo Machine Prelim Activity</title>
</head>
<body>
    <h3><b>Vendo Machine</b></h3>

    <!-- Form for product selection -->
    <form method="POST">
        <!-- Fieldset for product selection -->
        <fieldset style="width: 420px; height: 120px;">
            <legend>Products:</legend>
            <label>
                <input type="checkbox" name="checkDrinks[]" value="Coke" 
                <?php if (isset($_POST['checkDrinks']) && in_array('Coke', $_POST['checkDrinks'])) echo 'checked'; ?>> 
                Coke - ₱15<br>
                
                <input type="checkbox" name="checkDrinks[]" value="Sprite" 
                <?php if (isset($_POST['checkDrinks']) && in_array('Sprite', $_POST['checkDrinks'])) echo 'checked'; ?>> 
                Sprite - ₱20<br>
                
                <input type="checkbox" name="checkDrinks[]" value="Royal" 
                <?php if (isset($_POST['checkDrinks']) && in_array('Royal', $_POST['checkDrinks'])) echo 'checked'; ?>> 
                Royal - ₱20<br>
                
                <input type="checkbox" name="checkDrinks[]" value="Pepsi" 
                <?php if (isset($_POST['checkDrinks']) && in_array('Pepsi', $_POST['checkDrinks'])) echo 'checked'; ?>> 
                Pepsi - ₱15<br>
                
                <input type="checkbox" name="checkDrinks[]" value="Mountain Dew" 
                <?php if (isset($_POST['checkDrinks']) && in_array('Mountain Dew', $_POST['checkDrinks'])) echo 'checked'; ?>> 
                Mountain Dew - ₱20<br>
            </label>
        </fieldset>

        <!-- Fieldset for size and quantity options -->
        <fieldset style="height: 35px; width: 420px;">
            <legend>Options:</legend>
            <label>Size</label>
            <select name="size">
                <option value="regular" <?php if (isset($_POST['size']) && $_POST['size'] == 'regular') echo 'selected'; ?>>Regular</option>
                <option value="up" <?php if (isset($_POST['size']) && $_POST['size'] == 'up') echo 'selected'; ?>>Up-Size (add ₱5)</option>
                <option value="jumbo" <?php if (isset($_POST['size']) && $_POST['size'] == 'jumbo') echo 'selected'; ?>>Jumbo (add ₱10)</option>
            </select>
            
            <label>Quantity</label>
            <input type="number" name="quantity" id="quantity" min="1" max="50" style="width: 100px;" 
            value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : ''; ?>">
            <input type="submit" value="Check out">
        </fieldset>
    </form>

   <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedProducts = $_POST['checkDrinks'] ?? [];
        $productPrices = ["Coke" => 15, "Sprite" => 20, "Royal" => 20, "Pepsi" => 15, "Mountain Dew" => 20];

        // Proceed if products are selected
        if (!empty($selectedProducts)) {
            $size = $_POST['size'] ?? 'regular';
            $quantity = $_POST['quantity'] ?? 1;
            $sizePrices = ($size == 'up') ? 5 : (($size == 'jumbo') ? 10 : 0);

            $totalAmount = 0; 
            $totalItems = 0;

            echo "<hr><h4><b>Purchase Summary:</b></h4>";

            // Calculate and display purchase details
            foreach ($selectedProducts as $product) {
                $productPrice = $productPrices[$product];
                $itemPrice = ($productPrice + $sizePrices) * $quantity;
                $itemText = ($quantity == 1) ? 'piece' : 'pieces';

                echo '<span style="font-weight: bold;">·</span> ' . $quantity . ' ' . $itemText . ' of Regular ' . $product . ' amounting to ₱ ' . $itemPrice . '<br>';
                $totalAmount += $itemPrice;  
                $totalItems += $quantity;
            }

            // Display total items and amount
            echo "<br><br><b>Total number of items: $totalItems</b><br>";
            echo "<b>Total amount: ₱ $totalAmount</b><br>"; 
        } else {
            echo "<hr>No product selected.";
        }
    }
    ?>
</body>
</html>
