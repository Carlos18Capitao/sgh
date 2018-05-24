{{--{!! Form::number('qtd', null, ['class' => 'form-control', 'placeholder' => 'Informe a quantidade','tabindex'=>'5','max'=>$qtds->qtd]) !!}--}}
{{--<input class="form-control" placeholder="qtd" tabindex="6" name="qtd" type="number" id="qtd">--}}
@if(!empty($qtds))
    @foreach($qtds as $key => $value)
        <input class="form-control" placeholder="qtd" tabindex="6" name="qtd" type="number" id="qtd" max="{{ $value }}">
        {{--<option value="{{ $key }}">{{ $value }}</option>--}}
    @endforeach
@endif
