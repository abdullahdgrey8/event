@include('components.Head')

<body>

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

                        @include('layouts.sidebar')
                        <!-- /sidebar menu -->

                    </div>
                </div>


                @include('layouts.nav')
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">

                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="x_panel">
                                    <div class="x_title">

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <!-- viewCandidates.blade.php -->

                                        <div class="candidate-container">
                                            <h1 class="candidate-title">Candidate List</h1>
                                            <button id="downloadListButton">Download List</button>
                                            @if (!empty($candidates))
                                            <table class="candidate-table" id="candidateTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Category</th>
                                                        <th>Uploaded File</th>
                                                        <th>Date and Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($candidates as $candidate)
                                                    <tr>
                                                        <td>{{ $candidate->first_name }} {{ $candidate->last_name }}
                                                        </td>
                                                        <td>{{ $candidate->email }}</td>
                                                        <td>{{ $candidate->category }}</td>
                                                        <td>{{ $candidate->resume }}</td>
                                                        <td>{{ $candidate->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <p class="no-candidates">No candidates found for the specified event ID.</p>
                                            @endif
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
    .candidate-container {
        position: relative;
        max-width: 80vw;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #downloadListButton {
        position: absolute;
        right: 19px;
        top: 51px;
        position: absolute;
        right: 19px;
        top: 51px;
        /* background-color: #2A3F52; */
        border: none;
        color: #2a3f54;
        padding: 1px 13px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 0px;
        cursor: pointer;
        border-radius: 8px;
    }

    .candidate-title {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
        text-align: center;
        color: #333;
    }

    .candidate-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .candidate-table th,
    .candidate-table td {
        padding: 22px 79px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .candidate-table th {
        background-color: #2A3F54;
        color: #fff;
    }

    .candidate-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .no-candidates {
        text-align: center;
        color: #666;
        margin-top: 20px;
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

    body,
    html {
        height: 100%;
        margin: 0;
    }

    .qr-code {
        display: flex;
        justify-content: center;
        align-items: center;
        /* margin-top: 50px; */
    }

    .qr-code img {
        width: 50px;
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
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <script>
    // Add click event listener to the Download List button
    document.getElementById('downloadListButton').addEventListener('click', function() {
        // Get candidate table data
        var table = document.getElementById('candidateTable');
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
        var wscols = [{
                wch: 20
            }, // Width of the columns
            {
                wch: 25
            },
            {
                wch: 15
            },
            {
                wch: 40
            },
            {
                wch: 20
            }
        ];
        ws['!cols'] = wscols;

        var wsrows = [{
                hpt: 20
            }, // Height of the rows
            {
                hpt: 20
            },
            {
                hpt: 20
            },
            {
                hpt: 20
            },
            {
                hpt: 20
            }
        ];
        ws['!rows'] = wsrows;

        // Save Excel file
        XLSX.utils.book_append_sheet(wb, ws, 'CandidateList');
        XLSX.writeFile(wb, 'CandidateList.xlsx');
    });
    </script>

</body>

</html>