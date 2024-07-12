<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a style="margin-left: 3%;" class="navbar-brand" href="">Assignment</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($page_title === "Dashboard") ? 'active' : '' ?>" aria-current="page" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page_title === "Profile") ? 'active' : '' ?>" href="profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page_title === "Search Page") ? 'active' : '' ?>" href="search">Search Page</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="/logout">Logout</a>
                </li>
            </ul>
            <span style="margin-right: 2%;" class="navbar-text">
                <a href="profile"><img style="width: 45px; height: 45px; object-fit: cover; border: 3px solid rgb(34, 121, 220);" class="rounded-circle profile-picture sm" src="<?= base_url(session()->user['profile_picture']) ?>" alt="Profile Photo"></a>
            </span>

        </div>
    </div>
</nav>