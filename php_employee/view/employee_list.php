<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <section class="dashboard-content">
            <div class="heading">
                <h1>Employee Manager</h1>
            </div>
            <a href="index.php?action=create" class="add-employee">Add Employee</a>
            <div class="list">
                <table id="table-book">
                    <tr class="table-title">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?php echo $employee['id']; ?></td>
                            <td><?php echo $employee['name']; ?></td>
                            <td><?php echo $employee['age']; ?></td>
                            <td><?php echo $employee['email']; ?></td>
                            <td>
                                <a class="show" href="index.php?action=show&id=<?php echo$employee['id']; ?>"><i class="fa-solid fa-circle-info"></i></a>
                                <a class="update" href="index.php?action=edit&id=<?php echo $employee['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="delete" href="index.php?action=delete&id=<?php echo $employee['id']; ?>"><i class="fa-solid fa-delete-left"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                </table>
            </div>
        </section>
</body>
</html>