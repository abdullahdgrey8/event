@include('components.Head')

<x-navbar />

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <!-- <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella
                                Alela!</span></a> -->
                        <img src="{{ asset('/build/images/ttl.svg') }}" alt="">
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('/build/images/img.jpg') }}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>John Doe</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('layouts.sidebar')
                    <!-- /sidebar menu -->


                </div>
            </div>

            <!-- top navigation -->
            @include('layouts.nav')
            <!-- /top navigation -->

            <!-- Page Content -->
            <!-- editEvent.blade.php -->
            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="eventName">Event Name *</label>
                    <input type="text" class="form-control" id="eventName" name="event_name"
                        value="{{ $event->event_name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        required>{{ $event->description }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="startDate">Start Date *</label>
                        <input type="date" class="form-control" id="startDate" name="start_date"
                            value="{{ $event->start_date }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endDate">End Date *</label>
                        <input type="date" class="form-control" id="endDate" name="end_date"
                            value="{{ $event->end_date }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $event->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <!-- New Input Field -->
                <div class="form-group">
                    <label for="newField">New Field *</label>
                    <input type="text" class="form-control" id="newField" name="new_field"
                        value="{{ $event->new_field }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>


            <!-- Page Content -->

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route("event.store") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



    <!-- jQuery -->
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/nprogress/nprogress.js') }}"></script>
    <!-- validator -->
    <!-- <script src="../vendors/validator/validator.js"></script> -->

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/build/js/custom.min.js') }}"></script>
    <!-- <script src="../build/js/custom.min.js"></script> -->

</body>