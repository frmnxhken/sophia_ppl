<x-layout>
    <div class="row py-4">
        @foreach ($submissions as $submission)
        <div class="col-lg-3">
            <x-card-assesment :submission="$submission" :id="$id" />
        </div>
        @endforeach
    </div>
</x-layout>