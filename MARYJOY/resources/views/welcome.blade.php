<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suicide Rate Dashboard</title>

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #121212; color: #e0e0e0; padding-top: 30px;">

    <div class="container">
<!-- Logout Button -->
<div style="text-align: right; margin-bottom: 20px;">
    <a href="#" class="btn btn-danger" style="border-radius: 8px; padding: 8px 16px;" onclick="confirmLogout()">Logout</a>
</div>

<script>
function confirmLogout() {
    if (confirm('Are you sure you want to log out?')) {
        // Redirect to the login page
        window.location.href = "{{ route('login') }}";
    }
}
</script>


        <!-- Title Section -->
        <h1 style="font-size: 36px; font-weight: 600; text-align: center; margin-bottom: 40px; color: #fff;">Suicide Rate Analysis Dashboard</h1>

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-3">
            <h5 style="font-size: 14px; font-weight: 600; margin-bottom: 10px; color: #fff;">Filter by Year</h5>
            <select id="yearFilter" class="form-select" style="border-radius: 8px; background-color: #444; color: #fff; padding: 8px;">
                <option value="">Select Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <h5 style="font-size: 14px; font-weight: 600; margin-bottom: 10px; color: #fff;">Filter by Country</h5>
            <select id="countryFilter" class="form-select" style="border-radius: 8px; background-color: #444; color: #fff; padding: 8px;">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <h5 style="font-size: 14px; font-weight: 600; margin-bottom: 10px; color: #fff;">Filter by Age Group</h5>
            <select id="ageGroupFilter" class="form-select" style="border-radius: 8px; background-color: #444; color: #fff; padding: 8px;">
                <option value="">Select Age Group</option>
                @foreach ($ageGroups as $ageGroup)
                    <option value="{{ $ageGroup }}">{{ $ageGroup }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <h5 style="font-size: 14px; font-weight: 600; margin-bottom: 10px; color: #fff;">Filter by Sex</h5>
            <select id="sexFilter" class="form-select" style="border-radius: 8px; background-color: #444; color: #fff; padding: 8px;">
                <option value="">Select Sex</option>
                @foreach ($sexes as $sex)
                    <option value="{{ $sex }}">{{ $sex }}</option>
                @endforeach
            </select>
        </div>

        </div>

        <!-- Overview Section -->
        <div class="row" style="display: flex; justify-content: space-between; margin-bottom: 30px;">
            <!-- Total Suicides -->
            <div style="flex: 1; margin-right: 15px;">
                <div class="card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 12px; background-color: #333; padding: 20px;">
                    <div style="text-align: center; padding: 10px;">
                        <i class="bi bi-emoji-heart-eyes" style="font-size: 40px; color: #FF6F61;"></i>
                        <h5 style="font-size: 16px; font-weight: 500; margin-top: 10px; color: #fff;">Total Suicides</h5>
                        <p id="total-suicides" class="display-4" style="font-size: 36px; font-weight: 500; color: #fff;">{{ $totalSuicides }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Countries -->
            <div style="flex: 1; margin-right: 15px;">
                <div class="card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 12px; background-color: #333; padding: 20px;">
                    <div style="text-align: center; padding: 10px;">
                        <i class="bi bi-globe2" style="font-size: 40px; color: #61D3FF;"></i>
                        <h5 style="font-size: 16px; font-weight: 500; margin-top: 10px; color: #fff;">Total Countries</h5>
                        <p id="total-countries" class="display-4" style="font-size: 36px; font-weight: 500; color: #fff;">0</p>
                    </div>
                </div>
            </div>

            <!-- Available Years -->
            <div style="flex: 1;">
                <div class="card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 12px; background-color: #333; padding: 20px;">
                    <div style="text-align: center; padding: 10px;">
                        <i class="bi bi-calendar-check" style="font-size: 40px; color: #4CAF50;"></i>
                        <h5 style="font-size: 16px; font-weight: 500; margin-top: 10px; color: #fff;">Available Years</h5>
                        <p id="total-years" class="display-4" style="font-size: 36px; font-weight: 500; color: #fff;">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div style="display: flex; gap: 20px; justify-content: space-between; flex-wrap: nowrap; margin-top: 40px; padding-bottom: 30px;">
            <!-- Suicide Rate Over Time -->
            <div style="flex: 1; min-width: 30%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15); border-radius: 12px; padding: 20px; background-color: #333;">
                <div style="font-size: 24px; font-weight: 600; text-align: center; color: #fff; padding-bottom: 20px; border-bottom: 2px solid #444;">
                    <i class="bi bi-bar-chart-line" style="font-size: 28px; color: #FF6F61; margin-right: 10px;"></i> Suicide Rate Over Time
                </div>
                <canvas id="suicideTrendsChart"></canvas>
            </div>

            <!-- GDP vs Suicide Rate -->
            <div style="flex: 1; min-width: 30%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15); border-radius: 12px; padding: 20px; background-color: #333;">
                <div style="font-size: 24px; font-weight: 600; text-align: center; color: #fff; padding-bottom: 20px; border-bottom: 2px solid #444;">
                    <i class="bi bi-currency-dollar" style="font-size: 28px; color: #FF6F61; margin-right: 10px;"></i> GDP vs Suicide Rate
                </div>
                <canvas id="gdpVsSuicideChart"></canvas>
            </div>

            <!-- Top Countries by Suicide Rate -->
            <div style="flex: 1; min-width: 30%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15); border-radius: 12px; padding: 20px; background-color: #333;">
                <div style="font-size: 24px; font-weight: 600; text-align: center; color: #fff; padding-bottom: 20px; border-bottom: 2px solid #444;">
                    <i class="bi bi-globe" style="font-size: 28px; color: #FF6F61; margin-right: 10px;"></i> Top Countries by Suicide Rate
                </div>
                <canvas id="topCountriesChart"></canvas>
            </div>
        </div>
    </div>

    <script>
    // Passing data from PHP to JavaScript
    var totalSuicides = @json($totalSuicides);
    var years = @json($years);
    var suicideRates = @json($suicideRates);
    var gdpVsSuicide = @json($gdpVsSuicide);
    var countrySuicideRates = @json($countrySuicideRates);
    var ageGroups = @json($ageGroups);
    var sexes = @json($sexes);

    // Update placeholders in HTML
    document.getElementById('total-suicides').innerText = totalSuicides;
    document.getElementById('total-countries').innerText = @json(count($countries));
    document.getElementById('total-years').innerText = @json(count($years));

    document.getElementById('yearFilter').addEventListener('change', function () {
    var selectedYear = this.value; // Get the selected year
        if (selectedYear) {
            fetchYearData(selectedYear); // Fetch data for the selected year
        }
    });

    function fetchYearData(year) {
        fetch(`/filter-by-year/${year}`)
            .then(response => response.json())
            .then(data => {
                updateChart(data, year); // Update the chart with new data
            })
            .catch(error => console.error('Error fetching data:', error));
    }


    function updateChart(data, year) {
        const countries = data.map(item => item.country); // Extract country names
        const rates = data.map(item => item.average_rate); // Extract suicide rates

        const ctx = document.getElementById('suicideTrendsChart').getContext('2d');

        // Destroy the old chart if it exists
        if (window.suicideTrendsChart) {
            window.suicideTrendsChart.destroy();
        }

        // Create a new bar chart
        window.suicideTrendsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: countries,
                datasets: [{
                    label: `Suicide Rate in ${year}`,
                    data: rates,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Countries'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Suicide Rate per 100k Population'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Chart.js - Suicide Rate Over Time
    var ctx1 = document.getElementById('suicideTrendsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: Object.keys(suicideRates), // Years as labels
            datasets: [{
                label: 'Suicide Rate per 100k Population',
                data: Object.values(suicideRates), // Suicide rates
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false,
                borderWidth: 2
            }]
        }
    });

    // Chart.js - GDP vs Suicide Rate
    var ctx2 = document.getElementById('gdpVsSuicideChart').getContext('2d');
    new Chart(ctx2, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'GDP per Capita vs Suicide Rate',
                data: gdpVsSuicide.map(item => ({ x: item.avg_gdp, y: item.avg_suicide_rate })),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    // Chart.js - Top Countries by Suicide Rate
    var ctx3 = document.getElementById('topCountriesChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: Object.keys(countrySuicideRates), // Country names
            datasets: [{
                label: 'Suicide Rate per 100k Population',
                data: Object.values(countrySuicideRates), // Suicide rates
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
