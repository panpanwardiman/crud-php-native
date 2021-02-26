<?php
    include_once('config/Connection.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = $conn->prepare("UPDATE contacts SET name=:name, email=:email, phone=:phone, address=:address WHERE id = :id");

        $sql->bindParam(':id', $_GET['id']);
        $sql->bindParam(':name', $_POST['name']);
        $sql->bindParam(':email', $_POST['email']);
        $sql->bindParam(':phone', $_POST['phone']);
        $sql->bindParam(':address', $_POST['address']);
        
        if ($sql->execute()) {
            header('Location: index.php?status=true');
        } else {
            header('Location: index.php?status=false');
        }
    } else {
        $sql = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
        $sql->bindParam(":id", $_GET['id']);
        $sql->execute();
        $contact = $sql->fetch();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new Contact</title>
    <link rel="stylesheet" href="./asset/style.css">
</head>
<body>
    <div class="container">
        <h1>Create new Contact</h1>
        <form action="" method="POST">
            <table>
                <tr>
                    <td width="150">Nama</td>
                    <td ><input type="text" name="name" value="<?= $contact['name'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td ><input type="email" name="email" value="<?= $contact['email'] ?>"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td ><input type="text" name="phone" value="<?= $contact['phone'] ?>"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td ><textarea name="address" cols="22" rows="5"><?= $contact['address'] ?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="flex justify-between">
                        <a href="delete.php?id=<?= $contact['id'] ?>">Delete</a>
                        <button type="submit">Update</button>
                    </td>
                </tr>
            </table>
        </form>        
    </div>
</body>
</html>