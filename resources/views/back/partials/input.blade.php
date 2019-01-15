<div class="form-group {{ $errors->has($input['name']) ? 'has-error' : '' }}">
    @isset($input['title'])
        <label for="{{ $input['name'] }}">{{ $input['title'] }}</label>
    @endisset
    @if ($input['input'] === 'textarea')
        <textarea class="form-control" rows="{{ $input['rows'] }}" id="{{ $input['name'] }}" name="{{ $input['name'] }}" @if ($input['required']) required @endif>{{ old($input['name'], $input['value']) }}</textarea>
    @elseif ($input['input'] === 'checkbox')
        <div class="checkbox">
            <label>
                <input id="{{ $input['name'] }}" name="{{ $input['name'] }}" type="checkbox" {{ $input['value'] ? 'checked' : '' }}>{{ $input['label'] }}
            </label>
        </div>
    @elseif ($input['input'] === 'select')
        <select multiple required class="form-control" name="{{ $input['name'] }}[]" id="{{ $input['name'] }}">
            @foreach($input['options'] as $id => $title)
                <option value="{{ $id }}" {{ old($input['name']) ? (in_array($id, old($input['name'])) ? 'selected' : '') : ($input['values']->contains('id', $id) ? 'selected' : '') }}>{{ $title }}</option>
            @endforeach
        </select>
    @elseif ($input['input'] === 'option')
        <select required class="form-control" name="{{ $input['name'] }}" id="{{ $input['name'] }}">
            @foreach($input['options'] as $id => $title)
                <option value="{{ $id }}" {{ $input['value'] == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endforeach
        </select>
    @elseif ($input['input'] === 'slider')
        <input class="slider" id="{{ $input['name'] }}" name="{{ $input['name'] }}" type="text" data-slider-min="{{ $input['min'] }}" data-slider-max="{{ $input['max'] }}" data-slider-step="1" data-slider-value="{{ old($input['name'], $input['value']) }}"/>
    @elseif ($input['input'] === 'datetimerange')

        <div id="datetimerange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp; <span></span>
            <i class="fa fa-caret-down"></i>
            <input type="hidden" name="{{ $input['name'] }}" value="0">
            <input type="hidden" name="{{ $input['name'] }}_start" id="{{ $input['name'] }}_start" value="{{ $input['value']['start'] }}" required>
            <input type="hidden" name="{{ $input['name'] }}_end" id="{{ $input['name'] }}_end" value="{{ $input['value']['start'] }}" required>
        </div>

    @else
        <input type="text" class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}" value="{{ old($input['name'], $input['value']) }}" @if ($input['required']) required @endif>
    @endif
    {!! $errors->first($input['name'], '<span class="help-block">:message</span>') !!}
</div>
