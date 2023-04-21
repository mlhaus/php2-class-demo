<?php /** @var TYPE_NAME $data */ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($data["title"] == "Home" ? "active" : "text-medium") ?>" aria-current="page" href="<?php echo URLROOT; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($data["title"] == "About" ? "active" : "text-medium") ?>" href="<?php echo URLROOT; ?>/pages/about">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo ($data["title"] == "Register" || $data["title"] == "Login" ? "active" : "text-medium") ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User Account
                        </a>
                        <ul class="dropdown-menu">
                            <?php if(!isLoggedIn()) { ?>
                            <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/user/register">Register</a></li>
                            <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/user/login">Login</a></li>
                            <?php } else { ?>
                            <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/user/logout">Logout</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mt-3 mt-lg-0" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>