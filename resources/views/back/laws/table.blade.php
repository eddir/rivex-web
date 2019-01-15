@foreach($laws as $law)
    <tr>
        <td>{{ $law->id }}</td>
        <td><a href="{{ route('laws.show', [$law->id]) }}">{{ $law->title }}</a></td>
        <td>{{ $law->location }}</td>
        <td><a class="btn btn-success btn-xs btn-block" href="{{ route('laws.show', [$law->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('laws.edit', [$law->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('laws.destroy', [$law->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach
