<div class="m_dropdown-login dropdown-menu login-content" style="display: none;">
    <div class="clearfix">
        <ul class="account-content">
            <li class="avata-item">
                <i class="fa fa-user" aria-hidden="true"></i>
                <p class="user-name">{{ Auth::user()->name }}</p>
            </li>
            <li class="link-item"><a href="./account.html"><i class="fa fa-user"></i>My Account</a></li>
            <li class="link-item"><a href="{{ route("frontend.logout") }}"><i class="fa fa-sign-out"></i>Logout</a></li>
        </ul>
    </div>
</div>