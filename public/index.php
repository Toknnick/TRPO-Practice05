<?php
require_once dirname(__FILE__) . '/../src/Model/Product.php';
require_once dirname(__FILE__) . '/../src/Model/Category.php';
require_once dirname(__FILE__) . '/../src/Service/CatalogService.php';
require_once dirname(__FILE__) . '/../src/functions.php';

$catalog = new CatalogService(
    dirname(__FILE__) . '/../data/products.json',
    dirname(__FILE__) . '/../data/categories.json'
);

$products = $catalog->getProducts();
$categories = $catalog->getCategories();
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Каталог товаров — ТРПО практика 5</title>
</head>
<body>
  <main>
    <h1>Каталог товаров</h1>
    <p>Категорий: <?= e((string) count($categories)) ?></p>
    <p>Товаров: <?= e((string) count($products)) ?></p>

    <ul>
      <?php foreach ($products as $product): ?>
        <li><?= e($product->label()) ?></li>
      <?php endforeach; ?>
    </ul>
  </main>
</body>
</html>
