<div class="">
    <div class='flex justify-between top-bar px-4 pt-4'>
        <div class="ttl-logo"><img src="{{ asset('/build/images/logo.png') }}" alt=""></div>
        <nav class="nav navbar-nav">
            <ul class=" extra-navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/build/images/img.jpg') }}" alt="">{{  Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> Profile</a>
                        <a class="dropdown-item" href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item" href="javascript:;">Help</a>
                        <a class="dropdown-item" href="{{ route('get.destroy') }}"><i
                                class="fa fa-sign-out pull-right"></i>
                            Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>

    <div class="tabs bg-white">
        <ul class="extra-navbar-right tab-design p-0">
            <li class="flex gap-4">
                <img src="{{ asset('/build/images/calendar.svg') }}" alt="">
                <a href="{{ url('view-events') }}">View all events</a>
            </li>
            <li>
                <img src="{{ asset('/build/images/export.svg') }}" alt="">
                <a href="{{ url('add-event') }}">Create an event</a>
            </li>
        </ul>
    </div>
    