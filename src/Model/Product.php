<?php
final class Product
{
    public function __construct(
        private int $id,
        private string $name,
        private float $price,
        private int $categoryId,
        private bool $active = true
    ) {
        $this->name = trim($name);

        if ($id <= 0) {
            throw new InvalidArgumentException('id должен быть положительным');
        }

        if ($name === '') {
            throw new InvalidArgumentException('name не может быть пустым');
        }

        if ($price < 0) {
            throw new InvalidArgumentException('price не может быть отрицательным');
        }

        if ($categoryId <= 0) {
            throw new InvalidArgumentException('categoryId должен быть положительным');
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function formattedPrice(): string
    {
        return number_format($this->price, 2, '.', ' ') . ' ₽';
    }

    public function belongsToCategory(int $categoryId): bool
    {
        return $this->categoryId === $categoryId;
    }

    public function isExpensive(float $threshold = 1000.0): bool
    {
        return $this->price >= $threshold;
    }

    public function label(): string
    {
        $status = $this->active ? 'в наличии' : 'недоступен';
        return $this->name . ' — ' . $this->formattedPrice() . ' (' . $status . ')';
    }
}