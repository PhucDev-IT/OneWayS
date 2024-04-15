@extends('layouts.app')

@section('content')

<style>
	.classify-item {
		padding: 10px;
		border: 1px solid;
		border-radius: 10px;
		margin: 5px;
	}

	.classify-item:hover {
		background-color: #f75f52;
		color: #ffffff;
		transition: all 0.3s ease;
		border-color: yellow;
	}

	.classify-option {
		display: flex;
		flex-wrap: wrap;
	}

	.selected {
		background-color: #f75f52;
		/* Đổi màu nền thành đỏ */
		color: white;
		/* Đổi màu chữ thành trắng */
	}
</style>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="#">Home</a></li>
					<li><a href="#">All Categories</a></li>
					<li><a href="#">Accessories</a></li>
					<li><a href="#">Headphones</a></li>
					<li class="active">Product name goes here</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="{{ asset('storage/uploads/'.$product->img_preview) }}" alt="error">
					</div>
					@foreach($product->images as $img)
					<div class="product-preview">
						<img src="{{ asset('storage/uploads/'.$img->url) }}" alt="error">
					</div>
					@endforeach
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<div class="product-preview">
						<img src="{{ asset('storage/uploads/'.$product->img_preview) }}" alt="error">
					</div>
					@foreach($product->images as $img)
					<div class="product-preview">
						<img src="{{ asset('storage/uploads/'.$img->url) }}" alt="error">
					</div>
					@endforeach
				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5">
				<div class="product-details">
					<input type="text" hidden value="{{$product->id}}" id="product-id">
					<h2 class="product-name">{{$product->name}}</h2>
					<div>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<a class="review-link" href="#">10 Review(s) | Add your review</a>
					</div>
					<div>
						<h3 class="product-price">{{ number_format($product->price - ($product->price * $product->sale)/100, 0, ',', '.') }} đ <del class="product-old-price">{{ number_format($product->price, 0, ',', '.') }}đ</del></h3>
						<span class="product-available">Còn lại: </span> <label id="remaining" style="font-size: 12px; margin-left: 4px;" for=""></label>
					</div>
					<p style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 4; -webkit-box-orient: vertical;">{{$product->description}}</p>

					<div>
						<label for="">Bảo hành: </label>
						<span>{{$product->guarantee_time}} tháng</span>
					</div>
					<div>
						<label for="">Hãng sản xuất: </label>
						<span>{{$product->supplier->name}}</span>
					</div>
					<div class="product-options">
						<label>
							Color:
						</label>

						<div class="classify-option">
							@foreach($product->details as $item)
							<span onclick="selectedColor(this);" id="color_{{$item->id}}" data-color="{{$item->color}}" data-quantity="{{$item->quantity}}" class="classify-item">{{$item->color}}</span>
							@endforeach
						</div>


					</div>

					<div class="add-to-cart">
						<div class="qty-label">
							Số lượng
							<div class="input-number">
								<input id="input-quantity" type="number" value="1">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						@if (Route::has('login'))
						@auth
						<button onclick="addToCart('{{$product->id}}')" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
						@else
						<a href="{{ route('login') }}" class="btn btn-primary btn-lg">Đăng nhập</a>
						@endauth
						@endif

					</div>

					<ul class="product-links">
						<li>Danh mục:</li>
						@foreach($product->categories as $item)
						<li><a href="#">{{$item->name}}</a></li>
						@endforeach

					</ul>

					<ul class="product-links">
						<li>Share:</li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					</ul>

				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab2">Details</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p>{{$product->description}}</p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div class="col-md-3">
									<div id="rating">
										<div class="rating-avg">
											<span>4.5</span>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
											</div>
										</div>
										<ul class="rating">
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 80%;"></div>
												</div>
												<span class="sum">3</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 60%;"></div>
												</div>
												<span class="sum">2</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul id="row-reviews" class="reviews">
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>

												<div class="review-body">
													<span style="font-weight: 600; color: #857c6e; margin-bottom: 4px;">Tai nghe chụp Buetooth chất lượng cao MW93 -  Đen</span>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>

										</ul>
										<ul class="reviews-pagination">
											<li class="active">1</li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- /Reviews -->


								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>
				</div>
			</div>





			<div class="clearfix visible-sm visible-xs"></div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->
@endsection

@section('script')

<script>
	let mColor = null
	//Chọn color
	function selectedColor(element) {
		var id = element.id; // Lấy ra id của phần tử
		var quantity = element.getAttribute('data-quantity'); // Lấy ra giá trị của thuộc tính data-quantity

		mColor = element.getAttribute('data-color');

		document.querySelector('#remaining').innerHTML = quantity


		var classifyItems = document.querySelectorAll('.classify-item');
		classifyItems.forEach(function(item) {
			item.classList.remove('selected');
		});

		// Thêm lớp 'selected' cho phần tử được chọn
		element.classList.add('selected');
	}

	function addToCart(idProduct) {

		if (mColor == null) {
			alert('Vui lòng chọn màu sản phẩm');
		} else {
			var remaining = parseInt(document.querySelector('#remaining').innerHTML);
			var quantity = parseInt(document.querySelector('#input-quantity').value);

			if (quantity > remaining) {
				alert('Số lượng còn lại không đủ!');
			} else {

				$.ajax({
					type: 'POST',
					url: "{{ route('cart.addToCart') }}",
					data: {
						_token: '{{ csrf_token() }}',
						idProduct: idProduct,
						quantity: quantity,
						color: mColor
					},
					dataType: "json",
					success: function(response) {
						alert('thêm thành công');
					},
					error: function(xhr, status, error) {
						console.error(error);
						alert('có lỗi xảy ra');
					}
				});
			}

		}
	}
	fetchReviews($('#product-id').val());
	//Lấy đánh giá sản phẩm
	function fetchReviews(idProduct) {

		$.ajax({
			type: 'get',
			url: "{{route('products.reviews')}}",
			data: {
				id: idProduct
			},
			dataType: 'json',
			success: function(response) {
				console.log(response);
				$.each(response,function(key,review){
					renderReviews(review);
				});
			},
			error: function(xhr, err) {
				console.log(err);
			}
		});
	}

	function renderReviews(review) {
    var html = `
    <li>
        <div class="review-heading">
            <h5 class="name">${review.user.name}</h5>
            <p class="date">${review.time}</p>
            <div class="review-rating">`;

		// Thêm sao đánh giá vào HTML dựa trên rating
		for (var i = 0; i < review.rating; i++) {
			html += `<i class="fa fa-star"></i>`;
		}

    html += `
            </div>
        </div>
        <div class="review-body">
		<span style="font-weight: 600; color: #857c6e; margin-bottom: 4px;">${review.title}</span>
            <p>${review.comment}</p>
        </div>
    </li>
    `;
    
    $('#row-reviews').append(html);
}

</script>
@endsection