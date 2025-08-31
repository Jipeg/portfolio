<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once('Db.php');

$db = new Db('db.sqlite');

// Check if the connection is successful
if (! $db) {
  echo "Failed to connect to the SQLite database.";
  die;
}

$categories = [];
$projects = [];
// Get url params
if(isset($_GET['cat'])) {
  $result = $db->query('SELECT * FROM projects WHERE cat = ? ORDER BY id DESC', [$_GET['cat']]);
} else {
  $result = $db->query('SELECT * FROM projects ORDER BY id DESC');
}

while ($data = $result->fetchArray(SQLITE3_ASSOC)) {
  if(! in_array($data['cat'], $categories)) {
    $categories[] = $data['cat'];
  }
  $projects[] = $data;
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Список проектов</title>
</head>
<body>
<?php if( isset($_GET['cat']) ) {?>
  <a href="/" class="text-blue-500 hover:underline absolute">Назад</a>
<?php } ?>
<h1 class="text-3xl font-bold m-auto w-24 mb-3 mt-5">Категории</h1>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-3">
  <?php foreach($categories as $category) { ?>
    <div class="bg-white shadow rounded-lg p-2">
      <h2 class="text-xl font-semibold">
        <a href="?cat=<?= $category ?>" class="text-blue-500 hover:underline">
          <?= $category ?>
        </a>
      </h2>
    </div>
  <?php } ?>
</div>
<h2 class="text-xl font-semibold m-auto w-40 mb-3 mt-5">Все проекты</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
  <?php foreach($projects as $project) { ?>
    <div class="bg-white shadow rounded-lg p-5">
      <h2 class="text-xl font-semibold mb-2"><?= $project['name'] ?></h2>
      <p class="text-gray-600 mb-3"><?= $project['desc'] ?></p>
      <a href="<?= $project['link'] ?>" target="_blank" class="text-blue-500 hover:underline"><?= $project['link'] ?></a>
    </div>
  <?php } ?>
</div>



</body>
</html>
