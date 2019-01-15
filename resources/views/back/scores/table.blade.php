@foreach($scores as $score)
    <tr>
        <td>{{ $score->id }}</td>
        <td><a href="{{ route('scores.show', [$score->id]) }}">{{ $score->user->name }}</a></td>
        <td>{{ $score->score }}</td>
        <td><a class="btn btn-success btn-xs btn-block" href="{{ route('scores.show', [$score->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>
    </tr>
@endforeach
