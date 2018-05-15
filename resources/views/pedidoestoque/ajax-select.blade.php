<option disabled selected>Selecione o Lote</option>
@if(!empty($lotes))
    @foreach($lotes as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif
{{--<option>Sem Lote</option>--}}
{{--<option>Negado</option>--}}
