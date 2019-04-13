@extends('layouts.app')
    @section('content')
        <div class="container">
            <form method="POST" id="film-form">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                <h3>Create New Film</h3>
            <form method="post">
                <div class="form-group">
                    <label>Photo </label>
                    <input type="file" name="photo" id="photo">
                </div>
                <div class="form-group">
                    <label>Name </label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label>Name </label>
                    <textarea id="description" class="form-control" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>Release Date </label>
                    <input type="date" class="form-control" id="release_date" requierd>
                </div>
                <div class="form-group">
                        <label>Rating </label>
                        <select id="rating" required class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="">Ticket Price</label>
                    <input type="text" class="form-control" required id="ticket_price">
                </div>
                <div class="form-group">
                    <label for="">Country</label>
                    <select name="country" id="country" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="">Genre <a href="#" data-toggle="modal" data-target="#add-genre">Add Genre </a> </label> <br>
                    @if (count($genres) > 0)
                        @foreach($genres as $genre)
                            {{$genre->title}} <input type="checkbox" value="{{$genre->title}}" class="genre">
                        @endforeach
                    @else
                        No genre available, click on add genre
                    @endif
                    <span id="genre-response">sd</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-lg">Submit</button>
                </div>
            </form>
                </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" id="add-genre">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Genre</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="">Title</label>
                              <input type="text" class="form-control" id="genre-title">
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="genre-btn">Submit</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                    </div>
                </form>
        </div>

        @section('script')
            <script>
                $(function() {
                    $.fn.countries()
                });
            </script>
        @stop
    @endsection

