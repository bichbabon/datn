@extends('../layout')

@section('content')

<div class="bg0 m-t-23 p-b-50">
</div>



<div class="bg0 m-t-23 p-b-140">
	<div class="container">
		<div class="flex-w flex-sb-m p-b-52">

			<div class="flex-w flex-c-m m-tb-10">
				<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
					<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
					<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Lựa chọn
				</div>

				<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
					<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
					<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Tìm kiếm
				</div>
			</div>

			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				<div class="bor8 dis-flex p-l-15">
					<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>

					<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
						placeholder="Search">
				</div>
			</div>

			<!-- Filter -->
			<div class="dis-none panel-filter w-full p-t-10">
				<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
					<div class="filter-col1 p-r-15 p-b-27">
						<div class="mtext-102 cl2 p-b-15">
							Sắp xếp theo
						</div>

						<ul id="filterSortLinks">
							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04 filter-link-active"
									data-sort="macdinh">
									Mặc định
								</a>
							</li>
							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="danhgia">
									Đánh giá cao nhất
								</a>
							</li>
							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="asc">
									Giá: từ thấp đến cao
								</a>
							</li>
							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="desc">
									Giá: từ cao đến thấp
								</a>
							</li>
						</ul>

					</div>

					<div class="filter-col2 p-r-15 p-b-27">
						<div class="mtext-102 cl2 p-b-15">
							Giá
						</div>

						<ul id="filterPriceLinks">
							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04 filter-link-active" data-sort="0">
									All
								</a>
							</li>

							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="1">
									100.000đ - 500.000đ
								</a>
							</li>

							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="2">
									500.000đ - 1.000.000đ
								</a>
							</li>

							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="3">
									1.000.000đ - 2.000.000đ
								</a>
							</li>

							<li class="p-b-6">
								<a href="" class="filter-link stext-106 trans-04" data-sort="4">
									Trên 2.000.000
								</a>
							</li>
						</ul>
					</div>

					<div class="filter-col1 p-r-15 p-b-27">
						<div class="mtext-102 cl2 p-b-15">
							Thương hiệu
						</div>
						<ul id="filterThuongHieuLinks">
							<ul id="filterPriceLinks">
								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04 filter-link-active" data-sort="0">
										Tất cả
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="1">
										Adidas
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="2">
										Nike
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="3">
										Puma
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="6">
										Jordan
									</a>
								</li>
								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="4">
										Dior
									</a>
								</li>

							</ul>

					</div>
					<div class="filter-col1 p-r-15 p-b-27">
						<div class="mtext-102 cl2 p-b-15">
							Danh mục
						</div>
						<ul id="filterDanhMucLinks">
							<ul id="filterDanhMuc">
								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04 filter-link-active" data-sort="0">
										Tất cả
									</a>
								</li>
								
								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="1">
										Giày thể thao
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="2">
										Giày Sneaker Nam
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="3">
									Giày Sneaker Nữ
									</a>
								</li>

								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="7">
										Giày Tây Nam
									</a>
								</li>
								<li class="p-b-6">
									<a href="" class="filter-link stext-106 trans-04" data-sort="8">
									Giày Sandals Nữ
									</a>
								</li>

							</ul>

					</div>
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4"
						id="btn-filter">
						Lựa chọn
					</div>
				</div>

			</div>
		</div>
		<div class="container" style="height:1500px">
			<div class="row isotope-grid" id="products-container">
				
			</div>
		</div>

		

		


	</div>
</div>
<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<li class="page-item"><a class="page-link" href="#">Previous</a></li>
				<!-- Các mục phân trang sẽ được thêm vào đây -->
				<li class="page-item"><a class="page-link" href="#">Next</a></li>
			</ul>
		</nav>

