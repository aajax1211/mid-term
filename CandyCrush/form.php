<?php
require 'dbcon.php';

$candyName = '';
$candyType = '';
$stockAvailable = '';
$pricePerUnit = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candyName = $_POST['candyName'];
    $candyType = $_POST['candyType'];
    $stockAvailable = $_POST['stockAvailable'];
    $pricePerUnit = $_POST['pricePerUnit'];

    // Insert new candy into the database
    $stmt = $pdo->prepare("INSERT INTO candies (CandyName, CandyType, StockAvailable, PricePerUnit) VALUES (?, ?, ?, ?)");
    $stmt->execute([$candyName, $candyType, $stockAvailable, $pricePerUnit]);

    echo "success";
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
    <h2 class="text-center candy-title mb-4">Add New Candy</h2>
    <form method="post" action="form.php" class="p-4 rounded candy-form shadow-sm">
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
        <button type="submit" class="btn btn-success w-100">Submit</button>
    </form>
</div>
</body>
</html>
