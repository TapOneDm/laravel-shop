<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} — Купить</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 0 auto; padding: 40px; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; }
        .product-box { display: flex; gap: 40px; border: 1px solid #eee; padding: 30px; border-radius: 8px; }
        .info { flex-grow: 1; }
        .price { font-size: 1.8em; color: #28a745; font-weight: bold; margin: 15px 0; }
        .badge { background: #6c757d; color: white; padding: 4px 8px; font-size: 0.8em; text-transform: uppercase; border-radius: 3px; }
        .btn-buy { background: #ffc107; color: #212529; padding: 12px 25px; border: none; font-size: 1.1em; font-weight: bold; border-radius: 5px; cursor: pointer; }
        .msg-success {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: green;
            padding: 10px;
            border: 1px solid green;
        }
    </style>
</head>
<body>
    <a href="/" class="back-link">← Вернуться в каталог</a>

    @if(session('success'))
        <div class="msg-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-box">
        <div class="info">
            <span class="badge">{{ $product->category->name }}</span>
            <h1>{{ $product->name }}</h1>
            <p style="color: #666; line-height: 1.6;">{{ $product->description }}</p>

            <div class="price">{{ number_format($product->price / 100, 2, '.', ' ') }} ₽</div>

            @if($product->quantity > 0)
                <p style="color: #28a745;">✔ В наличии ({{ $product->quantity }} шт.)</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-buy">Добавить в корзину</button>
                </form>
            @else
                <p style="color: #dc3545; font-weight: bold;">✕ Нет в наличии</p>
            @endif
        </div>
    </div>

</body>
</html>
