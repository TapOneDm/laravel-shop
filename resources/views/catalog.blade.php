<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Laravel Market — Каталог</title>
    <style>
        body { font-family: sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .main-layout { display: flex; gap: 30px; margin-top: 20px; }
        .sidebar { width: 250px; flex-shrink: 0; background: #f8f9fa; padding: 15px; border-radius: 5px; height: fit-content; }
        .content { flex-grow: 1; }
        .category-link { display: block; padding: 8px 10px; color: #333; text-decoration: none; border-radius: 4px; margin-bottom: 5px; }
        .category-link:hover { background: #e9ecef; }
        .category-link.active { background: #007bff; color: white; font-weight: bold; }
        .filter-panel { background: #f4f4f4; padding: 15px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
        .card { border: 1px solid #ddd; padding: 15px; border-radius: 5px; display: flex; flex-direction: column; justify-content: space-between; }
        .price { font-size: 1.2em; color: #28a745; font-weight: bold; margin: 10px 0; }
        .out-of-stock { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Laravel Market</h1>

    <div class="main-layout">
        
        <!-- БОКОВОЕ МЕНЮ КАТЕГОРИЙ -->
        <aside class="sidebar">
            <h3>Категории</h3>
            <!-- Ссылка на сброс фильтра категорий -->
            <a href="{{ request()->fullUrlWithQuery(['category_id' => null]) }}" 
               class="category-link {{ !request()->has('category_id') ? 'active' : '' }}">
               Все категории
            </a>
            
            @foreach($categories as $category)
                <!-- Хелпер fullUrlWithQuery позволяет подмешивать параметр в текущий URL, сохраняя другие фильтры (цену, сортировку) -->
                <a href="{{ request()->fullUrlWithQuery(['category_id' => $category->id]) }}" 
                   class="category-link {{ request('category_id') == $category->id ? 'active' : '' }}">
                   {{ $category->name }}
                </a>
            @endforeach
        </aside>

        <!-- ОСНОВНОЙ КОНТЕНТ (ФИЛЬТРЫ И ТОВАРЫ) -->
        <main class="content">
            
            <form action="/" method="GET" class="filter-panel">
                <!-- Сохраняем выбранную категорию в скрытом поле, чтобы она не сбрасывалась при изменении цены -->
                @if(request()->has('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif

                <div>
                    <label>Макс. цена:</label>
                    <input type="number" name="price_max" value="{{ $currentFilters['price_max'] ?? '' }}" placeholder="Например, 5000">
                </div>

                <div>
                    <label>Сортировка:</label>
                    <select name="sort">
                        <option value="">Сначала новые</option>
                        <option value="price_asc" {{ ($currentFilters['sort'] ?? '') === 'price_asc' ? 'selected' : '' }}>Дешевые сначала</option>
                        <option value="price_desc" {{ ($currentFilters['sort'] ?? '') === 'price_desc' ? 'selected' : '' }}>Дорогие сначала</option>
                    </select>
                </div>

                <button type="submit">Применить</button>
                <a href="/">Сбросить всё</a>
            </form>

            <div class="grid">
                @forelse ($products as $product)
                    <div class="card">
                        <div>
                            <span style="color: #6c757d; font-size: 0.85em; text-transform: uppercase;">
                                {{ $product->category->name }}
                            </span>
                            <h3>
                                <a href="/products/{{ $product->id }}" style="color: #333; text-decoration: none; hover: underline;">
                                    {{ $product->name }}
                                </a>    
                            </h3>
                            <p>{{ Str::limit($product->description, 80) }}</p>
                        </div>
                        <div>
                            <div class="price">{{ number_format($product->price / 100, 2, '.', ' ') }} ₽</div>
                            @if($product->quantity > 0)
                                <small>В наличии: {{ $product->quantity }} шт.</small>
                            @else
                                <span class="out-of-stock">Нет в наличии</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>В этой категории пока нет товаров или они не подходят под фильтр цены.</p>
                @endforelse
            </div>
            
        </main>
    </div>

</body>
</html>
