<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CopyStar</title>
	<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
	<script src="{{ asset('public/js/script.js') }}"></script>
	@yield("script")
</head>
<body>

	<header>
		<div>
			<div>
				<img src="{{ asset('public/images/image.png') }}" alt="">
				<h1>CopyStar</h1>
			</div>
			<h2>Лучшие в своей сфере!</h2>
		</div>
		<div class="content">
			<nav>
				<p><a href="{{ route('main_page') }}">О нас</a></p>
				<p><a href="{{ route('where_page') }}">Где нас найти</a></p>
				<p><a href="{{ route('catalog_page') }}">Каталог</a></p>
				@if($role == "user" || $role == "admin")
					<p><a href="{{ route('cart_page') }}">Корзина</a></p>

					@if($role == "admin")
						<p><a href="{{ route('admin_page') }}">Заказы</a></p>
					@endif

					<p><a href="{{ route('logout') }}">Выйти</a></p>
				@else
					<p><a href="{{ route('main_page') }}#register">Регистрация</a></p>
					<p><a href="{{ route('main_page') }}#login">Войти</a></p>
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
		<div class="content">
			<h1>Демоэкзамен</h1>
		</div>
	</footer>
	
</body>
</html>