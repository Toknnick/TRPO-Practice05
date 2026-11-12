<?php
require_once dirname(__FILE__) . '/../src/Model/Product.php';
require_once dirname(__FILE__) . '/../src/Model/Category.php';
require_once dirname(__FILE__) . '/../src/functions.php';

$category = new Category(2, 'Оборудование');
$product = new Product(1, 'Товар 1', 436.5, 2);
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
    <p>Категория: <?= e($category->getName()) ?></p>
    <p>
      Товар: <?= e($product->getName()) ?>,
      цена: <?= e((string) $product->getPrice()) ?>,
      Id: <?= e((string) $product->getCategoryId()) ?>
    </p>
  </main>
</body>
</html>
