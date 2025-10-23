@props([
    'title',
    'limit' => false,
    'date' => null,
    'href' => null,
])

<div 
    @class([
        'min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col transition ease-in-out duration-150',
        'cursor-pointer hover:bg-gray-200' => !empty($href),
    ])
    @if(!empty($href)) 
        onclick="window.location='{{ $href }}'" 
    @endif
>   
    <div class="font-semibold">{{ $title }}</div>
    @if(!empty($date))
        <div class="text-sm text-gray-500">{{ $date }}</div>
    @endif

    <div 
        @class([
            'mt-3 text-gray-800 text-ellipsis',
            'line-clamp-5' => $limit,
        ])
    >
        {!! $slot !!}
    </div>
</div>
