<x-layout>
    <div class="mw-md py-4">
        <div class="d-flex flex-column gap-2">
            @foreach ($classroom->posts as $post)
            <x-card-assignment :post="$post" :id="$id" :isAuthor="$isAuthor" />
            @endforeach
        </div>
    </div>
</x-layout>