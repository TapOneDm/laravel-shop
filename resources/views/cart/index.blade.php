<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ваша корзина</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .total { font-size: 18px; font-weight: bold; text-align: right; }
    </style>
</head>
<body>

    <h1>🛒 Ваша корзина</h1>

    <a href="{{ url('/') }}">⬅️ Вернуться в каталог</a>
    <br><br>

    @if(empty($cart))
        <p>Ваша корзина пока пуста.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] / 100 }} руб.</td>
                        
                        <!-- Управление количеством -->
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <!-- Кнопка Минус -->
                                <form action="{{ route('cart.decrease', $id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit" style="padding: 2px 8px;">-</button>
                                </form>

                                <span>{{ $item['quantity'] }} шт.</span>

                                <!-- Кнопка Плюс -->
                                <form action="{{ route('cart.increase', $id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit" style="padding: 2px 8px;">+</button>
                                </form>
                            </div>
                        </td>

                        <td>{{ ($item['price'] * $item['quantity']) / 100 }} руб.</td>
                        
                        <!-- Кнопка Полного Удаления -->
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('DELETE') <!-- Эмуляция DELETE запроса в Laravel -->
                                <button type="submit" style="color: red; border: 1px solid red; background: none; cursor: pointer; padding: 2px 5px;">
                                    ❌ Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="total">
            Итого к оплате: {{ $totalPrice / 100 }} руб.
        </div>
    @endif

</body>
</html>
