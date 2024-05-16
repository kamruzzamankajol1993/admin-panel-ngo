 <div class="user-profile pull-right" style="background: linear-gradient(90deg,#0D8D45,#93C13D)">
    <img class="avatar user-thumb" src="{{asset('/')}}{{ Auth::guard('admin')->user()->image }}" alt="avatar">
    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
    {{ Auth::guard('admin')->user()->name }}
    <i class="fa fa-angle-down"></i></h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
        onclick="event.preventDefault();
                      document.getElementById('admin-logout-form').submit();">Log Out</a>
    </div>

    <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>