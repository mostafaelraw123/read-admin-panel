<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar" aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i></i>
						<i></i>
						<i></i>
					</span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">
            {{----------------------------------------------------------------------}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active-page" href="{{route('admin.dashboard')}}" id="dashboardsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-devices_other nav-icon"></i>
                    {{__('admin.dashboard')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="dashboardsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{route('admin.dashboard')}}">{{__('admin.dashboard')}}</a>
                    </li>

                </ul>
            </li>
            {{----------------------------------------------------------------------}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-settings nav-icon"></i>
                    {{__('admin.setting')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{route('admins.index')}}">{{__('admin.setting')}}</a>
                    </li>


{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="{{route('contacts.index')}}">طلبات التواصل</a>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="{{route('firebaseNotification.index')}}">ارسال اشعارات</a>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="{{route('settings.index')}}">اعددات التطبيق</a>--}}
{{--                    </li>--}}
                </ul>
            </li>



        </ul>
    </div>
</nav>
