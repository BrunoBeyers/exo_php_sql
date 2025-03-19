<?php 
require_once('DBConnexion.php');

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
  <title>Hacker Referencing</title>
</head>
<body class="bg-slate-900 h-screen flex flex-col justify-between">
  <header class="text-center text-white text-4xl font-bold pt-12">
    Hacker Referencing
  </header>
  <main class="flex-grow flex flex-col justify-center items-center">
    <div class="container flex flex-row justify-around items-center w-full mt-8">
      <table class="table_hackers w-2/5 bg-gray-800 rounded-lg shadow-lg">
        <caption class="text-white text-2xl mb-4">List of Registered Hackers</caption>
        <thead>
          <tr class="text-white bg-violet-600 text-center">
            <th scope="col" class="py-2">Name</th>
            <th scope="col" class="py-2">Address</th>
            <th scope="col" class="py-2">Side</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($data_hackers as $hacker): ?>
          <tr class="bg-white hover:bg-violet-600 text-center cursor-pointer transition duration-300 ease-in-out transform hover:scale-105 hover:text-white" data-id="<?php echo $hacker['id'] ?>" data-name="<?php echo $hacker['name'] ?>">  
            <td class="py-2 border-b border-gray-200"><?php echo $hacker['name']; ?></td>
            <td class="py-2 border-b border-gray-200"><?php echo $hacker['address']; ?></td>
            <td class="py-2 border-b border-gray-200"><?php 
            if($hacker['type'] == 'BLACK HAT'){
              echo 'BLACK HAT⚠️';
            }else if ($hacker['type'] == 'UNKNOWN'){
              echo 'UNKNOWN❓';  
            }else{
              echo 'WHITE HAT';
            }
          ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <div class="containerDataStolen flex flex-col justify-center items-center w-2/5 bg-gray-800 rounded-lg shadow-lg p-4">
        <h2 class="teest text-white text-2xl mb-4">No hackers selected</h2>
        <table class="table_stolen_data w-full">
          <thead>
            <tr class="noDataTr hidden text-white text-center bg-violet-600">
              <th scope="col" class="py-2">Hack name</th>
              <th scope="col" class="py-2">Location</th>
              <th scope="col" class="py-2">Estimate value</th>
              <th scope="col" class="py-2">Hack level</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($data_stolen as $stolen): ?>
            <tr class="bg-white hover:bg-violet-600 hidden text-center transition duration-300 ease-in-out transform hover:scale-105 hover:text-white" data-hacker-id="<?php echo $stolen['hacker_id'] ?>"> 
              <td class="py-2 border-b border-gray-200"><?php echo $stolen['hack_name']; ?></td>
              <td class="py-2 border-b border-gray-200"><?php echo $stolen['location']; ?></td>
              <td class="py-2 border-b border-gray-200"><?php echo $stolen['estimate_value']; ?></td>
              <td class="py-2 border-b border-gray-200 <?php 
                if ($stolen['steal_status'] == 'CRITICAL') {
                  echo 'bg-red-500 text-white';
                } elseif ($stolen['steal_status'] == 'NOT CRITICAL') {
                  echo 'bg-yellow-500 text-black';
                } else {
                  echo 'bg-orange-500 text-white';
                }
              ?>">
                <?php echo $stolen['steal_status']; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <h2 class="noDataTitle hidden text-white text-xl mt-4">No stolen data for this hacker</h2>
      </div>
    </div>
  </main>
  <footer class="bg-gray-800 text-white text-center py-4">
    <p class="text-gray-400">© 2025 IFAPME / Jean-Pierre Olivier _ Beyers Bruno</p>
  </footer>
  <script src="js/script.js"></script>
</body>
</html>