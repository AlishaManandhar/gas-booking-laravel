@extends('layout.app')

@section('title', 'Feedback Form')

@section('content')
    <div class="row mt-5">
        <div class="col-md-6 col-12 offset-md-3">
            <h2 class="mb-3">Reviews from our customers</h2>
            @foreach($reviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <b>{{$review->user->fullname}}</b> - {{$review->created_at->format('Y-m-d')}}
                            </div>
                            <div class="col-12 col-md-6 text-md-end">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <p>{{$review->review}}</p>

                        </div>
                    </div>
            @endforeach
            {{$reviews->links('pagination::bootstrap-5')}}
        </div>

        <div class="col-md-6 col-12 offset-md-3 mt-3">
            @auth()
                <form action="{{route('review.store')}}" method="post">
                    @csrf
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star" id="{{ $i }}"></i>
                        @endfor
                    </div>

                    <div class="input-group my-3">
                        <span class="input-group-text">Your Feedback</span>
                        <textarea class="form-control" aria-label="With textarea" name="review"> {{old('review')}}</textarea>
                    </div>

                    <input type="hidden" name="rating" id="rating" >
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Post</button>

                </form>
            @endauth

            @guest()
                <a href="/login" class="btn btn-primary">Login to post review</a>
            @endguest
        </div>

    </div>

    </div>


@endsection

@section('script')
    <script>

    $(document).ready(function (){

        $(".rating i").on('click', function () {
            let classname = $(this).attr('class');
            if (classname === "bi bi-star-fill")
            {
                $(this).removeClass("bi-star-fill").addClass("bi-star");
                $("#rating").val($(this).attr('id') - 1);
            }
            else{
                $(this).removeClass("bi-star").addClass("bi-star-fill");
                $(this).prevAll().removeClass("bi-star").addClass("bi-star-fill");
                $("#rating").val($(this).attr('id'));

            }
            $(this).nextAll().removeClass("bi-star-fill").addClass("bi-star");

        });

    });
    </script>
@endsection
