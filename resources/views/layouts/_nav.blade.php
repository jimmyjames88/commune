<nav>
    <ul class="flex flex-row">
        @foreach($links as $link)
            @php
                if($loop->iteration === 1)
                    $class = 'mr-1';
                elseif($loop->iteration === $loop->count)
                    $class = 'ml-1';
                else
                    $class = 'ml-1 mr-1';
            @endphp
            <li class="{{ $class }}">
                <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
            </li>
        @endforeach
    </ul>
</nav>
