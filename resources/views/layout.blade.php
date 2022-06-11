<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Copy Star</title>
	<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
	<script src="{{ asset('public/script/script.js') }}"></script>
	@yield("script")
</head>
<body>

	<header>

		<div class="logo">
			<div>
				<img src="{{ asset('public/logo/logo.png') }}" alt="">
				<h1><a href="{{ route('main_page') }}">Copy Star!</a></h1>
			</div>
			<h2>Величайшие уже более 10 лет!</h2>
		</div>

		<div class="content">
			<nav class="row">
				<p><a href="{{ route('main_page') }}">О нас</a></p>
				<p><a href="{{ route('catalog_page') }}">Каталог</a></p>
				<p><a href="{{ route('where_page') }}">Где нас найти</a></p>

				@if($role == "guest")
					<p><a href="{{ route('main_page') }}#register">Регистрация</a></p>
					<p><a href="{{ route('main_page') }}#login">Войти</a></p>
				@else
					<p><a href="{{ route('cart_page') }}">Корзина</a></p>
					@if($role == "admin")
						<p><a href="{{ route('admin_page') }}">Заказы</a></p>
					@endif
					<p><a href="{{ route('logout') }}">Выход</a></p>
				@endif

			</nav>
		</div>

	</header>

	<div class="message">{{ $errors->message->first() }}</div>

	<main>
		<div class="content">
			
			@yield("content")

		</div>
	</main>

	<footer>
		<div class="content text-center">
			<h2>Демонстрационный экзамен 2022</h2>
		</div>
	</footer>

	
</body>
</html>