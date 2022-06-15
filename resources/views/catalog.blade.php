@extends("layout")

@section("content")

	<div class="head">Наши товары</div>

	<div class="row">
		<p>
			<span onclick="sorting('catalog', 'year')">Год производства</span> |
			<span onclick="sorting('catalog', 'name')">Наименование</span> |
			<span onclick="sorting('catalog', 'price')">Цена</span>
		</p>
		<p>
			<select onchange="filtration('catalog', 'category', this.value)">
				<option value="" disabled selected>Категории</option>
				@foreach($categories as $val)
					<option value="{{ $val->category }}">{{ $val->category }}</option>
				@endforeach
			</select>
		</p>
	</div>

	<div class="row" id="catalog">
		@foreach($products as $val)
			<div class="col">
				<img src="{{ asset('public/'. $val->path) }}" alt="">
				<div class="row">
					<h3><a href="{{ route('product_page', ['id' => $val->product_id]) }}" id="name">{{ $val->name }}</a></h3>
					<h4 id="price">{{ $val->price }}$</h4>
					<p class="none" id="year">{{ $val->year }}</p>
					<p class="none" id="category">{{ $val->category }}</p>
				</div>
				@if($role == "admin")
					<div class="row">
						<p>
							<a class="small" href="{{ route('product_update_page', ['id' => $val->product_id]) }}">Редактировать</a>
						</p>
						<p>
							<a class="small" href="{{ route('product_delete', ['id' => $val->product_id]) }}">Удалить</a>
						</p>
					</div>
				@endif
				@if($role != "guest")
					<p class="text-right"><a class="small" href="{{ route('cart_add', ['id' => $val->product_id]) }}">В корзину</a></p>
				@endif
			</div>
		@endforeach
	</div>

@endsection