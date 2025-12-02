<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Admin Panel</title>
</head>
<body class="bg-gray-100">
	<div class="container mx-auto px-4 py-8">
		<div class="flex justify-between items-center mb-6">
			<h1 class="text-3xl font-bold">Admin Panel</h1>
			<div class="space-x-4">
				<a href="/" class="text-blue-500 hover:underline">View Projects</a>
				<a href="/admin/logout" class="text-red-500 hover:underline">Logout</a>
			</div>
		</div>

		<?php if (isset($success)) { ?>
			<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
				<?= htmlspecialchars($success) ?>
			</div>
		<?php } ?>

		<?php if (isset($error)) { ?>
			<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
				<?= htmlspecialchars($error) ?>
			</div>
		<?php } ?>

		<div class="bg-white shadow rounded-lg p-6">
			<h2 class="text-2xl font-semibold mb-4">Create New Project</h2>
			<form method="POST" action="/admin">
				<div class="mb-4">
					<label class="block text-gray-700 text-sm font-bold mb-2" for="name">
						Project Name *
					</label>
					<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" required>
				</div>
				<div class="mb-4">
					<label class="block text-gray-700 text-sm font-bold mb-2" for="desc">
						Description *
					</label>
					<textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="desc" name="desc" rows="3" required></textarea>
				</div>
				<div class="mb-4">
					<label class="block text-gray-700 text-sm font-bold mb-2" for="link">
						Link *
					</label>
					<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="link" name="link" type="url" required>
				</div>
				<div class="mb-6">
					<label class="block text-gray-700 text-sm font-bold mb-2" for="cat">
						Category *
					</label>
					<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cat" name="cat" type="text" list="categories" required>
					<datalist id="categories">
						<?php foreach($categories as $category) { ?>
							<option value="<?= htmlspecialchars($category) ?>">
						<?php } ?>
					</datalist>
				</div>
				<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
					Create Project
				</button>
			</form>
		</div>
	</div>
</body>
</html>

