@extends('layouts.app', ['page_title' => 'Dashboard'])
@section('content')
{{-- <div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Income</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">$47.482</h1>
                <div class="mb-0">
                    <span class="badge badge-success-light">3.65%</span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Orders</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">2.542</h1>
                <div class="mb-0">
                    <span class="badge badge-danger-light">-5.25%</span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Activity</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="activity"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">16.300</h1>
                <div class="mb-0">
                    <span class="badge badge-success-light">4.65%</span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Revenue</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">$20.120</h1>
                <div class="mb-0">
                    <span class="badge badge-success-light">2.35%</span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-12 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <div class="float-end">
                    <form class="row g-2">
                        <div class="col-auto">
                            <select class="form-select form-select-sm bg-light border-0">
                                <option>Jan</option>
                                <option value="1">Feb</option>
                                <option value="2">Mar</option>
                                <option value="3">Apr</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control form-control-sm bg-light rounded-2 border-0" style="width: 100px;" placeholder="Search.." />
                        </div>
                    </form>
                </div>
                <h5 class="card-title mb-0">Total Revenue</h5>
            </div>
            <div class="card-body pt-2 pb-3">
                <div class="chart chart-md">
                    <canvas id="chartjs-dashboard-line"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="card-actions float-end">
                    <div class="dropdown position-relative">
                        <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                            <i class="align-middle" data-feather="more-horizontal"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <h5 class="card-title mb-0">Top Selling Products</h5>
            </div>
            <table class="table table-borderless my-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="d-none d-xxl-table-cell">Company</th>
                        <th class="d-none d-xl-table-cell">Assigned</th>
                        <th class="d-none d-xl-table-cell text-end">Orders</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-2">
                                        <img class="p-2" src="{{ url('assets/img/icons/brand-4.svg') }}" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong>Aurora</strong>
                                    <div class="text-muted">
                                        UI Kit
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-xxl-table-cell">
                            <strong>Lechters</strong>
                            <div class="text-muted">
                                Real Estate
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <strong>Vanessa Tucker</strong>
                            <div class="text-muted">
                                HTML, JS, React
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-end">
                            520
                        </td>
                        <td>
                            <span class="badge badge-success-light">In progress</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-2">
                                        <img class="p-2" src="{{ url('assets/img/icons/brand-1.svg') }}" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong>Bender</strong>
                                    <div class="text-muted">
                                        Dashboard
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-xxl-table-cell">
                            <strong>Cellophane Transportation</strong>
                            <div class="text-muted">
                                Transportation
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <strong>William Harris</strong>
                            <div class="text-muted">
                                HTML, JS, Vue
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-end">
                            240
                        </td>
                        <td>
                            <span class="badge badge-warning-light">Paused</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-2">
                                        <img class="p-2" src="{{ url('assets/img/icons/brand-5.svg') }}" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong>Camelot</strong>
                                    <div class="text-muted">
                                        Dashboard
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-xxl-table-cell">
                            <strong>Clemens</strong>
                            <div class="text-muted">
                                Insurance
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <strong>Darwin</strong>
                            <div class="text-muted">
                                HTML, JS, Laravel
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-end">
                            180
                        </td>
                        <td>
                            <span class="badge badge-success-light">In progress</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-2">
                                        <img class="p-2" src="{{ url('assets/img/icons/brand-2.svg') }}" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong>Edison</strong>
                                    <div class="text-muted">
                                        UI Kit
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-xxl-table-cell">
                            <strong>Affinity Investment Group</strong>
                            <div class="text-muted">
                                Finance
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <strong>Vanessa Tucker</strong>
                            <div class="text-muted">
                                HTML, JS, React
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-end">
                            410
                        </td>
                        <td>
                            <span class="badge badge-danger-light">Cancelled</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-2">
                                        <img class="p-2" src="{{ url('assets/img/icons/brand-3.svg') }}" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong>Fusion</strong>
                                    <div class="text-muted">
                                        Dashboard
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-xxl-table-cell">
                            <strong>Konsili</strong>
                            <div class="text-muted">
                                Retail
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <strong>Christina Mason</strong>
                            <div class="text-muted">
                                HTML, JS, Vue
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-end">
                            250
                        </td>
                        <td>
                            <span class="badge badge-warning-light">Paused</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-7 mx-auto">
        <h4>No content yet</h4>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
        gradientLight.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradientLight.addColorStop(1, "rgba(215, 227, 244, 0)");
        var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
        gradientDark.addColorStop(0, "rgba(51, 66, 84, 1)");
        gradientDark.addColorStop(1, "rgba(51, 66, 84, 0)");
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
                    {
                        label: "Sales ($)",
                        fill: true,
                        backgroundColor: window.theme.id === "light" ? gradientLight : gradientDark,
                        borderColor: window.theme.primary,
                        data: [2115, 1562, 1584, 1892, 1587, 1923, 2566, 2448, 2805, 3438, 2917, 3327],
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                },
                hover: {
                    intersect: true,
                },
                plugins: {
                    filler: {
                        propagate: false,
                    },
                },
                scales: {
                    xAxes: [
                        {
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)",
                            },
                        },
                    ],
                    yAxes: [
                        {
                            ticks: {
                                stepSize: 1000,
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)",
                                fontColor: "#fff",
                            },
                        },
                    ],
                },
            },
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
                    {
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: 0.75,
                        categoryPercentage: 0.5,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            stacked: false,
                            gridLines: {
                                color: "transparent",
                            },
                        },
                    ],
                },
            },
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var markers = [
            {
                coords: [37.77, -122.41],
                name: "San Francisco: 375",
            },
            {
                coords: [40.71, -74.0],
                name: "New York: 350",
            },
            {
                coords: [39.09, -94.57],
                name: "Kansas City: 250",
            },
            {
                coords: [36.16, -115.13],
                name: "Las Vegas: 275",
            },
            {
                coords: [32.77, -96.79],
                name: "Dallas: 225",
            },
        ];
        var map = new jsVectorMap({
            map: "us_aea_en",
            selector: "#usa_map",
            zoomButtons: true,
            markers: markers,
            markerStyle: {
                initial: {
                    r: 9,
                    stroke: window.theme.white,
                    strokeWidth: 7,
                    stokeOpacity: 0.4,
                    fill: window.theme.primary,
                },
                hover: {
                    fill: window.theme.primary,
                    stroke: window.theme.primary,
                },
            },
            regionStyle: {
                initial: {
                    fill: window.theme["gray-200"],
                },
            },
            zoomOnScroll: false,
        });
        window.addEventListener("resize", () => {
            map.updateSize();
        });
        setTimeout(function () {
            map.updateSize();
        }, 250);
    });
</script>
@endpush