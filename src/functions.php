<?php

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function categoryNameById(array $categories, int $categoryId): string
{
    foreach ($categories as $category) {
        if ($category->getId() === $categoryId) {
            return $category->getName();
        }
    }
    return 'Без категории';
}