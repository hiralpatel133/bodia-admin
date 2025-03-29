Dashboard

<form id="frm_sidebar_logout" class="d-none" method="POST" action="{{ route('dashboard.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
<a href="javascript:void(0);" class="nav-link" onclick="document.getElementById('frm_sidebar_logout').submit();">
    <i class="nav-icon fas fa-sign-out-alt"></i>
    <p>
        User Logout
    </p>
</a>