@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="/save-disciplina", method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="disciplina">Disciplina</label>
                                <input type="text" class="form-control"  id="disciplina"  name="nome">

                            </div>

                            <div class="form-group">
                                <label for="sigla">Sigla</label>
                                <input type="text"  class="form-control" id="sigla" name="sigla">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary" id="delete">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

@section('script')

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>


<script type="text/javascript">
    // Save Data
    $('#form-d').on('submit', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        // var data = $(this).serialize();
        // var url = $(this).attr('action');
        // var post = $(this).attr('method');
        // $.ajax({
        //     type: post,
        //     url: url,
        //     data: data,
        //     dataType: 'json',
        //     success: function (data) {
        //         console.log(data)
        //
        //     }
        // })

    })

    // Delete Tutor
    // $(document).on('click', '#delete', function (e) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     e.preventDefault();
    //
    // })
</script>

@endsection

