@foreach($violations as $violation)
    <tr>
        <td>{{ $violation->id }}</td>
        <td><a href="{{ route('violations.show', [$violation->id]) }}">{{ $violation->violator }}</a></td>
        <td>{{ $violation->location }}</td>
        <td>{{ $violation->user->name }}</td>
        <td>{{ $violation->law->title }}</td>
        <td>{{ $violation->term_start }}</td>
        <td>{{ $violation->term_end }}</td>
        <td><a class="btn btn-success btn-xs btn-block" href="{{ route('violations.show', [$violation->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('violations.edit', [$violation->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('violations.destroy', [$violation->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach
