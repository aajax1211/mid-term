<?php
require 'dbcon.php';

$candyId = '';
$candyName = '';
$candyType = '';
$stockAvailable = '';
$pricePerUnit = '';

// Check if an edit request is made
if (isset($_GET['edit'])) {
    // Get the candy ID from the query string
    $candyId = $_GET['edit'];

    // Prepare and execute a SQL statement to fetch the candy details
    $stmt = $pdo->prepare("SELECT * FROM candies WHERE CandyID = ?");
    $stmt->execute([$candyId]);
    $candy = $stmt->fetch();

    // Populate the variables with the fetched candy data
    $candyName = $candy['CandyName'];
    $candyType = $candy['CandyType'];
    $stockAvailable = $candy['StockAvailable'];
    $pricePerUnit = $candy['PricePerUnit'];
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $candyName = $_POST['candyName'];
    $candyType = $_POST['candyType'];
    $stockAvailable = $_POST['stockAvailable'];
    $pricePerUnit = $_POST['pricePerUnit'];

    // Check if the candy ID is set for updating an existing candy
    if (isset($_POST['candyId']) && !empty($_POST['candyId'])) {
        // Prepare and execute an SQL statement to update the candy details
        $stmt = $pdo->prepare("UPDATE candies SET CandyName = ?, CandyType = ?, StockAvailable = ?, PricePerUnit = ? WHERE CandyID = ?");
        $stmt->execute([$candyName, $candyType, $stockAvailable, $pricePerUnit, $_POST['candyId']]);
    } else {
        // Insert a new candy into the database
        $stmt = $pdo->prepare("INSERT INTO candies (CandyName, CandyType, StockAvailable, PricePerUnit) VALUES (?, ?, ?, ?)");
        $stmt->execute([$candyName, $candyType, $stockAvailable, $pricePerUnit]);
    }

    header('Location: display.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Candy Crush - Add Candy</title>
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar -->
<div class="container candy-container mt-5">
    <h2 class="text-center candy-title mb-4"><?php echo empty($candyId) ? "Add New Candy" : "Edit Candy"; ?></h2>
    
    <!-- Candy form for adding or editing candy details -->
    <form method="post" action="form.php" class="p-4 rounded candy-form shadow-sm">
        <input type="hidden" name="candyId" value="<?php echo $candyId; ?>">
        <div class="mb-3">
            <label for="candyName" class="form-label">Candy Name</label>
            <input type="text" class="form-control" name="candyName" value="<?php echo $candyName; ?>" required>
        </div>
        <div class="mb-3">
            <label for="candyType" class="form-label">Candy Type</label>
            <input type="text" class="form-control" name="candyType" value="<?php echo $candyType; ?>">
        </div>
        <div class="mb-3">
            <label for="stockAvailable" class="form-label">Stock Available</label>
            <input type="number" class="form-control" name="stockAvailable" value="<?php echo $stockAvailable; ?>" required>
        </div>
        <div class="mb-3">
            <label for="pricePerUnit" class="form-label">Price Per Unit ($)</label>
            <input type="text" class="form-control" name="pricePerUnit" value="<?php echo $pricePerUnit; ?>" required>
        </div>
        
        <button type="submit" class="btn btn-success w-100"><?php echo empty($candyId) ? "Submit" : "Update"; ?></button>
    </form>
</div>
</body>
</html>
