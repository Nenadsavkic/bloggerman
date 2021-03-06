@extends('layouts.app')
@section('title')
    {{ $user->name }} homepage
@endsection
@section('content')
{{-- Container1  Start --}}
<div class="container-fluid bg-secondary">
    <div class="row">
        <div class="col-md-2 pl-5 offset-md-5 text-center">
            <h2 class="mt-5 text-white user_name">{{ $user->name }}</h2>
            <p class="text-white">Memaber since: {{ $user->created_at->format('M. d. Y') }}</p>
        </div>
        <div class="col-md-3 offset-md-5">
            <img
            @if (isset(Auth::user()->user_image))
               src="{{ asset('/images/user_image/'.Auth::user()->user_image) }}"
            @else

              src="{{ asset('/images/user_image/noimage.jpg') }}"

            @endif

            class="img-fluid p-3 user-image mt-1 rounded-circle">
        </div>
        <div class="col-md-5 offset-md-5 mb-3">

               <a href="{{ route('post.create') }}" class="btn btn-primary  rounded-pill ml-2">Create new Post</a>
               <a href="{{ route('editUserProfile') }}" class="btn btn-primary  rounded-pill">Edit Profile</a>
        </div>
    </div>

</div>
{{-- Conatiner1 End --}}
{{-- Conatiner2 Start --}}
<div class="container-fluid">
    <div class="row">
        <div class="col home-title">
            @if ($posts->count() == 0)
               <h2 class="mt-5 mb-5 text-center text-muted">Wow, that's a very clean portfolio!</h2>
            @else
              <h2 class="mt-5 mb-5 text-center text-muted">All your posts</h2>
            @endif
        </div>
    </div>
</div>
{{-- Conatiner2 End --}}


{{-- Conatiner3 Start --}}
<div class="container content justify-content-center">


        <div class="row">

            {{-- All User Posts --}}
            @foreach ($posts as $post)
            <div class="col-md-4  mt-5 pt-5">
                <div class="card text-center ">
                    <div class="card-header bg-dark text-light">
                       <p class="float-left mt-2">Author: {{ $post->user->name }} </p>
                       <p class="float-right mt-2">Views: {{ $post->views }} </p>
                    </div>
                    <div class="card-body">
                      <a class="text-muted" href="{{ route('singleUserPost', ['id'=>$post->id]) }}">
                        <h5 class="card-title">{{ $post->description }}</h5>
                        @if (isset($post->image1))
                            <img class="img-fluid card-img" src="/images/post_images/{{ $post->image1 }}" class="card-img">
                        @elseif(isset($post->image2))
                            <img class="img-fluid card-img" src="/images/post_images/{{ $post->image2 }}" class="card-img">
                        @elseif(isset($post->image3))
                            <img class="img-fluid card-img" src="/images/post_images/{{ $post->image3 }}" class="card-img">
                        @else
                            <img class="img-fluid card-img" src="/images/post_images/noimage.jpg">
                        @endif
                      </a>
                    </div>
                    <div class="card-footer text-muted bg-dark text-white">
                      <p class="float-left text-white mt-2">Created: {{ $post->created_at->format('d.m.Y') }}</p>
                      <p class="float-right text-white mt-2">Updated: {{ $post->updated_at->format('d.m.Y') }}</p>
                    </div>
                </div>
            </div>
           @endforeach
           {{-- All User Posts End --}}
        </div>




</div>
{{-- Conatiner3 End --}}


@endsection
