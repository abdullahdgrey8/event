@include('components.Head')

<x-navbar />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
body {
    margin: 0px;
    /* height: 90vh; */
    box-sizing: border-box;
    /* background: #fff; */
}
</style>

<body class="nav-md">
    <!-- Display validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white relative inner-container">
    <div class="mt-5 mb-5 px-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p>Event Management > Add Event</p>
                <h1 class="mb-[50px]">Add New Event</h1>
                <br>
                <br>

                <!-- Form start -->

                <form id="myform">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <!-- Hidden input fields -->
                    <!-- Alert for duplicate event -->
                    <div id="duplicateEventAlert" class="alert alert-danger d-none" role="alert">
                        This event has already been created.
                    </div>
                    <div id="dateError" class="alert alert-danger d-none" role="alert">
                    The end date field must be a date after start date.
                    </div>
                    <!-- Alert for success -->
                    <div class="alert alert-primary d-none" role="alert" id="successPopup">

                    </div>

                    <!-- CSRF Token -->
                    @csrf

                    <!-- Event ID field -->
                    <input type="hidden" name="id" id="id" value="{{ $id }}">

                    <!-- Event Code field -->
                    @if($id > 0)
                        <div class="form-group col-md-4">
                            <label for="event_code" class="form-label">Event Code *</label>
                            <input disabled type="text" class="form-control" id="event_code" name="event_code" value="{{ $row->event_code }}">
                        </div>
                    @endif

                    <!-- Event Name field -->
                    <div class="form-group col-md-4">
                        <label for="eventName" class="form-label">Event Name *</label>
                        <input type="text" class="form-control" id="eventName" name="event_name" value="{{ old('event_name', $id > 0 ? $row->event_name : '') }}">
                        @error('event_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description field -->
                    <div class="form-group col-md-4">
                        <label for="description" class="form-label">Description *</label>
                        <input class="form-control" id="description" name="description" rows="3" value="{{ old('description', $id > 0 ? $row->description : '') }}"></input>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Start Date field -->
                    <div class="form-group col-md-4">
                        <label for="startDate" class="form-label">Start Date *</label>
                        <input type="text" class="form-control" id="startDate" name="start_date" value="{{ old('start_date', $id > 0 ? date('m/d/Y', strtotime($row->start_date)) : '') }}">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Date field -->
                    <div class="form-group col-md-6">
                        <label for="endDate" class="form-label">End Date *</label>
                        <input type="text" class="form-control" id="endDate" name="end_date" value="{{ old('end_date', $id > 0 ? date('m/d/Y', strtotime($row->end_date)) : '') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status field -->
                    <div class=" form-group col-md-6">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" {{ old('status', $id > 0 ? $row->status : '') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $id > 0 ? $row->status : '') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

            <!-- /top navigation -->

            <!-- Page Content -->
            @include('layouts.nav')

            <div class="bg-white relative inner-container">
                <div class="mt-5 mb-5 px-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @if($id > 0)
                            <p><a href="{{ url('view-events') }}">Event Management</a> > Edit Event</p>
                            @else
                            <p><a href="{{ url('view-events') }}">Event Management</a> > Add Event</p>
                            @endif
                            @if($id > 0)
                            <p style="font-size:20px; font-weight:bold; color:black;">Edit Event</p>
                            @else
                            <p style="font-size:20px; font-weight:bold; color:black;">Add Event</p>
                            @endif
                            <br>
                            <br>
                            <form id="myform">
                                <input type="hidden" name='slug' id='slug' value="@if($id>0) {{ $row->slug }} @endif">
                                <div id="duplicateEventAlert" class="alert alert-danger d-none" role="alert">
                                    This event has already been created.
                                </div>
                                <div class="alert alert-primary d-none" role="alert" id="successPopup">
                                    Event Created Successfully
                                </div>
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $id }}">
                                <div class="form-row">
                                    @if($id>0)
                                    <div class="form-group col-md-4">
                                        <label for="eventName" class="form-label">Event Name *</label>
                                        <input disabled type="text" class="form-control" id="event_code"
                                            name="event_code" value="@if($id>0) {{ $row->event_code }} @endif"></input>
                                    </div>
                                    @endif
                                    <div class="form-group col-md-4">
                                        <label for="eventName" class="form-label">Event Name *</label>
                                        <input type="text" class="form-control" id="eventName" name="event_name"
                                            value="@if($id>0) {{ $row->event_name }} @endif"></input>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="description" class="form-label">Description *</label>
                                        <input class="form-control" id="description" name="description" rows="3"
                                            value="@if($id>0) {{ $row->description }} @endif"></input>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="startDate" class="form-label">Start Date *</label>
                                        <input type="text" class="form-control" id="startDate" name="start_date"
                                            value="@if($id>0) {{ date('m/d/Y', strtotime($row->start_date)) }} @endif">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="endDate" class="form-label">End Date *</label>
                                        <input type="text"
                                            value="@if($id>0) {{ date('m/d/Y', strtotime($row->end_date)) }} @endif"
                                            class="form-control" id="endDate" name="end_date">
                                    </div>
                                    <div class=" form-group col-md-6">
                                        <label for="status" class="form-label">Status *</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-right fixed bottom-0 right-0">
                                    @if($id > 0)
                                    <button type="submit" class="btn btn-secondary"
                                        style="background-color:#1890FF; border:none;">Update</button>
                                    @else
                                    <button type="submit" class="btn btn-secondary"
                                        style="background-color:#1890FF; border:none;">Save</button>
                                    @endif

                                    <button type="button" class="btn btn-secondary ml-2">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
     
                </form>
                <!-- Form end -->
            </div>
        </div>
    </div>
