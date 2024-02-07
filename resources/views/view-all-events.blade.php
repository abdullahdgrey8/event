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
                                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('add-event') }}">Create Event</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-table"></i> Events <span
                                                class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('view-events') }}">Table Dynamic</a></li>
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
                                                    <div style="display:flex; justify-content:space-between;">
                                                        <div style="display:flex;gap:10px; ">
                                                            <div>
                                                                <label for="event_code">Event Code:</label><br>
                                                                <input type="text" id="event_code" name="event_code"
                                                                    class="form-control">
                                                            </div>
                                                            <div>

                                                                <label for="event_name">Event Name:</label><br>
                                                                <input type="text" id="event_name" name="event_name"
                                                                    class="form-control">
                                                            </div>

                                                            <div>

                                                                <label for="start_date">Start Date:</label><br>
                                                                <input type="date" id="start_date" name="start_date"
                                                                    class="form-control">
                                                            </div>
                                                            <div>


                                                                <label for="end_date">End Date:</label><br>
                                                                <input type="date" id="end_date" name="end_date"
                                                                    class="form-control">
                                                            </div>
                                                            <div>

                                                                <label for="status">Status:</label><br>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="">Select Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">inactive</option>
                                                                </select>
                                                            </div>

                                                            <div style="margin-top: 25px;">

                                                                <button id="apply_filters"
                                                                    class="btn btn-secondary">Apply</button>
                                                            </div>
                                                        </div>

                                                        <div style="margin-top: 25px;">

                                                            <button style="margin-right: 15px;" class="btn btn-primary"
                                                                id="apply_filters">Add New
                                                                Event</button>
                                                        </div>
                                                    </div>
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
    <style>
    .edit-action {
        display: flex;
        justify-content: center;
        gap: 10px;
        font-size: 20px;
    }

    .qr-code {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .qr-code img {
        width: 50px;
        min-height: 50px;
    }

    .img-replace {
        display: inline-block;
        overflow: hidden;
        text-indent: 100%;
        color: transparent;
        white-space: nowrap;
    }


    .customization_popup_trigger {
        display: block;
        width: 170px;
        height: 50px;
        line-height: 50px;
        margin: 3em auto;
        text-align: center;
        color: #FFF;
        font-size: 14px;
        font-size: 0.875rem;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 50em;
        background: #2196F3;
        box-shadow: 0 3px 0 rgba(0, 0, 0, 0.07);
    }

    @media only screen and (min-width: 1170px) {
        .customization_popup_trigger {
            margin: 6em auto;
        }
    }


    /* --------------------------------

xpopup

-------------------------------- */

    .customization_popup {
        position: fixed;
        height: 100%;
        width: 100%;
        background-color: rgba(94, 110, 141, 0.9);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s;
        -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s;
        transition: opacity 0.3s 0s, visibility 0s 0.3s;
    }

    .customization_popup.is-visible {
        opacity: 1;
        visibility: visible;
        -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
        -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
        transition: opacity 0.3s 0s, visibility 0s 0s;
    }

    .customization_popup_container {
        position: absolute;
        width: 30%;
        /*     max-width: 400px; */
        margin: 0 auto;
        right: 0;
        top: 0;
        height: 100vh;
        background: #FFF;
        border-radius: .25em .25em .4em .4em;
        text-align: center;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        -webkit-transform: translatex(400px);
        -moz-transform: translatex(400px);
        -ms-transform: translatex(400px);
        -o-transform: translatex(400px);
        transform: translatex(400px);
        -webkit-backface-visibility: hidden;
        -webkit-transition-property: -webkit-transform;
        -moz-transition-property: -moz-transform;
        transition-property: transform;
        -webkit-transition-duration: 0.3s;
        -moz-transition-duration: 0.3s;
        transition-duration: 0.3s;
    }

    .customization_popup_container p {
        padding: 3em 1em;
    }

    .customization_popup_container .customization_popup_buttons:after {
        content: "";
        display: table;
        clear: both;
    }

    .customization_popup_container .customization_popup_buttons li {
        float: left;
        width: 50%;
        list-style: none;
    }

    .customization_popup_container .customization_popup_buttons a {
        display: block;
        height: 60px;
        line-height: 60px;
        text-transform: uppercase;
        color: #FFF;
        -webkit-transition: background-color 0.2s;
        -moz-transition: background-color 0.2s;
        transition: background-color 0.2s;
    }

    .customization_popup_container .customization_popup_buttons li:first-child a {
        background: #fc7169;
        border-radius: 0 0 0 .25em;
    }

    .no-touch .customization_popup_container .customization_popup_buttons li:first-child a:hover {
        background-color: #fc8982;
    }

    .customization_popup_container .customization_popup_buttons li:last-child a {
        background: #b6bece;
        border-radius: 0 0 .25em 0;
    }

    .no-touch .customization_popup_container .customization_popup_buttons li:last-child a:hover {
        background-color: #c5ccd8;
    }

    .customization_popup_container .customization_popup_close {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 30px;
        height: 30px;
    }

    .customization_popup_container .customization_popup_close::before,
    .customization_popup_container .customization_popup_close::after {
        content: '';
        position: absolute;
        top: 12px;
        width: 14px;
        height: 3px;
        background-color: #8f9cb5;
    }

    .customization_popup_container .customization_popup_close::before {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
        left: 8px;
    }

    .customization_popup_container .customization_popup_close::after {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
        right: 8px;
    }

    .is-visible .customization_popup_container {
        -webkit-transform: translateY(0);
        -moz-transform: translateY(0);
        -ms-transform: translateY(0);
        -o-transform: translateY(0);
        transform: translateY(0);
    }

    @media only screen and (min-width: 1170px) {
        .customization_popup_container {
            margin: 8em auto;
        }
    }
    </style>
    <script>
    jQuery(document).ready(function($) {
        $('.customization_popup_trigger').on('click', function(event) {
            event.preventDefault();
            $('.customization_popup').addClass('is-visible');
        });
        $('.customization_popup').on('click', function(event) {
            if ($(event.target).is('.customization_popup_close') || $(event.target).is(
                    '.customization_popup')) {
                event.preventDefault();
                $(this).removeClass('is-visible');
            }
        });
        $(document).keyup(function(event) {
            if (event.which == '27') {
                $('.customization_popup').removeClass('is-visible');
            }
        });
    });

    $(document).ready(function() {
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
                aoData.push({
                    "name": "event_code",
                    "value": $("#event_code").val()
                });
                aoData.push({
                    "name": "event_name",
                    "value": $("#event_name").val()
                });
                aoData.push({
                    "name": "start_date",
                    "value": $("#start_date").val()
                });
                aoData.push({
                    "name": "end_date",
                    "value": $("#end_date").val()
                });
                aoData.push({
                    "name": "status",
                    "value": $("#status").val()
                });

            }
        });
        var objTable = table;
        /*$("#event_code, #event_name, #start_date, #end_date, #status").change(function() {
            objTable.draw();
        });
        */
        $("#apply_filters").click(function() {
            objTable.draw();
        });
    });
    </script>
</body>

</html>