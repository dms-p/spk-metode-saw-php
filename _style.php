    <style type="text/css">
        :root {
            --primary-dark: #00ADB5;
            --primary-darken: #009199;
            --secondary: #393E46;
            --font-family: 'Lato';
        }

        ::selection {background-color: var(--primary-dark);}

        /* Login */
        .material-half-bg .cover {background-color: var(--primary-dark);}
        .login-content .logo {font-family: var(--font-family);}
        .login-content .login-box {border-radius: .5rem;}

        /* Header */
        .app-header {background-color: var(--primary-dark);}
        .app-header__logo {font-family: var(--font-family); background-color: var(--primary-darken);}
        @media(max-width: 767px){ .app-header {padding-right: 0;} }
        .dropdown-item.active, .dropdown-item:active {background-color: var(--primary-dark);}
        .dropdown-item .fa {width: 16px;}

        /* Sidebar */
        .app-sidebar__toggle:focus, .app-sidebar__toggle:hover {background-color: var(--primary-darken);}
        .app-sidebar {background-color: #fff;}
        .app-sidebar__user {margin-bottom: 0;}
        .app-sidebar__user-avatar {margin-right: 0;}
        .app-menu__item {color: #333;}
        .app-menu__item.active, .app-menu__item:hover, .app-menu__item:focus {border-left-color: var(--primary-dark); background-color: var(--secondary);}

        /* Content */
        .app-content {margin-top: 30px;}

        /* Anchor */
        a {color: var(--primary-dark);}
        a:hover {color: var(--primary-darken);}

        /* Button */
        .btn-primary {background-color: var(--primary-dark); border-color: var(--primary-dark);}
        .btn-primary:hover {background-color: var(--primary-darken); border-color: var(--primary-darken);}
        .page-item.active .page-link {background-color: var(--primary-dark); border-color: var(--primary-dark);}

        /* Form */
        .form-control:focus {border-color: var(--primary-dark);}

        /* Table */
        #datatable tr td a.btn {width: 36px;}
        #datatable tr td a.btn .fa {margin-right: 0;}
        .table-saw tr th, .table-saw tr td {text-align: center;}
    </style>