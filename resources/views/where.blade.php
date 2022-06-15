@extends("layout")

@section("content")

	<div class="head">Контактные данные</div>
	<p>Адрес: улица 2</p>
	<p>Номер телефона: 99999999999</p>
	<p>E-mail: 1@1</p>

	<div class="head">Наше местоположение</div>
	<img src="{{ asset('public/images/map.png') }}" alt="">

@endsection