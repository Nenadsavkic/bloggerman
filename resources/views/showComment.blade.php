@extends('layouts.app')
@section('title')
    {{ $post->title }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                  <div class="card p-5 ">
                      <div>
                        <p class="float-left">Author: {{ $post->user->name }}</p>
                        <p class="float-right">Updated: {{ $post->updated_at->format('d.m.Y') }}</p>
                      </div>

                      <h2 class="text-center  mt-5">{{ $post->title }}</h2>
                      <div class="row mt-5">
                          <div class="col-md-4">
                                @if (isset($post->image1))
                                <img class="img-fluid" src="/images/post_images/{{ $post->image1 }}">
                                @else
                                    <img class="img-fluid" src="/images/post_images/noimage.jpg">
                                @endif

                            </div>

                            <div class="col-md-4">
                                @if (isset($post->image2))
                                <img class="img-fluid" src="/images/post_images/{{ $post->image2 }}">
                                @else
                                    <img class="img-fluid" src="/images/post_images/noimage.jpg">
                                @endif

                            </div>

                            <div class="col-md-4">
                                @if (isset($post->image3))
                                <img class="img-fluid" src="/images/post_images/{{ $post->image3 }}">
                                @else
                                    <img class="img-fluid" src="/images/post_images/noimage.jpg">
                                @endif

                            </div>
                        </div>


                      <p class="mt-5">{{ $post->body }}</p>
                  </div><br>


            </div>
        </div><br>

        <div class="row">
            <div class="col-md-8 offset-md-2">

                @foreach ($allComments as $comment)
                <div class="card mt-2">
                    <div>
                        <img class="m-1"

                        @if ($user->user_image)

                        src="/images/user_image/{{ $comment->user->user_image }}" style="width: 50px"

                       @else

                         src="/images/user_image/noimage.jpg" style="width: 20px">

                        @endif

                        <p class="float-left">{{ $user->name }} <span class="float-right p-2">
                        Created: {{ $post->created_at->format('d.m.Y') }}</span></p>
                    </div>

                   <p class="pl-3"><b>{{ $comment->body }}</b></p>

                </div>

                @endforeach


            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if (Auth::user())
                <form action="{{ route('createComment', ['id' =>$post->id]) }} " method="post">
                    @csrf
                    <input type="text" name="body" class="form-control" placeholder="Write your comment here"><br>
                    <button class="btn btn-primary" type="submit">Post</button>

                </form>
                @endif
                <br><br>
            </div>
        </div>
    </div>
@endsection