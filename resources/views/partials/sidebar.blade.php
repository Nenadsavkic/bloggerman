<div class="mt-5 d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">

    <img
    @if (isset(Auth::user()->user_image))
       src="{{ asset('/images/user_image/'.Auth::user()->user_image) }}"
    @else

      src="{{ asset('/images/user_image/noimage.jpg') }}"

    @endif

    class="img-fluid p-3"  style="border-radius:10%">

    <form action="{{ route('saveImg')}}" method="post" enctype="multipart/form-data">
     @csrf
     <input type="file" id="user_image" name="user_image" class="ml-3">
     <button class="btn btn-primary ml-3 mt-1" type="submit">Add profile image</button>
    </form>

    <form action="{{ route('deleteImg')}}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger ml-3 mt-1" type="submit"
        onclick="return confirm('Are you sure you want to delete your profile image');">Delete profile image</button>
    </form>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">


      <li>
        <a id="btn1" href="{{ route('post.create') }}"  class="btn btn-primary">
          Create new Post
        </a>
      </li>
      <li>
        <a id="btn2" href="{{ route('home') }}" class="btn btn-primary mt-2">
          All your posts
        </a>
      </li>
      <li>
        <form action="{{ route('deleteUser', ['id'=>Auth::user()->id]) }}" method="post">
            @csrf
            @method('delete')
          <button type="submit" class=" nav-link text-white ml-3 mr-3 mt-3 bg-transparent"
          onclick="return confirm('Are you sure you want to delete your profile');">Delete profile</button>
        </form>
      </li>

    </ul>
    <br>
    <hr>

</div>
