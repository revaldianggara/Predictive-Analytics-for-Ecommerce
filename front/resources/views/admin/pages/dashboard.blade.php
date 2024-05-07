@extends('layouts.master')

@section('page_title', 'Dashboard')

@section('page_sub_title', 'Predictive Analytics for Terra Store')

@section('breadcrumb')
    @php
    $breadcrumbs = ['Home', ['Dashboard', route('admin.dashboard.index')]];
    @endphp
    @include('layouts.parts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@push('styles')

@endpush

@section('content')

<div class="content">
    <!-- Overview -->
    <div class="row row-deck">
        <div class="col-sm-6 col-xl-3">
            <!-- Pending Orders -->
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">32</dt>
                        <dd class="text-muted mb-0">Stock <br> Beauty</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fas fa-paint-brush font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                        View statistics
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Pending Orders -->
        </div>
        <div class="col-sm-6 col-xl-3">
            <!-- New Customers -->
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">124</dt>
                        <dd class="text-muted mb-0">Stock <br> Electronics</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fas fa-laptop font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                        View statistics
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
            <!-- END New Customers -->
        </div>
        <div class="col-sm-6 col-xl-3">
            <!-- Messages -->
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">45</dt>
                        <dd class="text-muted mb-0">Stock <br> Clothing</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fas fa-tshirt font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                        View statistics
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Messages -->
        </div>
        <div class="col-sm-6 col-xl-3">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">45</dt>
                        <dd class="text-muted mb-0">Stock <br> Home & Kitchen</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fas fa-home font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                        View statistics
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>
    </div>
    <!-- END Overview -->

    <!-- Statistics -->
    <div class="row">
        <div class="col-xl-8 d-flex flex-column">
            <!-- Earnings Summary -->
            <div class="block block-rounded flex-grow-1 d-flex flex-column">
                <div class="block-header block-header-default">
                    <h3 class="block-title">SALES TREND</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full flex-grow-1 d-flex align-items-center">
                    <!-- Earnings Chart Container -->
                    <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                    <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                    <canvas class="js-chartjs-earnings"></canvas>
                </div>
                <div class="block-content bg-body-light">
                    <div class="row items-push text-center w-100">
                        <div class="col-sm-4">
                            <dl class="mb-0">
                                <dt class="font-size-h3 font-w700">
                                    <i class="fa fa-arrow-up font-size-lg text-success"></i> 2.5%
                                </dt>
                                <dd class="text-muted mb-0">Customer Growth</dd>
                            </dl>
                        </div>
                        <div class="col-sm-4">
                            <dl class="mb-0">
                                <dt class="font-size-h3 font-w700">
                                    <i class="fa fa-arrow-up font-size-lg text-success"></i> 3.8%
                                </dt>
                                <dd class="text-muted mb-0">Page Views</dd>
                            </dl>
                        </div>
                        <div class="col-sm-4">
                            <dl class="mb-0">
                                <dt class="font-size-h3 font-w700">
                                    <i class="fa fa-arrow-up font-size-lg text-success"></i> 1.7%
                                </dt>
                                <dd class="text-muted mb-0">New Products</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Earnings Summary -->
        </div>
        <div class="col-xl-4 d-flex flex-column">
            <!-- Last 2 Weeks -->
            <!-- Sparkline Charts (.js-sparkline class is initialized in Helpers.sparkline() -->
            <!-- For more info and examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
            <div class="row row-deck flex-grow-1">
                <div class="col-md-6 col-xl-12">
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">570</dt>
                                <dd class="text-muted mb-0">Total Orders</dd>
                            </dl>
                            <div>
                                <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
                                    <i class="fa fa-caret-down mr-1"></i>
                                    2.2%
                                </div>
                            </div>
                        </div>
                        <div class="block-content p-1 text-center overflow-hidden">
                            <!-- Sparkline Line: Orders -->
                            <span class="js-sparkline" data-type="line"
                                  data-points="[33,29,32,37,38,30,34,28,43,45,26,45,49,39]"
                                  data-width="100%"
                                  data-height="70px"
                                  data-chart-range-min="20"
                                  data-line-color="rgba(210, 108, 122, .4)"
                                  data-fill-color="rgba(210, 108, 122, .15)"
                                  data-spot-color="transparent"
                                  data-min-spot-color="transparent"
                                  data-max-spot-color="transparent"
                                  data-highlight-spot-color="#D26C7A"
                                  data-highlight-line-color="#D26C7A"
                                  data-tooltip-suffix="Orders"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-12">
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">$500</dt>
                                <dd class="text-muted mb-0">Total Earnings</dd>
                            </dl>
                            <div>
                                <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
                                    <i class="fa fa-caret-up mr-1"></i>
                                    4.2%
                                </div>
                            </div>
                        </div>
                        <div class="block-content p-1 text-center oveflow-hidden">
                            <!-- Sparkline Line: Earnings -->
                            <span class="js-sparkline" data-type="line"
                                  data-points="[716,1185,750,1365,956,890,1200,968,1158,1025,920,1190,720,1352]"
                                  data-width="100%"
                                  data-height="70px"
                                  data-chart-range-min="300"
                                  data-line-color="rgba(70,195,123, .4)"
                                  data-fill-color="rgba(70,195,123, .15)"
                                  data-spot-color="transparent"
                                  data-min-spot-color="transparent"
                                  data-max-spot-color="transparent"
                                  data-highlight-spot-color="#46C37B"
                                  data-highlight-line-color="#46C37B"
                                  data-tooltip-prefix="$"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">264</dt>
                                <dd class="text-muted mb-0">New Customers</dd>
                            </dl>
                            <div>
                                <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
                                    <i class="fa fa-caret-up mr-1"></i>
                                    9.3%
                                </div>
                            </div>
                        </div>
                        <div class="block-content p-1 text-center oveflow-hidden">
                            <!-- Sparkline Line: New Customers -->
                            <span class="js-sparkline" data-type="line"
                                  data-points="[25,15,36,14,29,19,36,41,28,26,29,33,23,41]"
                                  data-width="100%"
                                  data-height="70px"
                                  data-chart-range-min="0"
                                  data-line-color="rgba(70,195,123, .4)"
                                  data-fill-color="rgba(70,195,123, .15)"
                                  data-spot-color="transparent"
                                  data-min-spot-color="transparent"
                                  data-max-spot-color="transparent"
                                  data-highlight-spot-color="#46C37B"
                                  data-highlight-line-color="#46C37B"
                                  data-tooltip-prefix="$"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Last 2 Weeks -->
        </div>
    </div>
    <!-- END Statistics -->

    <!-- Recent Orders -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Product Recommendation</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-primary" id="dropdown-recent-orders-filters" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ml-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right font-size-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Customer ID..
                            <span class="badge badge-primary badge-pill">9</span>
                        </a>
                        <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Products
                            <span class="badge badge-primary badge-pill">11</span>
                        </a>
                        {{-- <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            For Delivery
                            <span class="badge badge-primary badge-pill">20</span>
                        </a>
                        <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Canceled
                            <span class="badge badge-primary badge-pill">72</span>
                        </a>
                        <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Delivered
                            <span class="badge badge-primary badge-pill">890</span>
                        </a>
                        <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge badge-primary badge-pill">997</span>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <!-- Search Form -->
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search by cusomer id..">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END Search Form -->
        </div>
        <div class="block-content">
            <!-- Recent Orders Table -->
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 120px;">Customer_ID</th>
                            {{-- <th class="d-none d-sm-table-cell">Created</th>
                            <th class="d-none d-xl-table-cell">Customer</th> --}}
                            {{-- <th>Status</th> --}}
                            <th class="d-none d-xl-table-cell text-center">Products</th>
                            {{-- <th class="d-none d-sm-table-cell text-center">Profit</th>
                            <th class="d-none d-sm-table-cell text-right">Value</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>1</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Clothing</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>3</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Beauty, Electronics</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>4</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Home & Kitchen</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>12</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Home & Kitchen</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>45</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Beauty</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>2</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Cloths</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>6</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Home & Kitchen, Cloths</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>20</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Beauty</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>21</strong>
                                </a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">Home & Kitchen</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Recent Orders Table -->

            <!-- Pagination -->
            <nav aria-label="Photos Search Navigation">
                <ul class="pagination pagination-sm justify-content-end mt-2">
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                            Prev
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:void(0)">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" aria-label="Next">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END Pagination -->
        </div>
    </div>
    <!-- END Recent Orders -->
</div>

@endsection

@push('scripts')

<script src="{{asset('oneUI/js/sparkline.min.js')}}"></script>
<script src="{{asset('oneUI/js/chart.min.js')}}"></script>
<script src="{{asset('oneUI/js/dashboard.min.js')}}"></script>


@endpush
