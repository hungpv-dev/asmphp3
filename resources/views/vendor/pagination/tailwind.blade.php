@if ($paginator->hasPages())
    <li class="pagination__list">
        @if ($paginator->onFirstPage())
            <span class="pagination__item--arrow  link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                          d="M244 400L100 256l144-144M120 256h292"/>
                </svg>
                <span class="visually-hidden">pagination arrow</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination__item--arrow  link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                          d="M244 400L100 256l144-144M120 256h292"/>
                </svg>
                <span class="visually-hidden">pagination arrow</span>
            </a>
        @endif
    <li>


    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="pagination__list"><a href="{{$url}}" class="pagination__item pagination__item--current">{{$page}}</a></li>
                @else
                    <li class="pagination__list"><a href="{{$url}}" class="pagination__item link">{{$page}}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach



    <li class="pagination__list">
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination__item--arrow  link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                          d="M268 112l144 144-144 144M392 256H100"/>
                </svg>
                <span class="visually-hidden">pagination arrow</span>
            </a>
        @else
            <span class="pagination__item--arrow  link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                          d="M268 112l144 144-144 144M392 256H100"/>
                </svg>
                <span class="visually-hidden">pagination arrow</span>
            </span>
        @endif
    <li>
@endif

