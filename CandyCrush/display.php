<?php
require 'dbcon.php';

// Fetch all candies from the database
$stmt = $pdo->query("SELECT * FROM candies");
$candies = $stmt->fetchAll();
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
    <title>Candy Crush - Candy List</title>
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar -->
<div class="container candy-container mt-5">
    <h2 class="text-center candy-title mb-4">Candy List</h2>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Candy Name</th>
                <th scope="col">Candy Type</th>
                <th scope="col">Stock Available</th>
                <th scope="col">Price Per Unit ($)</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candies as $index => $candy): ?>
                <tr class="table-row" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <td><?php echo htmlspecialchars($candy['CandyName']); ?></td>
                    <td><?php echo htmlspecialchars($candy['CandyType']); ?></td>
                    <td><?php echo htmlspecialchars($candy['StockAvailable']); ?></td>
                    <td><?php echo htmlspecialchars($candy['PricePerUnit']); ?></td>
                    <td class="text-center">
                        <a href="form.php?edit=<?php echo $candy['CandyID']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="form.php" class="btn btn-primary mt-3">Add New Candy</a>
</div>
</body>
</html>
