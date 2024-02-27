@include('components.Head')

<body>

    <x-navbar />
    <!-- New Content -->
    <div class="nav-md">
        <div class="container body">
            <!-- <div class="main_container"> -->
            <!-- <div class="col-md-3 left_col"> -->
            <!-- <div class="left_col scroll-view"> -->
            <!-- <div class="navbar nav_title" style="border: 0;">
                            <img src="{{ asset('/build/images/ttl.svg') }}" alt="">
                        </div> -->

            <!-- <div class="clearfix"></div> -->

            <!-- menu profile quick info -->
            <!-- <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{ asset('/build/images/img.jpg') }}" alt="..."
                                    class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>John Doe</h2>
                            </div>
                        </div> -->
            <!-- /menu profile quick info -->

            <!-- <br /> -->



            <!-- /sidebar menu -->

            <!-- </div> -->
            <!-- </div> -->


            @include('layouts.nav')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col extra-page-margin" role="main">
                <div class="">
                    <!-- Delete this -->
                    <!-- <div class="page-title">
                          
                        </div> -->

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <!-- <div class="x_title">

                                        <div class="clearfix"></div>
                                    </div> -->
                                <div class="x_content">
                                    <h1 class="pb-4 heading">Event Management</h1>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box ">

                                                <div style="display:flex; justify-content:space-between;">
                                                    <div style="display:flex;gap:10px; ">
                                                        <div>
                                                            <!-- <label for="event_code">Event Code:</label><br> -->
                                                            <input type="text" id="event_code" name="event_code"
                                                                class="form-control" placeholder="Event Code">
                                                        </div>
                                                        <div>

                                                            <!-- <label for="event_name">Event Name:</label><br> -->
                                                            <input type="text" id="event_name" name="event_name"
                                                                class="form-control" placeholder="Event Name">
                                                        </div>

                                                        <div>

                                                            <!-- <label for="start_date">Start Date:</label><br> -->
                                                            <input type="date" id="start_date" name="start_date"
                                                                class="form-control" placeholder="Start Date">
                                                        </div>
                                                        <div>


                                                            <!-- <label for="end_date">End Date:</label><br> -->
                                                            <input type="date" id="end_date" name="end_date"
                                                                class="form-control" placeholder="End Date">
                                                        </div>
                                                        <div>

                                                            <!-- <label for="status">Status:</label><br> -->
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="">Select Status</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">inactive</option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <a href=""></a>
                                                            <button id="apply_filters"
                                                                class="btn btn-primary">Apply</button>
                                                        </div>
                                                    </div>
                                                   

                                                    <div >
                                                        <?php
                                                            $baseUrl = url('/');
                                                            echo '<a id="apply_filters" class=" btn apply-btn" href="'.$baseUrl.'/add-event'.'">Add New
                                                            Event</a>'
                                                            ?>
                                                    </div>
                                                </div>
                                                <table id="event_table" class="table" style="width:100%">
                                                    <thead class="head-color">
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Event Code</th>
                                                            <th>Event Name</th>
                                                            <th>Description</th>
                                                            <th>Start date</th>
                                                            <th>End Date</th>
                                                            <th>Status</th>
                                                            <th>QR Code</th>
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
            <!-- </div> -->
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal-container">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body" id="qrcode_data">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        @include('components.Scripts')
    </div>
    <script>
    var csrfToken = '{{ csrf_token() }}';
    $(document).ready(function() {
        $(document).on("click", ".open-modal", function() {
            var id = $(this).attr("data");

            //console.warn(id);
            $.ajax({
                url: "{{ route('generate.qr.code') }}",
                type: 'POST',
                data: {
                    'event_id': id,
                    '_token': csrfToken
                }, // Convert the data to JSON string
                success: function(response) {
                    $('#modal-container').modal('show');
                    $("#qrcode_data").html(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        });
    });

    $(document).ready(function() {
        var table = $('#event_table').DataTable({
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [ 7, 8, 9]
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
    <style>

#event_table {
        text-align: center;
    }

    #event_table th,
    #event_table td {
        text-align: center;
    }
    .extra-page-margin {
        margin-left: 0 !important;
        padding: 0 !important;
    }

    .x_panel {
        padding: 0 !important;
        width: 100vw;
        height: auto;
    }

    .head-color {
        background-color: #E4F1FD;
    }

    #event_table_filter {
        display: none;
    }

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
        width: 25px;
        /* min-height: 50px; */
    }

    .img-replace {
        display: inline-block;
        overflow: hidden;
        text-indent: 100%;
        color: transparent;
        white-space: nowrap;
    }

    body,
    html {
        height: 100%;
        margin: 0;
    }
.heading{
    font-size:20px;
    color: black;
}
    .qr-code {
        display: flex;
        justify-content: center;
        align-items: center;
        /* margin-top: 50px; */
    }

    .qr-code.open-modal {
        /* Customize appearance as needed (e.g., cursor, display) */
        cursor: pointer;
        display: inline-block;
    }

    /* Styles for the hidden modal container */
    #modal-container {
        display: none;
        /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.4);
        /* Semi-transparent background */
        z-index: 999;
        /* Ensure modal is on top of other elements */
    }

    /* Styles for the modal window */
    .modal {
        position: absolute;
        /* top: 50%;
        left: 50%; */
        /* transform: translate(-50%, -50%); */
        background-color: white;
        z-index: 9999 !important;
        /* Customize background color */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        /* Add rounded corners for a smoother look */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        /* Create depth and shadow */
    }

    /* Styles for the modal close button */
    .modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border: none;
        background-color: red;
        /* Customize color */
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 3px;
        /* Add rounded corners for the button */
    }

    .head-color {
        background-color: #E4F1FD;
    }

    /* .head-color td{
            display: flex;
            justify-content: center;
        } */
    #event_table {
        margin-top: 20px !important;
    }

    #event_table_filter {
        position: absolute;
        z-index: 9989;
        right: 1314px;
    }

    #event_table_info {
        padding-left: 170px;
        display: none;
    }

    .row {
        position: relative;
    }

    #event_table_wrapper .row:first-child,
    .dataTables_wrapper .row:first-child .col-sm-6 {
        position: static !important;
    }

    #event_table_length {
        position: absolute;
        bottom: -17px;
        z-index: 9999;
        left: 0;
        top: auto;
        padding-left: 10px;
    }
    table.dataTable thead .sorting:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc:after{
        display: none;
    }
    .apply-btn{
        background-color:#FF5C00 ;
        color: white;
    }
    /* table.dataTable thead .sorting_desc:after {
        display: none;
    }
    table.dataTable thead .sorting_asc:after{
        display: none;
    } */
    </style>

</body>

</html>