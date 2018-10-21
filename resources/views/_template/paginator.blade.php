<div class="clearfix">
    <div class="hint-text">Mostrando <b>{{(($results->currentPage() -1 )* $results->perPage() + $results->count())}}</b> de <b>{{$results->total()}}</b></div>
    @if ($results->lastPage() > 1)
    <ul class="pagination">
        <li class="page-item {{ ($results->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $results->url(1) }}">Previo</a>
        </li>
        @for ($i = 1; $i <= $results->lastPage(); $i++)
            <li class="page-item {{ ($results->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $results->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ ($results->currentPage() == $results->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $results->url($results->currentPage()+1) }}" >Siguiente</a>
        </li>
    </ul>
    @endif
</div>