<script>
	const queryString = window.location.search;
	function getQueryParams(url) {
		const parsedUrl = new URL(url);
		const params = new URLSearchParams(parsedUrl.search);

		// Helper function to get parameter or return empty string if not found
		function getParamValue(paramName) {
			return params.get(paramName) || '';  // Return an empty string if the param is not found
		}

		return {
			page: getParamValue('page'),
			priceMin: getParamValue('price_min'),
			priceMax: getParamValue('price_max'),
			rating: getParamValue('rating'),
			thuonghieu: getParamValue('thuonghieu'),
		};
	}

	var fullURL = window.location.href;
	var filter = getQueryParams(fullURL)
	console.log(filter);


	function fetchDataFromAPI() {
		var fullURL = window.location.href;
		var queryParams = getQueryParams(fullURL);


		// Construct the API endpoint with query parameters
		var apiURL = `  http://localhost/shoe-api/public/api/sanpham${queryString}`;

		fetch(apiURL)
			.then(response => response.json())
			.then(data => {
				console.log('Data retrieved:', data);
				// Here you can update the UI with the fetched data
				// displayData(data);
			})
			.catch(error => {
				console.error('Error fetching data:', error);
				// Handle errors such as no network or response errors
			});
	}

	function fetchProducts() {
		fetch(`  http://localhost/shoe-api/public/api/sanpham${queryString}`)
			.then(response => response.json())
			.then(data =>
				displayProducts(data)
			)
			.catch(error => console.error('Error fetching data: ', error));
	}


	function displayProducts(data) {
		var products = data.data
		var BASEURL = "{{ url('/') }}";
		const container = document.getElementById('products-container');
		container.innerHTML = ''; // Clear previous contents
		let html = ""
		products.forEach(product => {
			const productDetailLink = BASEURL + "/product/" + product.id;
			const categoriesClass = product.danhmuc.map(cat => cat.id).join(' ');
			const discount = Math.floor(product.giamgia || 0);
			const discountedPrice = product.gia - (product.gia * discount / 100);
			const hasDiscount = discount > 0;
			html = html + `
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ${categoriesClass}">
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
				</div>`;
		});
		container.innerHTML = html
		var queryString = window.location.search;
		var baseUrl = `  http://localhost/shoe-app/public/product`;

		// Kiểm tra và thêm tham số `page` nếu URL hiện tại không có
		if (!queryString.includes('page=')) {
			queryString += queryString.length > 0 ? '&page=1' : '?page=1';
		}

		var currentPage = data.current_page; // Được lấy từ dữ liệu API

		const paginationContainer = document.querySelector('.pagination');
		paginationContainer.innerHTML = ''; // Xóa nội dung hiện tại

		data.links.forEach(link => {
			const li = document.createElement('li');
			li.classList.add('page-item');
			if (!link.url) li.classList.add('disabled'); // vô hiệu hóa nếu không có URL
			if (link.active) li.classList.add('active'); // đánh dấu mục đang xem

			const a = document.createElement('a');
			a.classList.add('page-link');

			if (link.url) {
				// Xử lý cho các liên kết trước và sau
				if (link.label.includes('Previous')) {
					a.href = `${baseUrl}${queryString.replace(`page=${currentPage}`, `page=${currentPage - 1}`)}`;

				} else if (link.label.includes('Next')) {
					a.href = `${baseUrl}${queryString.replace(`page=${currentPage}`, `page=${currentPage + 1}`)}`;
				} else {
					// Đối với các số trang cụ thể
					a.href = `${baseUrl}${queryString.replace(`page=${currentPage}`, `page=${link.label}`)}`;
				}
			} else {
				a.href = '#'; // Đảm bảo không thay đổi trang nếu không có URL
			}

			a.innerHTML = link.label;
			li.appendChild(a);
			paginationContainer.appendChild(li);
		});

	}



	document.addEventListener('DOMContentLoaded', function () {



		var searchInput = document.querySelector('input[name="search-product"]');

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




		const priceRanges = {
			"1": { min: "100000", max: "500000" },
			"2": { min: "500000", max: "1000000" },
			"3": { min: "1000000", max: "2000000" },
			"4": { min: "2000000", max: "" }
		};


		fetchProducts()
		fetchDataFromAPI()
		const filterButton = document.querySelector('#btn-filter');  // Adjust selector as needed
		filterButton.addEventListener('click', function () {
			// Gather active links from each filter category
			const sortFilterActive = document.querySelector('#filterSortLinks .filter-link-active');
			const priceFilterActive = document.querySelector('#filterPriceLinks .filter-link-active');
			const brandFilterActive = document.querySelector('#filterThuongHieuLinks .filter-link-active');
			const danhmucFilterActive = document.querySelector('#filterDanhMucLinks .filter-link-active');

			// Collect data or execute filtering logic here
			const selectedSort = sortFilterActive ? sortFilterActive.getAttribute('data-sort') : 'macdinh';


			const selectPriceSort = priceFilterActive ? priceFilterActive.getAttribute('data-sort') : '0';

			const selectThuongHieuSort = brandFilterActive ? brandFilterActive.getAttribute('data-sort') : '0';
			const selectDanhMucSort = danhmucFilterActive ? danhmucFilterActive.getAttribute('data-sort') : '0';

			let newQueryString = '';

			// Kiểm tra từng tham số và thêm vào chuỗi truy vấn nếu chúng không rỗng
			if (selectedSort != "macdinh") {
				if(selectedSort == "danhgia"){
					newQueryString += `sort_rating=desc&`;
				}
				else{
					newQueryString += `sort_price=${encodeURIComponent(selectedSort)}&`;

				}
			}
			if (selectPriceSort != '0') {
				const { min, max } = priceRanges[selectPriceSort] || {};

				if (min !== undefined) {
					newQueryString += `price_min=${encodeURIComponent(min)}&`;
				}
				if (max !== undefined && max !== "") {
					newQueryString += `price_max=${encodeURIComponent(max)}&`;
				}
			}
			if (selectThuongHieuSort != '0') {
				newQueryString += `thuonghieu=${encodeURIComponent(selectThuongHieuSort)}&`;
			}
			if (selectDanhMucSort != '0') {
				newQueryString += `danhmuc=${encodeURIComponent(selectDanhMucSort)}&`;
			}

			// Loại bỏ ký tự '&' cuối cùng nếu có
			console.log(newQueryString);
			newQueryString = newQueryString.replace(/&$/, '');
			if (newQueryString) {
				newQueryString = `?${newQueryString}`;
				window.location.href = `  http://localhost/shoe-app/public/product${newQueryString}`
			}



		});

		// Also handle switching active class between filter links
		document.querySelectorAll('.filter-link').forEach(link => {
			link.addEventListener('click', function (event) {
				event.preventDefault(); // Prevent default link behavior
				// Remove active class from siblings
				let siblings = link.closest('ul').querySelectorAll('.filter-link');
				siblings.forEach(sib => sib.classList.remove('filter-link-active'));
				// Set active class on clicked link
				link.classList.add('filter-link-active');
			});
		});
	});
</script>

@endsection