# Практическая работа 5 — ТРПО

PHP ООП: классы, конструкторы и модели предметной области.

**Студент:** Юшин Максим  
**Группа:** ЭПБО-01-25

## Результат

Каталог товаров из JSON: классы `Product` и `Category`, сервис `CatalogService`, фильтр по категории, средняя цена, HTML-карточки.

## Технологии

- PHP 8+
- HTML / CSS
- JSON dataset

## Запуск

1. Установите PHP 8+ (`php -v`).
2. В корне проекта:

```bash
php -S localhost:8000 -t public
```

3. Откройте http://localhost:8000  
4. Остановка: `Ctrl+C`.

## Структура проекта

- `public/index.php` — точка входа, GET-фильтр, HTML
- `public/style.css` — стили
- `src/Model/Product.php`, `Category.php` — модели предметной области
- `src/Service/CatalogService.php` — загрузка JSON, фильтр, средняя цена
- `src/functions.php` — `e()`, `categoryNameById()`
- `data/` — рабочие копии данных
- `dataset/` — исходный dataset задания
- `README.md`
- `.gitignore`

## Схема ответственности

```text
products.json / categories.json
        │
        ▼
 CatalogService  — читает JSON, создаёт объекты, фильтрует, считает среднюю цену
        │
        ├── Product   — один товар (данные + предметные методы)
        └── Category  — одна категория
        │
        ▼
 public/index.php — запрос пользователя (GET) и HTML-карточки
```

- **Product / Category** — состояние и поведение объекта, без HTML.
- **CatalogService** — работа с файлами и набором объектов.
- **index.php** — ввод (фильтр) и отображение; модели внутрь разметки не тащим.

## Dataset

- `products.json` — товары (`id`, `name`, `price`, `category_id`, `active`)
- `categories.json` — категории
- `class_requirements.csv` — обязательные свойства классов

## Почему ручной require_once неудобен при росте проекта

Сейчас классы подключаются явно через `require_once`. Пока файлов мало — это нормально. При росте проекта легко забыть подключение, продублировать его или перепутать порядок. Обычно дальше подключают **Composer autoload (PSR-4)**: по имени класса файл находится автоматически, без длинного списка `require_once`.

## Проверка

1. Главная показывает товары из `data/products.json` и среднюю цену.
2. Фильтр по категории меняет список и URL (`?category_id=2`).
3. Конструктор `Product` отвергает некорректные значения через `InvalidArgumentException`.
