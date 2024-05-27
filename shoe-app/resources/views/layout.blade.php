<!DOCTYPE html>
<html lang="en">

<head>
	<title>Trang chủ</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="{{ asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="{{ asset('assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animsition/css/animsition.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/slick/slick.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/MagnificPopup/magnific-popup.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
	<style>
		.header-cart-wrapitem {
			max-height: 400px;
			/* Adjust this value to fit your design */
			overflow-y: auto;
			/* Enables vertical scrolling */
			overflow-x: hidden;
			/* Hides horizontal scrollbar */
		}
	</style>


	<!--===============================================================================================-->
</head>

<body class="animsition">

	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="{{ route('home') }}" class="logo">
						<img src="{{ asset('assets/images/logo.png') }}" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="{{ route('home') }}">Trang chủ</a>
							</li>

							<li>
								<a href="{{ route('product.index') }}">Sản phẩm</a>
							</li>

							
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
							data-notify="2">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="{{ route('login') }}" id="userLink"
							class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-account-circle"></i>
						</a>

					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="{{ route('home') }}"><img src="{{ asset('assets/images/icons/logo-01.png') }}"
						alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
					data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="{{ route('home') }}" id="userLinkMobile"
					class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
					<i class="zmdi zmdi-account-circle"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="{{ route('home') }}">Trang chủ</a>
				</li>

				<li>
					<a href="{{ route('home') }}">Sản phẩm</a>
				</li>

			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search-product-lo" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Giỏ hàng
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full" id="cart-content-lo">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{ asset('images/item-cart-01.jpg') }}" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{ asset('images/item-cart-02.jpg') }}" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{ asset('images/item-cart-03.jpg') }}" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>

				<div class="w-full">


					<div class="header-cart-buttons flex-w w-full">
						<a href="{{route("cart.index")}}"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							Xem giỏ hàng
						</a>

						
					</div>
				</div>
			</div>
		</div>
	</div>


	@yield('content')


	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Thể loại
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Phụ nữ
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Đàn ông
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Giày
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Xem
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Hỗ trợ
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Theo dõi thứ tự
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Trả lại
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Chuyển hàng
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Câu hỏi thường gặp
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Liên lạc
					</h4>

					<p class="stext-107 cl7 size-201">
					Có câu hỏi nào không? Hãy cho chúng tôi biết tại cửa hàng tại Tầng 2, Bạch Trữ, Tiến Thắng, Mê Linh, Hà Nội hoặc gọi cho chúng tôi
					trên (+1) 92 947 3029
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

			</div>

			<div class="p-t-40">
				

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;
					<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i
						class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
						target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com"
						target="_blank">ThemeWagon</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- để nguyên -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="{{ asset('images/icons/icon-close.png') }}" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="{{ asset('images/product-detail-01.jpg') }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('images/product-detail-01.jpg') }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
												href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="{{ asset('images/product-detail-02.jpg') }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('images/product-detail-02.jpg') }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
												href="{{ asset('images/product-detail-02.jpg') }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="{{ asset('images/product-detail-03.jpg') }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('images/product-detail-03.jpg') }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
												href="{{ asset('images/product-detail-03.jpg') }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat
								ornare feugiat.
							</p>

							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number"
												name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button
											class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#"
										class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
										data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
									data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
									data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
									data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/animsition/js/animsition.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
	<script>
		$(".js-select2").each(function () {
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
	<script src="{{ asset('assets/js/slick-custom.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/parallax100/parallax100.js') }}"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var userLink = document.getElementById('userLink');

			if (sessionStorage.getItem('id')) {
				console.log(sessionStorage.getItem('id'));
				userLink.href = '{{ route('profile') }}';
				userLinkMobile.href = '{{ route('profile') }}';
			} else {
				userLink.href = '{{ route('login') }}';
				console.log(userLink.href);
				userLinkMobile.href = '{{ route('login') }}';
			}
			var searchInput = document.querySelector('input[name="search-product-lo"]');

			searchInput.addEventListener('keypress', function (event) {
				if (event.key === 'Enter') {
					event.preventDefault(); // Ngăn không cho form gửi đi theo cách mặc định
					var searchTerm = searchInput.value.trim();

					if (searchTerm) {
						// Chuyển hướng người dùng đến trang tìm kiếm với từ khóa đã nhập
						window.location.href = `  http://localhost/shoe-app/public/product?name=${encodeURIComponent(searchTerm)}`;
						// Thay `/search-page` bằng URL của trang tìm kiếm thực tế trên website của bạn
					}
				}
			});

			function loadCartDataLo() {
				var cartContent = document.getElementById('cart-content-lo');
				var cartAmount = document.getElementById('cart-amount-lo');
				var userId = sessionStorage.getItem('id');


				if (userId) {
					fetch(`http://localhost/shoe-api/public/api/giohang/${userId}`)
						.then(response => response.json())
						.then(data => {
							// Tạo một mảng các Promise từ các yêu cầu fetch sản phẩm
							let promises = data.map(cart => {

								return fetch(`http://localhost/shoe-api/public/api/getsanphambycart/${cart.sanpham_size_mausac_id}`)
									.then(response => response.json())
									.then(productData => {
										var discountedPrice = productData.gia - (productData.gia * productData.giamgia / 100)
										return `
                                <li class="header-cart-item flex-w flex-t m-b-12">
                                    <div class="header-cart-item-img">
                                        <img src="http://localhost/shoe-api/storage/app/public/uploads/${productData.anhsanpham[0].anhminhhoa}" alt="IMG">
                                    </div>
                                    <div class="header-cart-item-txt p-t-8">
                                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                            ${productData.ten} 
                                        </a>
                                        <span class="header-cart-item-info">
                                            ${cart.soluong} x ${formatCurrencyVND(discountedPrice)}
                                        </span>
                                    </div>
                                </li>
                            `;
									});
							});

							// Chờ tất cả các Promise hoàn tất và cập nhật DOM một lần
							Promise.all(promises).then(htmlSnippets => {
								cartContent.innerHTML = htmlSnippets.join('');
							});
						})
						.catch(error => {
							console.error('Error fetching cart data: ', error);
						});
				} else {
					cartContent.innerHTML = ""
				}
			}


			loadCartDataLo();
			setInterval(loadCartDataLo, 5000);







		});
		$('.gallery-lb').each(function () { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});

	</script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script>
		function formatCurrencyVND(value) {
			return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
		}

		$('.js-pscroll').each(function () {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function () {
				ps.update();
			});
		});

	</script>
	<!--===============================================================================================-->
	<script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>