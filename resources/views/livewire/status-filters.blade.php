<nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('All')" href="{{route('idea.index', ['status' => 'All'])}}" class="border-b-4 pb-3 hover:border-blue-600 @if ($status === 'All') border-blue-600 text-gray-900 @endif">ALL IDEAS ({{$statusCount['all_statuses']}})</a></li>
        <li><a wire:click.prevent="setStatus('Considering')" href="{{route('idea.index', ['status' => 'Considering'])}}" class="transition duration-500 ease-in border-b-4 pb-3 hover:border-blue-600 @if ($status === 'Considering') border-blue-600 text-gray-900 @endif">CONSIDERING ({{$statusCount['considering']}})</a></li>
        <li><a wire:click.prevent="setStatus('In Progress')" href="{{route('idea.index', ['status' => 'In Progress'])}}" class="transition duration-500 ease-in border-b-4 pb-3 hover:border-blue-600 @if ($status === 'In Progress') border-blue-600 text-gray-900 @endif">IN PROGRESS ({{$statusCount['in_progress']}})</a></li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('Implemented')" href="{{route('idea.index', ['status' => 'Implemented'])}}" class="transition duration-500 ease-in border-b-4 pb-3 hover:border-blue-600 @if ($status === 'Implemented') border-blue-600 text-gray-900 @endif">IMPLEMENTED ({{$statusCount['implemented']}})</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href="{{route('idea.index', ['status' => 'Closed'])}}" class="transition duration-500 ease-in border-b-4 pb-3 hover:border-blue-600 @if ($status === 'Closed') border-blue-600 text-gray-900 @endif">CLOSED ({{$statusCount['closed']}})</a></li>
    </ul>
</nav>