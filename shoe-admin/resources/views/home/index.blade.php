@extends('../layout')
@section('content')
<style>
/* Style cho các card sản phẩm */
.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    overflow: hidden;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
}

.card-body {
    padding: 20px;
}

.card-text {
    font-size: 14px;
}

/* Style cho container của các card */
.scroll-container {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 20px;
    padding-bottom: 20px; /* Để tạo khoảng cách dưới container */
}

/* Style cho container chứa các row */
.row {
    margin-bottom: 30px;
}

</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!--  Row 1 -->
<div class="row">
  <div class="col-lg-8 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">Doanh số bán hàng từng tháng</h5>
          </div>
        </div>
        <canvas id="salesChart" width="800" height="400"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="card overflow-hidden">
          <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Khách hàng</h5>
            <div class="row align-items-center">
            <canvas id="customerChart" width="300" height="300" ></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row alig n-items-start">
              <div class="col-12">
                <h5 class="card-title mb-9 fw-semibold">Sự phát triển</h5>
                <canvas id="growthChart" width="800" height="400"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">Doanh thu theo tuần</h5>
          <canvas id="revenueChart" width="800" height="400"></canvas>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">Sản phẩm bán chạy theo tháng</h5>
          <div id="topproductsellbymonth" class="scroll-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">Sản phẩm bán chạy theo tuần</h5>
           <div id="topproductsellbyweek" class="scroll-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">Sản phẩm bán ế theo tuần</h5>
  <div id="worstproductsellbyweek" class="scroll-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">Sản phẩm bán ế theo tháng</h5>
  <div id="worstproductsellbymonth" class="scroll-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>






<!-- <div class="py-6 px-6 text-center">
  <p class="mb-0 fs-4">Design and Developed by <a href="#" target="_blank"
      class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
      href="https://themewagon.com">ThemeWagon</a></p>
</div> -->

