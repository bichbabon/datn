@extends('../layout')

@section('content')
<style>
	.discount-badge {
		position: absolute;
		right: 15px;
		top: 15px;
		background-color: red;
		color: white;
		padding: 5px 10px;
		border-radius: 5px;
		font-size: 1rem;
		z-index: 1000;
	}

	.productCarousel {
		border-radius: 10px;
	}
</style>
<div class="container" style="height: 70px;">
</div>
<!-- Removed external Bootstrap link as it should be included in the main layout if used consistently across the site -->
<div class="container mt-5">
	<div class="row">
		<div class="col-md-6">
			<!-- Slideshow for product images -->
			<div id="productCarousel" class="carousel slide" data-ride="carousel">
				<div id="discountBadge" class="discount-badge"></div>

				<div class="carousel-inner">
					<!-- Carousel items will be dynamically injected here -->
				</div>
				<a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-md-6">
			<h2 id="productName"></h2>
			<p id="productBrand"></p>
			<h3 id="productPrice"></h3>
			<p id="productDescription"></p>
			<p id="productExtraInfo"></p>
			<!-- Product purchase form -->
			<div id="purchaseForm">
				<div class="form-group">
					<label for="productSize">Size</label>
					<select class="form-control" id="productSize">
						<option value="0">Size</option>
						<!-- Size options will be dynamically injected here -->
					</select>
				</div>
				<div class="form-group">
					<label for="productColor">Màu sắc</label>
					<select class="form-control" id="productColor">
						<option value="0">Color</option>
						<!-- Color options will be dynamically injected here -->
					</select>
				</div>
				<div class="flex-w flex-r-m p-b-10">
					<div class="size-204 flex-w flex-m respon6-next">
						<div class="wrap-num-product flex-w m-r-20 m-tb-10">
							<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
								<i class="fs-16 zmdi zmdi-minus"></i>
							</div>

							<input id="quantity" class="mtext-104 cl3 txt-center num-product" type="number"
								name="num-product" value="1" min="1">

							<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
								<i class="fs-16 zmdi zmdi-plus"></i>
							</div>
						</div>

						<button id='addtocard'
							class="jbutton dark flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
							Thêm vào giỏ hàng
						</button>
					</div>
				</div>
			</div>

		</div>
		<div class="bor10 m-t-50 p-t-43 p-b-40" style="width:100%;margin:20px">
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông tin chi tiết</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh giá</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-43">
					<!-- - -->
					<div class="tab-pane fade show active" id="description" role="tabpanel">
						<div class="how-pos2 p-lr-15-md">
							<p class="stext-102 cl6 " id="description-content">

							</p>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="information" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<ul class="p-lr-28 p-lr-15-sm">
									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Sản xuất
										</span>

										<span class="stext-102 cl6 size-206" id="sanxuat">

										</span>
									</li>

									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Độ cao
										</span>

										<span class="stext-102 cl6 size-206" id="docao">

										</span>
									</li>


								</ul>
							</div>
						</div>
					</div>

					<!-- Review Section -->


					<!-- - -->
					<div class="tab-pane fade" id="reviews" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<div class="p-b-30 m-lr-15-sm" id="reviews-content">
								</div>
								<div id="review-section" class="w-full" style="display: none;">
									<h5 class="mtext-108 cl2 p-b-7">
										Thêm đánh giá
									</h5>
									<div class="flex-w flex-m p-t-50 p-b-23">
										<span class="stext-102 cl3 m-r-16">
											Rating
										</span>

										<span class="wrap-rating fs-18 cl11 pointer">
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<input class="dis-none" type="number" name="rating">
										</span>
									</div>

									<div class="row p-b-25">
										<div class="col-12 p-b-5">
											<label class="stext-102 cl3" for="review">Đánh giá của bạn</label>
											<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review"
												name="review"></textarea>
										</div>
									</div>

									<button id="submit-review"
										class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
										Submit
									</button>
								</div>
								<div id="login-section" class="w-full" style="display: none;">
									<button onclick="redirectToLogin()"
										class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
										Đăng nhập để đánh giá
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="sec-relate-product bg0 p-t-45 p-b-105">
	<div class="container">
		<div class="p-b-45">
			<h3 class="ltext-106 cl5 txt-center">
				Sản phẩm tương tự
			</h3>
		</div>

		<div class="row isotope-grid" id="products-container">
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Esprit Ruffle Shirt
							</a>

							<span class="stext-105 cl3">
								$16.64
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-02.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Herschel supply
							</a>

							<span class="stext-105 cl3">
								$35.31
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item men">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-03.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Only Check Trouser
							</a>

							<span class="stext-105 cl3">
								$25.50
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-04.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Classic Trench Coat
							</a>

							<span class="stext-105 cl3">
								$75.00
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-05.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Front Pocket Jumper
							</a>

							<span class="stext-105 cl3">
								$34.75
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item watches">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-06.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Vintage Inspired Classic
							</a>

							<span class="stext-105 cl3">
								$93.20
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-07.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Shirt in Stretch Cotton
							</a>

							<span class="stext-105 cl3">
								$52.66
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-08.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Pieces Metallic Printed
							</a>

							<span class="stext-105 cl3">
								$18.96
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item shoes">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-09.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Converse All Star Hi Plimsolls
							</a>

							<span class="stext-105 cl3">
								$75.00
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-10.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Femme T-Shirt In Stripe
							</a>

							<span class="stext-105 cl3">
								$25.85
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item men">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-11.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Herschel supply
							</a>

							<span class="stext-105 cl3">
								$63.16
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item men">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-12.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Herschel supply
							</a>

							<span class="stext-105 cl3">
								$63.15
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-13.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								T-Shirt with Sleeve
							</a>

							<span class="stext-105 cl3">
								$18.49
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-14.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Pretty Little Thing
							</a>

							<span class="stext-105 cl3">
								$54.79
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item watches">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-15.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Mini Silver Mesh Watch
							</a>

							<span class="stext-105 cl3">
								$86.85
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="images/product-16.jpg" alt="IMG-PRODUCT">

						<a href="#"
							class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								Square Neck Back
							</a>

							<span class="stext-105 cl3">
								$29.64
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
									alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png"
									alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<script>

	var khachHangId = sessionStorage.getItem('id');

	if (khachHangId) {
		// If khachhang_id is found, show the review form
		document.getElementById('review-section').style.display = 'block';
	} else {
		// If khachhang_id is not found, show the login button
		document.getElementById('login-section').style.display = 'block';
	}

	function redirectToLogin() {
		// Redirect to login page
		window.location.href = '{{route("login")}}';
	}
	document.addEventListener('DOMContentLoaded', function () {
		// Lấy ra các phần tử HTML cần thiết
		const ratingStars = document.querySelectorAll('.item-rating');
		const ratingInput = document.querySelector('input[name="rating"]');
		const reviewTextarea = document.querySelector('textarea[name="review"]');
		const submitButton = document.querySelector('#submit-review');

		// Thêm sự kiện click cho các ngôi sao đánh giá
		ratingStars.forEach(function (star, index) {
			star.addEventListener('click', function () {
				// Cập nhật giá trị đánh giá vào input ẩn
				ratingInput.value = index + 1;

				// Thay đổi trạng thái của các ngôi sao dựa trên đánh giá
				ratingStars.forEach(function (star, i) {
					if (i <= index) {
						star.classList.remove('zmdi-star-outline');
						star.classList.add('zmdi-star');
					} else {
						star.classList.remove('zmdi-star');
						star.classList.add('zmdi-star-outline');
					}
				});
			});
		});

		// Thêm sự kiện click cho nút "Submit"
		submitButton.addEventListener('click', function () {
			// Lấy dữ liệu từ các phần tử HTML
			const rating = ratingInput.value;
			const review = reviewTextarea.value;

			// Kiểm tra xem người dùng đã nhập đủ thông tin chưa
			if (!rating || !review) {
				alert('Vui lòng nhập đầy đủ thông tin đánh giá');
				return;
			}

			// Gọi API để đánh giá sản phẩm
			fetch('http://localhost/shoe-api/public/api/danhgia', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					sanpham_id: {{$id}},
					khachhang_id: sessionStorage.getItem('id'),
					tyle: rating,
					nhanxet: review,
				}),
			})
				.then(response => {
					if (!response.ok) {
						throw new Error('Có lỗi xảy ra khi gửi đánh giá');
					}
					return response.json();
				})
				.then(data => {
					// Xử lý kết quả trả về từ API (nếu cần)
					console.log(data);
					alert('Đánh giá của bạn đã được gửi thành công');
					loadDanhGia()
					ratingInput.value = 0
					reviewTextarea.value = ""

				})
				.catch(error => {
					console.error('Lỗi:', error);
					alert('Có lỗi xảy ra khi gửi đánh giá');
				});
		});
	});




	function fetchNameById(type, id) {
		var name = "ccc"
		$.get(`  http://localhost/shoe-api/public/api/${type}/${id}`, function (data) {
			name = data.ten
		})
		return name
	}

	// Hàm này được sử dụng để lấy và hiển thị tên size
	function displaySizes(sizes) {
		sizeSelect.innerHTML = '';
		sizeSelect.options.add(new Option('Choose a size', ''));
		for (let sizeId of sizes) {

		}
	}

	// Hàm này được sử dụng để lấy và hiển thị tên màu sắc
	function displayColors(colorIds) {
		colorSelect.innerHTML = '';
		colorSelect.options.add(new Option('Choose a color', ''));
		for (let colorId of colorIds) {
			const colorName = fetchNameById('mausac', colorId);
			colorSelect.options.add(new Option(colorName, colorId));
		}
	}

	$(document).ready(function () {

		$.ajax({
			url: '  http://localhost/shoe-api/public/api/sanpham/{{$id}}',
			type: 'GET',
			dataType: 'json',
			success: function (productData) {
				$('#productName').text(productData.ten);
				$('#productBrand').text(`Thương hiệu: ${productData.thuonghieu.ten}`);
				var priceHtml = ``;
				const discount = Math.floor(productData.giamgia || 0);
				console.log(discount)
				var discountBadgeHtml = '';
				if (discount > 0) {
					var discountedPrice = productData.gia - (productData.gia * productData.giamgia / 100);
					priceHtml = `<span class="text-danger" style="text-decoration: line-through;">${formatCurrencyVND(productData.gia)}</span> <span class="text-primary">${formatCurrencyVND(discountedPrice)}</span>`;
					discountBadgeHtml = `Giảm giá ${Math.floor(productData.giamgia)}%`;
					$('#discountBadge').html(discountBadgeHtml);
				} else {
					$('#discountBadge').hide();
					priceHtml = `<span class="text-primary">${formatCurrencyVND(productData.gia)}</span>`;

				}
				$('#productPrice').html(priceHtml);

				$('#productDescription').text("Giới thiệu: " + productData.gioithieu);
				$('#description-content').text(productData.mota)
				$('#sanxuat').text(productData.sanxuat)
				$('#docao').text(productData.docao + " cm")

				productData.anhsanpham.forEach(function (image, index) {
					var isActive = index === 0 ? 'active' : '';
					$('.carousel-inner').append(
						`<div class="carousel-item ${isActive}">
                            <img src="  http://localhost/shoe-api/storage/app/public/uploads/${image.anhminhhoa}" class="d-block w-100" alt="...">
                        </div>`
					);
				});

				// Populate sizes and colors
				let sizes = new Set();
				let colors = new Set();


				const sizeSelect = document.getElementById('productSize');
				const colorSelect = document.getElementById('productColor');

				// Tạo danh sách các size duy nhất
				sizes = [...new Set(productData.sanphamsizemausac.map(item => item.size_id))];
				sizes.forEach(size => {
					$.get(`  http://localhost/shoe-api/public/api/size/${size}`, function (data) {
						sizeSelect.options.add(new Option(data.ten, size));
					})
				});

				// Thêm sự kiện thay đổi cho size select
				sizeSelect.onchange = function () {
					const selectedSize = this.value;
					const availableColors = productData.sanphamsizemausac
						.filter(item => item.size_id == selectedSize)
						.map(item => item.mausac_id);

					// Xóa các tùy chọn màu cũ
					colorSelect.innerHTML = '';
					colorSelect.options.add(new Option('Choose a color', ''));

					// Thêm các tùy chọn màu mới
					availableColors.forEach(color => {
						$.get(`  http://localhost/shoe-api/public/api/mausac/${color}`, function (data) {
							colorSelect.options.add(new Option(data.ten, color));
						})
					});
				};

				$('#productCarousel').carousel();

				document.querySelector('#addtocard').addEventListener('click', function () {

					const selectedSizeId = sizeSelect.value;
					const selectedColorId = colorSelect.value;
					const quantity = document.getElementById("quantity").value

					const matchingItem = productData.sanphamsizemausac.find(item =>
						item.size_id == selectedSizeId && item.mausac_id == selectedColorId);

					if (matchingItem) {
						if (sessionStorage.getItem('id')) {
							addToCart(matchingItem.id, quantity)
						}
						else {
							Toastify({
								text: "Vui lòng đăng nhập để thêm vào giỏ hàng!",
								duration: 3000,
								destination: "",
								newWindow: true,
								close: true,
								gravity: "top", // `top` or `bottom`
								position: "right", // `left`, `center` or `right`
								stopOnFocus: true, // Prevents dismissing of toast on hover
								style: {
									background: "linear-gradient(to right, #f46d1a , #f4ee1a);",
								},
								onClick: function () { } // Callback after click
							}).showToast();
						}
					} else {
						Toastify({
							text: "Vui lòng chọn đủ size và màu!",
							duration: 3000,
							destination: "",
							newWindow: true,
							close: true,
							gravity: "top", // `top` or `bottom`
							position: "right", // `left`, `center` or `right`
							stopOnFocus: true, // Prevents dismissing of toast on hover
							style: {
								background: "linear-gradient(to right, #f46d1a , #f4ee1a);",
							},
							onClick: function () { } // Callback after click
						}).showToast();
					}



				});

				function addToCart(productsizecolorId, quantity) {
					const url = '  http://localhost/shoe-api/public/api/giohang';
					const data = {
						khachhang_id: sessionStorage.getItem('id'),
						sanpham_size_mausac_id: productsizecolorId,
						soluong: quantity
					};

					fetch(url, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
						},
						body: JSON.stringify(data)
					})
						.then(response => response.json())
						.then(data => {
							console.log('Success:', data);
							Toastify({
								text: "Thêm vào giỏ hàng thành công!",
								duration: 3000,
								destination: "",
								newWindow: true,
								close: true,
								gravity: "top", // `top` or `bottom`
								position: "right", // `left`, `center` or `right`
								stopOnFocus: true, // Prevents dismissing of toast on hover
								style: {
									background: "linear-gradient(to right, #00b09b, #96c93d)",
								},
								onClick: function () { } // Callback after click
							}).showToast();
						})
						.catch((error) => {
							console.error('Error:', error);
							Toastify({
								text: "Có lỗi xảy ra!",
								duration: 3000,
								destination: "",
								newWindow: true,
								close: true,
								gravity: "top", // `top` or `bottom`
								position: "right", // `left`, `center` or `right`
								stopOnFocus: true, // Prevents dismissing of toast on hover
								style: {
									background: "linear-gradient(to right, #f46d1a , #f4ee1a);",
								},
								onClick: function () { } // Callback after click
							}).showToast();
						});
				}

			},
			error: function () {
				alert('Failed to retrieve product data.');
			}
		});

		$.get("  http://localhost/shoe-api/public/api/related/{{$id}}", function (data) {
			const container = document.getElementById('products-container');
			container.innerHTML = ''; // Clear previous contents
			var BASEURL = "{{ url('/') }}";
			let html = ""
			data.forEach(function (product) {
				const discount = Math.floor(product.giamgia || 0);
				const discountedPrice = product.gia - (product.gia * discount / 100);
				const hasDiscount = discount > 0;
				const productDetailLink = BASEURL + "/product/" + product.id;
				html = html + `
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="  http://localhost/shoe-api/storage/app/public/uploads/${product.anhsanpham[0]?.anhminhhoa}" alt="IMG-PRODUCT">
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="${productDetailLink}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									${product.ten}
								</a>

								<span style="text-align: center;width:100%" class="stext-105 cl3">
									${hasDiscount ?
						`<span style="text-decoration: line-through; color: gray;">${formatCurrencyVND(product.gia)}</span> <span style="color: red;">${formatCurrencyVND(discountedPrice)}</span>` :
						`<span style="color: red;">${formatCurrencyVND(product.gia)}</span>`
					}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="{{ asset('assets/images/icons/icon-heart-01.png') }}" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('assets/images/icons/icon-heart-02.png') }}" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
                `
			})
			container.innerHTML = html
		})

		loadDanhGia()

	});
	function loadDanhGia() {
		$.get("  http://localhost/shoe-api/public/api/danhgia/sanpham/{{$id}}", function (data) {
			$('#reviews-content').empty()
			// Assuming 'data' is the array of review objects
			data.forEach(function (review) {
				var avatarUrl = review.khach_hang.anhdaidien.startsWith('https') ? review.khach_hang.anhdaidien : 'http://localhost/shoe-api/storage/app/public/avatars/' + review.khach_hang.anhdaidien;
				// HTML structure for each review
				var reviewHtml = `
                <div class="flex-w flex-t p-b-68">
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        <img src="${avatarUrl}" alt="AVATAR">
                    </div>
                    <div class="size-207">
                        <div class="flex-w flex-sb-m p-b-17">
                            <span class="mtext-107 cl2 p-r-20">
                                ${review.khach_hang.ten}
                            </span>
                            <span class="fs-18 cl11">` +
					displayStars(review.tyle) +
					`</span>
                        </div>
                        <p class="stext-102 cl6">
                            ${review.nhanxet}
                        </p>
                    </div>
                </div>`;

				// Append each review to the reviews container
				$('#reviews-content').append(reviewHtml);
			});
		});
	}

	// Function to display star ratings
	function displayStars(rating) {
		var stars = '';
		for (var i = 0; i < 5; i++) {
			if (i < rating) {
				stars += '<i class="zmdi zmdi-star"></i>';
			} else {
				stars += '<i class="zmdi zmdi-star-outline"></i>';
			}
		}
		return stars;
	}
</script>
@endsection