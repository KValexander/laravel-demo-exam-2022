@extends("layout")

@section("script")
<script>
	window.onload = () => slide(0);
</script>
@endsection

@section("content")
	
	<div class="head">Новинки компании</div>
	<div class="row slider">
		<div class="slides">
			@foreach($products as $val)
				<div class="col">
					<img src="{{ asset('public/'. $val->path) }}" alt="">
					<a href="{{ route('product_page', ['id' => $val->product_id]) }}"><h3>{{ $val->name }}</h3></a>
				</div>
			@endforeach
		</div>
	</div>

	<div class="head" id="register">Регистрация</div>
	<form action="{{ route('register') }}" method="POST">
		@csrf
		<input type="text" name="name" placeholder="Имя" pattern="[А-Яа-я\s\-]+" required>
		<input type="text" name="surname" placeholder="Фамилия" pattern="[А-Яа-я\s\-]+" required>
		<input type="text" name="patronymic" placeholder="Отчество" pattern="[А-Яа-я\s\-]+">

		<input type="text" name="login" placeholder="Логин" pattern="[a-zA-Z\-]+" required>
		<input type="email" name="email" placeholder="E-mail"required>

		<input type="password" name="password" placeholder="Пароль" pattern=".{6,}" required>
		<input type="password" name="password_check" placeholder="Повторение пароля" required>

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