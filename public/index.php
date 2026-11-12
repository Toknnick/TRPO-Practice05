<?php
require_once dirname(__FILE__) . '/../src/Model/Product.php';
require_once dirname(__FILE__) . '/../src/Model/Category.php';
require_once dirname(__FILE__) . '/../src/Service/CatalogService.php';
require_once dirname(__FILE__) . '/../src/functions.php';

$catalogService = new CatalogService(
    dirname(__FILE__) . '/../data/products.json',
    dirname(__FILE__) . '/../data/categories.json'
);

$productsWtithoutFilter = $catalogService->getProducts();
$categories = $catalogService->getCategories();

$rawCategoryId = trim($_GET['category_id'] ?? '');
$filterCategoryId = $rawCategoryId === '' ? null : (int) $rawCategoryId;

$products = $catalogService->filterByCategory($productsWtithoutFilter, $filterCategoryId);
$averagePrice = $catalogService->averagePrice($products);
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Каталог товаров — ТРПО практика 5</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <h1>Каталог товаров</h1>
    <p>Категорий: <?= e(count($categories)) ?></p>
    <p>Товаров (с учётом фильтра): <?= e(count($products)) ?></p>
    <p>Средняя цена: <?= e(number_format($averagePrice, 2, '.', ' ') . ' ₽') ?></p>

    <div class="stats">
  <p>Категорий: <?= e((string) count($categories)) ?></p>
  <p>Товаров (с учётом фильтра): <?= e((string) count($products)) ?></p>
  <p>Средняя цена: <?= e(number_format($averagePrice, 2, '.', ' ') . ' ₽') ?></p>
</div>

  <section class="catalog">
    <?php foreach ($products as $product): ?>
      <article class="card">
        <h2><?= e($product->getName()) ?></h2>
        <p class="price"><?= e($product->formattedPrice()) ?></p>
        <p>Категория: <?= e(categoryNameById($categories, $product->getCategoryId())) ?></p>
        <p>
          <?php if ($product->isActive()): ?>
            <span class="pill">в наличии</span>
          <?php else: ?>
            <span class="pill off">недоступен</span>
          <?php endif; ?>
          <?php if ($product->isExpensive()): ?>
            <span class="pill">дорогой</span>
          <?php endif; ?>
        </p>
      </article>
    <?php endforeach; ?>
  </section>
  </main>
</body>
</html>
