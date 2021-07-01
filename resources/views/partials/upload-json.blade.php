<div class="row mt-2">
    <form
        action="{{route('treatments.upload')}}"
        enctype="multipart/form-data"
        method="POST"
    >
        @csrf

        @include('layout.partials.messages')

        <div class="row">
            <div class="col-6">
                <input
                    type="file"
                    name="file"
                    class="form-control"
                >
            </div>
            <div class="col-2">
                <button
                    type="submit"
                    class="form-control"
                >
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
