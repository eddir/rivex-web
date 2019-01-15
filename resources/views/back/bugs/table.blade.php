@foreach($bugs as $bug)
    <tr>
        <td>{{ $bug->id }}</td>
        <td><a href="{{ route('bugs.show', [$bug->id]) }}">{{ $bug->title }}</a></td>
        <td>{{ $bug->important->title }}</td>
        <td>{{ $bug->type->title }}</td>
        <td>{{ $bug->progress }}</td>
        <td>{{ $bug->user->name }}</td>
        <td>
            <input type="checkbox" name="status" value="{{ $bug->id }}" {{ $bug->active ? 'checked' : ''}}>
        </td>
        <td><a class="btn btn-success btn-xs btn-block" href="{{ route('bugs.show', [$bug->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('bugs.edit', [$bug->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('bugs.destroy', [$bug->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach
