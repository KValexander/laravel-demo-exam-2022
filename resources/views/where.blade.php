@extends("layout")

@section("content")

	<div class="head">Контактные данные</div>
	<p>Адрес: <b>ул. Пушкина, д. 2</b></p>
	<p>Номер телефона: <b>8 800 555 35 35</b></p>
	<p>E-mail: <b>email@mail.com</b></p>

	<div class="head">Наше местонахождение</div>
	<img src="{{ asset('public/images/map.jpg') }}" alt="">

@endsection