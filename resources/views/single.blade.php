@extends('layouts.app')
    @section('content')
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div id="preview"></div>
                <img id="img" />
                <br><br>
                <h4 id="title"></h4>
                <div id="description"></div>
                <div id="rating"></div>
                <div id="release_date"></div>
                <div>
                    Ticket Price: <span id="currency_symbol"></span><span id="ticket_price"></span>
                </div>
                <div id="country"></div>
                <div id="genre"></div>


                    <form method="POST" id="comment_form">
                        <input type="hidden" name="film_slug" id="film_slug">
                        @if (Auth::user())
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" value="{{Auth::user()->name}}" name="name" class="form-control" required>
                                <label for="">comment</label>
                                <textarea name="comment" id="comment" class="form-control" required></textarea>
                                <br>
                                <button class="btn btn-primary btn-primary" type="submit">Comment</button>
                            </div>
                        @endif
                    </form>
                    <hr>
                <h3>Comment </h3>
                @if (!Auth::user())
                    <p>
                        <a href="{{route('login')}}">Login </a> OR
                        <a href="{{route('register')}}">Register</a> to comment
                    </p>
                @endif

                <div id="comments-list" ></div>
            </div>
        </div>
        </div>
        @section('script')
            <script>
                $(function() {
                    const url = window.location.href;
                    const [...slug] = url.split('/');
                    const slug_param = slug[slug.length-1];
                    $.fn.loadSingleFilm(slug_param)

                    $('#comment_form').on('submit', function(e) {
                        e.preventDefault();
                        const data = $(this).serialize();
                        const method = $(this).attr('method');
                        const API_TOKEN = 'vaGPbrXFDXLkrY9vWm79L3b9LXxBicbMEA6ZyhcdhwKpsyA3Zm1Kpb57565X';
                        const dataString = {
                            data: data,
                            method: method,
                            url: `/api/films/comment?api_token=${API_TOKEN}`,
                        };

                        $.fn.storecomment(dataString);
                    })

                    $.fn.comments(slug_param);

                    // $.fn.currency('Nigeria');
                });
            </script>
        @stop
    @endsection

