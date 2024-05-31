@extends('../layout')
@section('content')
<style>
  /* Style cho các card sản phẩm */
  .card {
    width: 300px;
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
    width: 70%;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 20px;
    padding-bottom: 20px;
    padding-right: 60px;
    /* Để tạo khoảng cách dưới container */
  }

  .scroll-container2 {
    width: 70%;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 20px;
    padding-bottom: 20px;
    padding-right: 60px;
    /* Để tạo khoảng cách dưới container */
  }
  .scroll-container3 {
    width: 70%;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 20px;
    padding-bottom: 20px;
    padding-right: 60px;
    /* Để tạo khoảng cách dưới container */
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
              <canvas id="customerChart" width="300" height="300"></canvas>
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
          <div class="mb-2 mb-sm-0">
            <h5 class="card-title fw-semibold" >Sản phẩm bán chạy theo tháng</h5>
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
            <h5 class="card-title fw-semibold">Sản phẩm bán chậm theo tuầniiiiii</h5>
            <div id="worstproductsellbyweek" class="scroll-container2"></div>
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
            <h5 class="card-title fw-semibold">Sản phẩm bán chậm theo tháng</h5>
            <div id="worstproductsellbymonth" class="scroll-container3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
 // Function to format currency in VND
function formatCurrencyVND(value) {
  return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
}

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

function fetchProductDetails(products, containerId) {
  var container = document.getElementById(containerId);
  var fetchPromises = products.map(product =>
    fetch('http://localhost/shoe-api/public/api/sanpham/' + product.id)
      .then(res => res.json())
      .then(data2 => ({
        product,
        data2
      }))
  );

  Promise.all(fetchPromises)
    .then(results => {
      var html = "";
      results.forEach(({ product, data2 }) => {
        html += `
          <div class="col-md-4 mb-2">
            <div class="card">
              <img src="http://localhost/shoe-api/storage/app/public/uploads/${data2.anhsanpham[0].anhminhhoa}" class="card-img-top" alt="${data2.ten}">
              <div class="card-body">
                <h5 class="card-title">${data2.ten}</h5>
                <p class="card-text">Số lượng bán: ${product.total_quantity_sold}</p>
                <p class="card-text">Doanh thu: ${formatCurrencyVND(product.total_revenue)}</p>
              </div>
            </div>
          </div>
        `;
      });
      container.innerHTML = html;
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}

fetch('http://localhost/shoe-api/public/api/best-selling-products-week')
  .then(response => response.json())
  .then(data => {
    fetchProductDetails(data, 'topproductsellbyweek');
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });

fetch('http://localhost/shoe-api/public/api/worst-selling-products-month')
  .then(response => response.json())
  .then(data => {
    fetchProductDetails(data, 'worstproductsellbymonth');
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });

fetch('http://localhost/shoe-api/public/api/worst-selling-products-week')
  .then(response => response.json())
  .then(data => {
    fetchProductDetails(data, 'worstproductsellbyweek');
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });

fetch('http://localhost/shoe-api/public/api/getcustomerstatistics')
  .then(response => response.json())
  .then(data => {
    const totalCustomers = data.total_customers;
    const customersWithOrders = data.customers_with_orders;

    const canvas = document.getElementById('customerChart');
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

fetch('http://localhost/shoe-api/public/api/best-selling-products-month')
  .then(response => response.json())
  .then(data => {
    fetchProductDetails(data, 'topproductsellbymonth');
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });

fetch('http://localhost/shoe-api/public/api/sales-statistics')
  .then(response => response.json())
  .then(data => {
    const months = data.map(item => `${item.year}-${item.month}`);
    const quantities = data.map(item => item.total_quantity);
    const revenues = data.map(item => item.total_revenue);

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



</script>

@endsection()