<script>
  fetch('http://localhost/shoe-api/public/api/revenue-statistics')
    .then(response => response.json())
    .then(data => {
        const weeks = data.map(item => item.week_start);
        const revenues = data.map(item => item.total_revenue);

        const ctx = document.getElementById('revenueChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: weeks,
                datasets: [{
                    label: 'Doanh thu theo tuần',
                    data: revenues,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });

fetch('http://localhost/shoe-api/public/api/best-selling-products-month')
    .then(response => response.json())
    .then(data => {
        var container = document.getElementById('topproductsellbymonth');
        var html = "";

        // Duyệt qua từng sản phẩm trong dữ liệu nhận được
        data.forEach(product => {
            // Lấy thông tin sản phẩm từ API
            fetch('http://localhost/shoe-api/public/api/sanpham/' + product.id)
                .then(res => res.json())
                .then(data2 => {
                    // Tạo HTML cho mỗi sản phẩm và thêm vào container
                    html += `
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src=" http://localhost/shoe-api/storage/app/public/uploads/${data2.anhsanpham[0].anhminhhoa}" class="card-img-top" alt="${data2.ten}">
                                <div class="card-body">
                                    <h5 class="card-title">${data2.ten}</h5>
                                    <p class="card-text">Số lượng bán: ${product.total_quantity_sold}</p>
                                    <p class="card-text">Doanh thu: ${formatCurrencyVND(product.total_revenue)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML = html; // Thêm HTML vào container
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });


    fetch('http://localhost/shoe-api/public/api/best-selling-products-week')
    .then(response => response.json())
    .then(data => {
        var container = document.getElementById('topproductsellbyweek');
        var html = "";

        // Duyệt qua từng sản phẩm trong dữ liệu nhận được
        data.forEach(product => {
            // Lấy thông tin sản phẩm từ API
            fetch('http://localhost/shoe-api/public/api/sanpham/' + product.id)
                .then(res => res.json())
                .then(data2 => {
                    // Tạo HTML cho mỗi sản phẩm và thêm vào container
                    html += `
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src=" http://localhost/shoe-api/storage/app/public/uploads/${data2.anhsanpham[0].anhminhhoa}" class="card-img-top" alt="${data2.ten}">
                                <div class="card-body">
                                    <h5 class="card-title">${data2.ten}</h5>
                                    <p class="card-text">Số lượng bán: ${product.total_quantity_sold}</p>
                                    <p class="card-text">Doanh thu: ${formatCurrencyVND(product.total_revenue)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML = html; // Thêm HTML vào container
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });

    fetch('http://localhost/shoe-api/public/api/worst-selling-products-month')
    .then(response => response.json())
    .then(data => {
        var container = document.getElementById('worstproductsellbymonth');
        var html = "";

        // Duyệt qua từng sản phẩm trong dữ liệu nhận được
        data.forEach(product => {
            // Lấy thông tin sản phẩm từ API
            fetch('http://localhost/shoe-api/public/api/sanpham/' + product.id)
                .then(res => res.json())
                .then(data2 => {
                    // Tạo HTML cho mỗi sản phẩm và thêm vào container
                    html += `
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src=" http://localhost/shoe-api/storage/app/public/uploads/${data2.anhsanpham[0].anhminhhoa}" class="card-img-top" alt="${data2.ten}">
                                <div class="card-body">
                                    <h5 class="card-title">${data2.ten}</h5>
                                    <p class="card-text">Số lượng bán: ${product.total_quantity_sold}</p>
                                    <p class="card-text">Doanh thu: ${formatCurrencyVND(product.total_revenue)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML = html; // Thêm HTML vào container
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });

    fetch('http://localhost/shoe-api/public/api/worst-selling-products-week')
    .then(response => response.json())
    .then(data => {
        var container = document.getElementById('worstproductsellbyweek');
        var html = "";

        // Duyệt qua từng sản phẩm trong dữ liệu nhận được
        data.forEach(product => {
            // Lấy thông tin sản phẩm từ API
            fetch('http://localhost/shoe-api/public/api/sanpham/' + product.id)
                .then(res => res.json())
                .then(data2 => {
                    // Tạo HTML cho mỗi sản phẩm và thêm vào container
                    html += `
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src=" http://localhost/shoe-api/storage/app/public/uploads/${data2.anhsanpham[0].anhminhhoa}" class="card-img-top" alt="${data2.ten}">
                                <div class="card-body">
                                    <h5 class="card-title">${data2.ten}</h5>
                                    <p class="card-text">Số lượng bán: ${product.total_quantity_sold}</p>
                                    <p class="card-text">Doanh thu: ${formatCurrencyVND(product.total_revenue)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML = html; // Thêm HTML vào container
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });



  // Fetch data from API endpoint
  fetch('http://localhost/shoe-api/public/api/sales-statistics')
        .then(response => response.json())
        .then(data => {
            const months = data.map(item => `${item.year}-${item.month}`);
            const quantities = data.map(item => item.total_quantity);
            const revenues = data.map(item => item.total_revenue);

            // Create Chart
            const ctx1 = document.getElementById('growthChart').getContext('2d');
            const growthChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                    {
                        label: 'Doanh thu',
                        data: revenues,
                        fill: false,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Create Chart
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Số lượng bán',
                        data: quantities,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Doanh thu',
                        data: revenues,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

        fetch('http://localhost/shoe-api/public/api/getcustomerstatistics')
        .then(response => response.json())
        .then(data => {
            const totalCustomers = data.total_customers;
            const customersWithOrders = data.customers_with_orders;

            // Calculate aspect ratio
            const aspectRatio = 1;

            // Get canvas element
            const canvas = document.getElementById('customerChart');

            // Set width and height based on aspect ratio
            canvas.width = canvas.clientWidth;
            canvas.height = canvas.clientWidth / aspectRatio;

            // Create Chart
            const ctx = canvas.getContext('2d');
            const customerChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Khách hàng không có đơn đặt hàng', 'Khách hàng có đơn đặt hàng'],
                    datasets: [{
                        label: 'Customer Statistics',
                        data: [totalCustomers - customersWithOrders, customersWithOrders],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)', // Red
                            'rgba(54, 162, 235, 0.5)', // Blue
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
</script>

@endsection()