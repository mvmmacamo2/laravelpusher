@extends('layouts.master')

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


                        {{--<form action="/save-disciplina"  method="POST">--}}
                        <form action="{{ URL::to('save-disciplina') }}" method="POST" id="form-c">
                            {{--{!! csrf_field() !!}--}}
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

    <div class="box-body">
        <table id="example2" class="table-sm table table-bordered table-hover">
            <thead>
            <tr>

                <td>ID</td>
                <td>NOME</td>
                <td>SIGLA</td>
                <td>Data Criacao</td>
                <td>Data de Actualização</td>
                <td>X</td>
            </tr>
            </thead>

            <tbody id="data-disciplina">

            </tbody>

        </table>
    </div>
    <!-- /.box-body -->

</div>
@endsection

@section('script')


    <script type="text/javascript">

        $(visualiza());

    // Save Data
    $('#form-c').on('submit', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        $.ajax({
            type: post,
            url: url,
            data: data,
            dataType: 'json',
            success: function (data) {

                $(tabelapusher());
                console.log(data)
            }
        })

    })

    function visualiza(){
        $(document).ready(function () {

            $.get("{{ URL::to('get-disciplina')}}", function (data) {
                $('#data-disciplina').empty().html(data)

            })
        })

    }

        function tabelapusher(){
            $(document).ready(function () {

                var pusher = new Pusher('8d536f492b252577e624');
                var channel = pusher.subscribe('my-channel');

                var eventName = 'my-event';
                var callback = function(dados) {
                    // add comment into page
                   console.log(data)
                };
                channel.bind(eventName, callback);

                channel.bind('pusher:subscription_succeeded', function(dados) {

                    console.log(dados)

                    for(var i=0;dados.length>i;i++){
                        //Adicionando registros retornados na tabela
                        $('#data-disciplina').append('<tr><td>'+dados[i].id+'</td><td>'+dados[i].nome+'</td><td>'+dados[i].sigla+'</td></tr>'+dados[i].created_at+'</td></tr>'+dados[i].updated_at+'</td></tr>');
                    }
                });
            })

        }

        // var pusher = new Pusher('APP_KEY');
        // var channel = pusher.subscribe('APPL');
        // var callback = function(data) {};
        // channel.bind('new-price', callback);
        //
        // // Remove just `handler` for the `new-price` event
        // channel.unbind('new-price', handler);
        //
        // // Remove all handlers for the `new-price` event
        // channel.unbind('new-price');
        //
        // // Remove all handlers on `channel`
        // channel.unbind();



        // listen for 'new-comment' event on channel 1, 2 and 3


    </script>

@endsection

