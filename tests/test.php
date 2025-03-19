<?php 
require_once('../DBConnexion.php');

$db = new ConnectionDB();

function findAll($conn, $tableName)
{
  try {
    $stmt = $conn->prepare("SELECT * FROM $tableName");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    return null;
  }
}

$data_hackers = findAll($db->getConnection(), 'hackers');
$data_stolen = findAll($db->getConnection(), 'stolen_data');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Test connexion</title>
</head>
<body class="bg-purple-500 flex flex-col justify-center items-center h-screen">
    <p class="text-white text-4xl"><?php if ( isset($data_hackers) && isset($data_stolen) ) {
          echo "Connection to the database is functional";
    }else{
        echo "Error when connecting to the database";
    } ?></p>
 
</body>
</html>