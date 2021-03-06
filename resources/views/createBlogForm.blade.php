@extends('layouts.app')
@section('title')
    Create new post
@endsection
@section('content')

{{-- Main Container Start --}}
<div class="container">
    <h2 class="text-center mt-5">Lets create something amaizing</h2><br>

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="description">Required <span class="text-danger">*</span></label>
        <input type="text" name="description" class="form-control" placeholder="description"><br>
        <label for="body">Required <span class="text-danger">*</span></label>
        <textarea class="form-control" name="body" id="editor"  cols="30" rows="10" placeholder="Write your post"></textarea>
        <br>
        <label class="ml-2" for="image1">Add image 1 (Optional)</label>
        <input type="file" name="image1" class="form-control"><br>

        <label class="ml-2" for="image1">Add image 2 (Optional)</label>
        <input type="file" name="image2" class="form-control"><br>

        <label class="ml-2" for="image1">Add image 3 (Optional)</label>
        <input type="file" name="image3" class="form-control"><br>

        <select name="category" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
</div>
{{-- Main Container End --}}

@endsection

{{-- Text Editor Start --}}
@section('editor-scripts')

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
{{-- Text Editor End --}}
