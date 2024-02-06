@include('components.Head')

<body>
    <!-- class="antialiased" -->
    <!-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> -->
    <x-navbar />
    <!-- New Content -->
    <div class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <img src="{{ asset('/build/images/ttl.svg') }}" alt="">
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{ asset('/build/images/img.jpg') }}" alt="..."
                                    class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>John Doe</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('createevent') }}">Dashboard</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('form') }}">Form Validation</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-table"></i> Tables <span
                                                class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/') }}">Table Dynamic</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                        id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('/build/images/img.jpg') }}" alt="">John Doe
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right"
                                        aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="javascript:;"> Profile</a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">Help</a>
                                        <a class="dropdown-item" href="login.html"><i
                                                class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </div>
                                </li>


                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Users <small>Some examples to get you started</small></h3>
                            </div>

                            <div class="title_right">
                                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">Go!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Button Example <small>Users</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Settings 1</a>
                                                    <a class="dropdown-item" href="#">Settings 2</a>
                                                </div>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box table-responsive">
                                                    <p class="text-muted font-13 m-b-30">
                                                        The Buttons extension for DataTables provides a common set of
                                                        options, API methods and styling
                                                        to display buttons on a page that will interact with a
                                                        DataTable. The core library provides
                                                        the based framework upon which plug-ins can built.
                                                    </p>
                                                    <table id="event_table" class="table table-striped table-bordered"
                                                        style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr. No.</th>
                                                                <th>Event Code</th>
                                                                <th>Event Name</th>
                                                                <th>Description</th>
                                                                <th>Start date</th>
                                                                <th>End Date</th>
                                                                <th>Status</th>
                                                                <th>QR-Code</th>
                                                                <th>URL</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>


                                                        <tbody>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->
            </div>
        </div>

        @include('components.Scripts')


    </div>
    <script>
    var table = $('#event_table').DataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0, 7, 8, 9]
        }],
        "bProcessing": true,
        "bServerSide": true,
        "aaSorting": [
            [4, "desc"]
        ],
        "sPaginationType": "full_numbers",
        "sAjaxSource": "{{ route('get.all.events') }}",
        "language": {
            "infoFiltered": "",
            "processing": "Loading. Please wait..."
        },
        "aLengthMenu": [
            [10, 50, 100, 500],
            [10, 50, 100, 500]
        ],
        "fnServerParams": function(aoData) {


        }
    });
    </script>
</body>

</html>