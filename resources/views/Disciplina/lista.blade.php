@foreach($disciplina as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->nome }}</td>
        <td>{{ $value->sigla }} </td>
        <td>{{ $value->created_at }} </td>
        <td>{{ $value->updated_at }} </td>
        <td>
            <a href="/crianca_relatorio/{{$value->id}}"  class="btn btn-info btn-xs" id="editar" data-id="{{$value->id}}">Detalhes</a>
            <a href="/crianca/{{$value->id}}"  class=" btn btn-success btn-xs" id="ver" data-id="{{$value->id}}">Ediar</a>
            <a href="#"  class="btn btn-danger btn-xs" id="delete" data-id="{{$value->id}}">Excluir</a>
        </td>
    </tr>
@endforeach
