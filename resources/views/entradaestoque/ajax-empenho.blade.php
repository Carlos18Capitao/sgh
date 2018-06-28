<option disabled selected>Selecione o Empenho</option>
{{--@if(!empty($empenhos))--}}
    @foreach($empenhos as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
{{--@endif--}}
