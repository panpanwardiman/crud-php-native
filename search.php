<?php
    include_once('config/Connection.php');

    if (isset($_GET['query'])) {
        $sql = $conn->prepare("SELECT * FROM contacts WHERE name LIKE '%' :query '%'");
        $sql->bindParam(':query', $_GET['query']);
        $sql->execute();
        $contacts = $sql->fetchAll();
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud PHP</title>
    <link rel="stylesheet" href="./asset/style.css">
</head>
<body>
    <div class="container">
        <div class="flex justify-between">
            <h1>Crud PHP</h1>
            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status']): ?>
                    <h1 class="green">Successfully!</h1>
                <?php else: ?>
                    <h1 class="red">Failed!</h1>
                <?php endif ?>
            <?php endif ?>
        </div>
        <div class="flex justify-between">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search name">
                <button type="submit" value="search">Search</button>
                <a href="index.php">Refresh</a>
            </form>
            <a href="insert.php">Buat Baru</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($contacts) > 0): ?>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><a href="show.php?id=<?= $contact['id'] ?>"><?= $contact['name'] ?></a></td>
                            <td><?= $contact['email'] ?></td>
                            <td><?= $contact['phone'] ?></td>
                            <td><?= $contact['address'] ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Data kosong!</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>
</html>