</div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!-- jQuery -->
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/nprogress/nprogress.js') }}"></script>
    <!-- validator -->

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/build/js/custom.min.js') }}"></script>
    <!-- <script src="../build/js/custom.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



    <script>
    $(document).ready(function() {

        $(function() {
            $("#startDate").datepicker();
        });


        $(function() {
            $("#endDate").datepicker();
        });

        $('#myform').submit(function(event) {
            //console.log('before error msg');

            event.preventDefault();
            ///return false;
            $.ajax({
                url: '{{ route("event.store") }}',
                method: 'POST',
                data: $(this).serialize(),
                dataType:'json',
                success: function(response) {
                    console.log(response);
                    $('#successPopup').html(response.message);
                    if (response.success) {
                        $('#successPopup').removeClass('d-none');
                        setTimeout(function() {
                            window.location.href = '{{ route("viewEvents") }}';
                        }, 4000);
                    } else if (response.duplicate) {

                        $('#duplicateEventAlert').removeClass('d-none');
                        setTimeout(function() {
                            $('#duplicateEventAlert').addClass('d-none');
                        }, 5000);
                        
                    }
                    else{
                        $('#successPopup').removeClass('d-none');
                    }
                    // console.log('------before error msg');
                    console.warn(response)
                    // return false;
                    // $('#successPopup').html(response.message);
                    // if (response.success) {
                    //     $('#successPopup').removeClass('d-none');
                    // } else if (response.duplicate) {
                    //     $('#duplicateEventAlert').removeClass('d-none');

                    //     setTimeout(function() {
                    //         $('#duplicateEventAlert').addClass('d-none');
                    //     }, 5000);
                    // }

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
        $('#closePopupBtn').click(function() {
            $('#successPopup').hide();
        });
        $('.btn-secondary').click(function() {
            setTimeout(function() {
                window.location.href = '{{ route("viewEvents") }}';
            }, 2000);
        });
    });
    </script>

    <script>
    function generateSlug(title) {
        return title.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
    }
    $(document).ready(function() {

        $('#eventName').on('keyup', function() {
            var title = $('#eventName').val();
            var slug = generateSlug(title);
            $('#slug').val(slug);

        });
        $("#myform").validate({
            rules: {
                event_name: {
                    required: true,
                },
                description: {
                    required: true
                },
                start_date: {
                    required: true,
                    date: true
                },
                end_date: {
                    required: true,
                    date: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                event_name: {
                    required: "Please enter event name.",
                },
                description: {
                    required: "Please enter description."
                },
                start_date: {
                    required: "Please enter start date.",
                    date: "Invalid start date format."
                },
                end_date: {
                    required: "Please enter end date.",
                    date: "Invalid end date format."
                },
                status: {
                    required: "Please select status."
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    });
    </script>

</body>