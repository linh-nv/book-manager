<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="heading">
        <h1>Update Employee</h1>
    </div>
    <a href="index.php" class="add-employee">Back to List</a>
    <div class="add-content">
        <form class="form-box" action="index.php?action=update" method="post">
            <div class="form-input">
                <input type="hidden" name="id" id="id" value="<?php echo $employee['id']; ?>" required>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo $employee['name']; ?>" required>
                </div>
            </div>
            <div class="form-input">

                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="text" name="age" id="age" value="<?php echo $employee['age']; ?>" required>
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $employee['email']; ?>">
                </div>
            </div>

            <div class="form-button">
                <button>
                Update
                </button>
            </div>
        </form>
    </div>
</body>
</html>