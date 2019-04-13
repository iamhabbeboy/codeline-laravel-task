@extends('layouts.app')
    @section('content')
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row">
                    <div class="col-md-5">
                        <div id="image"></div>
                    </div>
                    <Div class="col-md-6">
                        <br><br><br>
                        <div id="preview"></div>
                        <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" id="previous">Previous</a></li>
                                <li class="page-item "><a class="page-link" href="javascript:void(0)" id="next">Next</a></li>
                            </ul>
                    </Div>
            </div>
        </div>
        </div>

        <script>
            $(function() {
                let index = 0;
                $('#next').on('click', function() {
                    index += 1;
                    $('#previous').parent().removeClass('disabled')
                    $.fn.loadFilms(index);
                })

                $('#previous').on('click', function() {
                    index -= 1;
                    const curIndex = (index < 0) ? 0 : index;
                    $.fn.loadFilms(curIndex);
                })

                $.fn.loadFilms(0);
            });
        </script>
    @endsection

