<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Список проектов</title>
</head>
<body>
<?php if(isset($_GET['cat'])) {?>
  <a href="/" class="text-blue-500 hover:underline absolute">Назад</a>
<?php } ?>
<h1 class="text-3xl font-bold m-auto w-24 mb-3 mt-5">Категории</h1>
<div class="absolute top-0 right-0">
  <a href="/admin" class="text-red-500 hover:underline">Админка</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-3">
  <?php foreach($categories as $category) { ?>
    <div class="bg-white shadow rounded-lg p-2">
      <h2 class="text-xl font-semibold">
        <a href="?cat=<?= htmlspecialchars($category) ?>" class="text-blue-500 hover:underline">
          <?= htmlspecialchars($category) ?>
        </a>
      </h2>
    </div>
  <?php } ?>
</div>
<h2 class="text-xl font-semibold m-auto w-40 mb-3 mt-5">Все проекты</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
  <?php foreach($projects as $project) { ?>
    <div class="bg-white shadow rounded-lg p-5">
      <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($project['name']) ?></h2>
      <p class="text-gray-600 mb-3"><?= htmlspecialchars($project['desc']) ?></p>
      <a href="<?= htmlspecialchars($project['link']) ?>" target="_blank" class="text-blue-500 hover:underline"><?= htmlspecialchars($project['link']) ?></a>
    </div>
  <?php } ?>
</div>
</body>
</html>

