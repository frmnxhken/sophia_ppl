<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container py-2 d-flex justify-content-between align-items-center">

        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/JKT48.svg" class="navbar-brand-img" width="24" height="30" alt="main_logo">
            <span class="ms-1 text-dark fw-bold">Sophia.</span>
        </a>

        <div class="d-flex align-items-center order-lg-3">
            <p class="fs-6 d-none d-md-block mt-2">
                {{ Auth::user()->firstname." ".Auth::user()->lastname }}
            </p>
            <a href="/profile">
                <img src="{{ asset(Auth::user()->photo) }}" class="rounded-circle ms-3 object-fit-cover" width="35" height="35" alt="profile">
            </a>
            <!-- <button class="navbar-toggler ms-2 d-lg-none outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        </div>

        <!-- <div class="collapse navbar-collapse order-lg-2 pt-4 pt-lg-0" id="navbarNav">
            <ul class="navbar-nav ms-lg-5">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">List Task</a>
                </li>
            </ul>
        </div> -->

    </div>
</nav>