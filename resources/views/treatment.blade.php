@extends('layout.main')

@section('content')
    <div class="row">
        <h1 class="mt-5">Choose a JSON file to import the data</h1>

        @include('partials.upload-json')

        @include('partials.treatments-table')
    </div>
@endsection
<strong></strong>
