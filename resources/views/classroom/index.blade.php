<x-layout>

    <x-modal-code code="{{ $classroom->code }}" />
    <x-modal-create-information id="{{ $classroom->id }}" />

    <div class="mw-md py-4">
        <x-banner-class :classroom="$classroom" />

        <div class="row mt-3">

            <x-class-menu id="{{ $classroom->id }}" isAuthor="{{ $isAuthor }}" />

            <div class="col-md-8">
                <div class="pt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="fs-5 fw-bold mt-2">Postingan</h2>
                    @if($isAuthor)
                    <x-dropdown-post id="{{ $classroom->id }}" />
                    @endif
                </div>

                <div class="d-flex flex-column gap-2">
                    @foreach ($posts as $post)
                    <x-card-post :post="$post" :classroom="$classroom" :isAuthor="$isAuthor" />
                    <x-modal-edit-information :id="$classroom->id" :post="$post" />
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-layout>