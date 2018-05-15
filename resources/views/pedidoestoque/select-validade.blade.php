{{--<option disabled selected>Vali</option>--}}
@if(!empty($validades))
    @foreach($validades as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif
{{--<option>Sem Lote</option>--}}
{{--<option>Negado</option>--}}