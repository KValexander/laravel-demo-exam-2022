@extends("layout")

@section("content")

	<div class="head">Новинки компании</div>
	<div class="row main">
		<div class="col">
			<img src="{{ asset('public/logo/logo.png') }}" alt="">
			<h3>Название</h3>
		</div>
		<div class="col">
			<img src="{{ asset('public/logo/logo.png') }}" alt="">
			<h3>Название</h3>
		</div>
		<div class="col">
			<img src="{{ asset('public/logo/logo.png') }}" alt="">
			<h3>Название</h3>
		</div>
		<div class="col">
			<img src="{{ asset('public/logo/logo.png') }}" alt="">
			<h3>Название</h3>
		</div>
		<div class="col">
			<img src="{{ asset('public/logo/logo.png') }}" alt="">
			<h3>Название</h3>
		</div>
	</div>

	<div class="head" id="register">Регистрация</div>
	<form action="{{ route('register') }}" method="POST">
		@csrf
		<input type="text" name="name" placeholder="Имя" pattern="[а-яА-я\s\-]+" required>
		<input type="text" name="surname" placeholder="Фамилия" pattern="[а-яА-я\s\-]+" required>
		<input type="text" name="patronymic" placeholder="Отчество" pattern="[а-яА-я\s\-]*">

		<input type="text" name="login" placeholder="Логин" pattern="[a-zA-Z1-9\-]+" required>
		<input type="email" name="email" placeholder="E-mail" required>

		<input type="password" name="password" placeholder="Пароль" required>
		<input type="password" name="password_repeat" placeholder="Подтверждение пароля" required>

		<div class="part">
			<input type="checkbox" required>
			Согласие с правилами регистрации
		</div>

		<button>Зарегистрироваться</button>
	</form>

	<div class="head" id="login">Войти</div>

	<form action="{{ route('login') }}" method="POST">
		@csrf
		<input type="text" name="login" placeholder="Логин" required>
		<input type="password" name="password" placeholder="Пароль" required>

		<button>Войти</button>
	</form>

@endsection