<?php 
    include_once('config/Connection.php');

    $sql = $conn->prepare("DELETE FROM contacts WHERE id = :id");
    $sql->bindParam(':id', $_GET['id']);
    
    if ($sql->execute()) {
        header('Location: index.php?status=true');
    } else {
        header('Location: index.php?status=false');
    }