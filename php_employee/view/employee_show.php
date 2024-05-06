<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="add-content" style="margin: 100px;">
        <div class="form-box" style="padding: 20px;">
            <div class="heading">
                <h1>Employee Details</h1>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <p><strong>ID:</strong> <?php echo $employee['id']; ?></p>
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <p><strong>Name:</strong> <?php echo $employee['name']; ?></p>
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <p><strong>Age:</strong> <?php echo $employee['age']; ?></p>
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <p><strong>Email:</strong> <?php echo $employee['email']; ?></p>
                </div>
            </div>
            <a href="index.php" class="add-employee">Back to List</a>
        </div>
    </div>
</body>
