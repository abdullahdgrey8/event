@include('components.Head')

<body>

    <x-navbar />
    <!-- New Content -->
    <div class="nav-md">
        <div class="container body">
            <!-- <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <img src="{{ asset('/build/images/ttl.svg') }}" alt="">
                        </div>

                        <div class="clearfix"></div>
                        
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
<!-- 
                    </div>
                </div> -->

                
                @include('layouts.nav')
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col extra-page-margin" role="main">
                    <div class="">
                        <!-- <div class="page-title">
                          
                        </div> -->

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 table-top">
                                <div class="x_panel">
                                    <!-- <div class="x_title">

                                        <div class="clearfix"></div>
                                    </div> -->
                                    <div class="x_content">
                                        <h1 style="color: black; text-transform:uppercase; padding:20px 0;">

                                            {{ $event_row->event_name }}
                                        </h1>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="hidden" name="event_id" id="event_id" value="{{ $event_id }}" />
                                                <!-- table-striped -->
                                                <button id="downloadListButton">Export to Excel</button>

                                                    <table id="event_table" class="candidate-table table "
                                                        style="width:100%">
                                                        <thead class="head-color">
                                                            <tr>                                                                
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Category</th>
                                                                <th>Uploaded file</th>
                                                                <th>Date and Time</th>                                                                                                                               
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
        <!-- <div class="modal" tabindex="-1" role="dialog" id="modal-container">
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
        </div> -->
        @include('components.Scripts')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <script>
         var csrfToken = '{{ csrf_token() }}';
 
    
    $(document).ready(function() {
        var table = $('#event_table').DataTable({
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": []
            }],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [
                [4, "desc"]
            ],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ route('get.all.candidates') }}",
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
                    "name": "event_id",
                    "value": $("#event_id").val()
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
    document.getElementById('downloadListButton').addEventListener('click', function() {
    // Get candidate table data
    var table = document.getElementById('event_table');
    var rows = table.querySelectorAll('tr');
    var data = [];
    for (var i = 0; i < rows.length; i++) {
      var cols = rows[i].querySelectorAll('td, th');
      var rowData = [];
      for (var j = 0; j < cols.length; j++) {
        rowData.push(cols[j].innerText);
      }
      data.push(rowData);
    }
    // Create Excel workbook
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.aoa_to_sheet(data);
    
    // Apply some basic styling to the Excel sheet
    var wscols = [
      { wch: 20 }, // Width of the columns
      { wch: 25 },
      { wch: 15 },
      { wch: 40 },
      { wch: 20 }
    ];
    ws['!cols'] = wscols;
    
    var wsrows = [
      { hpt: 20 }, // Height of the rows
      { hpt: 20 },
      { hpt: 20 },
      { hpt: 20 },
      { hpt: 20 }
    ];
    ws['!rows'] = wsrows;
    
    // Save Excel file
    XLSX.utils.book_append_sheet(wb, ws, 'CandidateList');
    XLSX.writeFile(wb, 'CandidateList.xlsx');
  });
    </script>
    <style>
            #event_table th,
    #event_table td {
        text-align: center;
    }
        .extra-page-margin{
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .x_panel{
            padding: 0 !important;
            width: 100vw;
            height: auto !important;
        }
        .head-color{
            background-color: #E4F1FD;
        }
        #event_table{
            margin-top: 50px !important;
        }
        #event_table_filter{
            position: absolute;
            z-index: 9989;
            left: 15px;
            top: 5px;
        }

        #event_table_info{
            display: none;
        }
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc:after{
        display: none;
    }
        .row{
            position: relative;
        }
    #downloadListButton{
        background-color: #FF5C00;
        color: white;
        font-weight: 600;
        font-size: medium;
        border: none;
        position: absolute;
        right: 30px;
        top: 7px;

        width: 166px;
        height: 44px;   

        border-radius: 2px;

    z-index: 9999;
  }
  #event_table{
            margin-top: 20px !important;
        }

        #event_table_info{
            padding-left: 170px;
        }
        .row{
            position: relative;
        }
        #event_table_wrapper .row:first-child,
    .dataTables_wrapper .row:first-child .col-sm-6  {
        position: static !important;
    }
    #event_table_wrapper{
        padding: 50px 0 !important;
    }

    #event_table_length {
        position: absolute;
        bottom: 0;
        z-index: 9999;
        left: 0;
        top: auto;
    }
    </style>

</body>

</html>