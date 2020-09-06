
<div class="card">
    <div class="flex items-center bg-gray-800 rounded-md">
        <div class=" flex-shrink-0">
            <svg class="h-10 w-auto"  height="80" width="272" version="1.1" viewBox="-10 -10 80 100"><defs><linearGradient id="a" x1="156" gradientUnits="userSpaceOnUse" y1="335" gradientTransform="matrix(.403 0 0 .403 -21.8 -51)" x2="151" y2="120"><stop style="stop-color:#36d1dc" offset="0"></stop><stop style="stop-color:#5b86e5" offset="1"></stop></linearGradient></defs><path style="fill:url(#a)" d="m80.3 40a40 40 0 0 1 -40.2 40 40 40 0 0 1 -40.1 -40 40 40 0 0 1 39.8 -40 40 40 0 0 1 40.5 39"></path><g style="fill:#fcfcfc"></g><path d="m56.1 38.5v-10.6c0-8.87-7.17-16-16-16-8.87 0-16 7.17-16 16v10.6c-1.35 0.439-2.7 0.892-4.01 1.44v24.1c12.8 5.33 27.3 5.33 40.1 0v-24.1c-1.4-0.5-2.7-0.9-4.1-1.4zm-12 21.5h-8.02l1.5-8.97c-0.892-0.736-1.5-1.81-1.5-3.06 0-2.22 1.79-4.01 4.01-4.01s4.01 1.79 4.01 4.01c0 1.25-0.604 2.32-1.5 3.06zm7.5-23c-7.9-1.9-15.2-1.9-23.1 0v-9.05c0-6.66 4.94-12 11.6-12s11.6 5.38 11.6 12z" style="fill:#fff"></path></svg>
        </div>

                <ul class="nav  ml-auto p-2">
                    <li>
                        <a href="#Roles_Permissions_Assignment" class="ml-4 nav-button" data-toggle="tab">
                            Roles &amp; Permissions Assignment
                        </a>
                    </li>
                    <li >
                        <a href="#Roles" class="ml-4 nav-button" data-toggle="tab">
                            Roles
                        </a>
                    </li>
                    <li >
                        <a href="#Permissions" class="ml-4 nav-button" data-toggle="tab">
                            Permissions
                        </a>
                    </li>

                </ul>

    </div><!--  -->
        <div class="tab-content">
            @include('dashboard.laratrust.roles')
            @include('dashboard.laratrust.Roles Assignment.roles_Assignment')
            @include('dashboard.laratrust.permissions')
        </div>
    </div>
        <!-- /.tab-content -->
</div><!-- ./custom tap -->

