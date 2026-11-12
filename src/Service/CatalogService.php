<?php
final class CatalogService
{
    public function __construct(
        private string $productsPath,
        private string $categoriesPath
    ) {
    }

    public function getProducts(): array
    {
        $rows = $this->loadJson($this->productsPath);
        $products = [];

        foreach ($rows as $row) {
            $products[] = new Product(
                (int) $row['id'],
                (string) $row['name'],
                (float) $row['price'],
                (int) $row['category_id'],
                (bool) $row['active']
            );
        }

        return $products;
    }

    public function getCategories(): array
    {
        $rows = $this->loadJson($this->categoriesPath);
        $categories = [];

        foreach ($rows as $row) {
            $categories[] = new Category(
                (int) $row['id'],
                (string) $row['name']
            );
        }

        return $categories;
    }

    private function loadJson(string $path): array
    {
        if (!is_file($path)) {
            throw new RuntimeException('Файл не найден: ' . $path);
        }

        $json = file_get_contents($path);
        if ($json === false) {
            throw new RuntimeException('Не удалось прочитать: ' . $path);
        }

        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new RuntimeException('Некорректный JSON: ' . $path);
        }

        return $data;
    }

    public function filterByCategory(array $products, ?int $categoryId): array
    {
        if ($categoryId === null) {
            return $products;
        }
        $filtered = [];
        foreach ($products as $product) {
            if ($product->belongsToCategory($categoryId)) {
                $filtered[] = $product;
            }
        }
        return $filtered;
    }
    public function averagePrice(array $products): float
    {
        if ($products === []) {
            return 0.0;
        }
        $sum = 0.0;
        foreach ($products as $product) {
            $sum += $product->getPrice();
        }
        return $sum / count($products);
    }
}