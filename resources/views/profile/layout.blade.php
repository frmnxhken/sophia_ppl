<x-layout>
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3 text-center mb-5">

                <img id="photoPreview"
                    src="{{ Auth::user()->photo ?? 'https://via.placeholder.com/120' }}"
                    class="rounded-circle mb-3 object-fit-cover"
                    width="120" height="120">

                <h5 class="fw-bold fs-5">
                    {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}
                </h5>

                <p class="text-muted fs-vs">{{ Auth::user()->email }}</p>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-dark">Logout</button>
                </form>

            </div>

            <div class="col-lg-9 ps-lg-5 mt-4 mt-lg-0">
                @yield('content')
            </div>

        </div>
    </div>
</x-layout>