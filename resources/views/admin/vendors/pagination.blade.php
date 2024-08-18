<!-- Display the paginated data -->
@foreach($vendors as $vendor)
    <!-- Your data display logic here -->
    <p>{{ $vendor->name }}</p>
@endforeach

<!-- Pagination Links -->
<ul class="pagination pagination-rounded justify-content-end mb-2">
    <!-- Previous Page Link -->
    @if ($vendors->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $vendors->previousPageUrl() }}" aria-label="Previous">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        </li>
    @endif

    <!-- Pagination Links -->
    @for ($i = 1; $i <= $vendors->lastPage(); $i++)
        <li class="page-item {{ $vendors->currentPage() == $i ? 'active' : '' }}">
            <a class="page-link" href="{{ $vendors->url($i) }}">{{ $i }}</a>
        </li>
    @endfor

    <!-- Next Page Link -->
    @if ($vendors->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $vendors->nextPageUrl() }}" aria-label="Next">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link" href="javascript:void(0);" aria-label="Next">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    @endif
</ul>
