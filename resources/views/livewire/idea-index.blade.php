<div 
    x-data
    @click="const clicked = $event.target
    const target = clicked.tagName.toLowerCase()
    const ignores = ['button', 'svg', 'path', 'a']
    if (! ignores.includes(target)) {
        clicked.closest('.idea-container').querySelector('.idea-link').click()
    }
    "
    class="idea-container hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl @if($hasVoted) text-blue-500 @endif">{{$votesCount}}</div>
            <div class="text-gray-500">Votes</div>
        </div>
        @if ($hasVoted)
            <div class="mt-8">
                <button
                    wire:click.prevent="vote" 
                    class="w-20 bg-blue-500 text-white font-bold border border-blue-500 hover:border-blue-400 text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">Voted</button>
            </div>
        @else
            <div class="mt-8">
                <button 
                    wire:click.prevent="vote"
                    class="w-20 bg-gray-200 font-bold border border-gray-200 hover:border-gray-400 text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">Vote</button>
            </div>  
        @endif
        
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{$idea->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar">
            </a>
        </div>
        
        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{route('idea.show', $idea)}}" class="idea-link hover:underline">
                    {{$idea->title}}
                </a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                @admin
                    @if ($idea->spam_reports > 0)
                        <div class="text-red-600 mb-2">Spam Reports: {{$idea->spam_reports}}</div>
                    @endif
                @endadmin
                {{$idea->description}}
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div>{{$idea->created_at->diffForHumans()}}</div>
                    <div>&bull;</div>
                    <div>{{$idea->category->name}}</div>
                    <div>&bull;</div>
                    <div wire:ignore class="text-gray-700">{{$idea->comments_count . ' comment(s)'}}</div>
                </div>
                <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                    <div class="text-xxs {{'status-'.Str::kebab($idea->status->name)}} font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{$idea->status->name}}</div>
                    {{-- <button @click="isOpen = !isOpen" class="relative bg-gray-100 text-gray-400 hover:bg-gray-200 border border-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 flex">
                        <svg class="h-6 w-6 self-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                        <ul x-cloak 
                            x-show.transition.origin.top.left.duration.500ms="isOpen" 
                            @click.away="isOpen = false" 
                            @keydown.escape.window="isOpen = false"
                            class="absolute w-36 md:ml-8 top-8 md:top-6 right-0 md:left-0 shadow-md text-left text-gray-900 font-semibold bg-white shadow-lg rounded-xl py-3">
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                        </ul>
                    </button> --}}
                </div>
                <div class="flex items-center md:hidden mt-4 md:mt-0">
                    <div class="bg-gray-100 text-center rounded-full h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none @if($hasVoted) text-blue-500 @endif">{{$votesCount}}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                    </div>
                    @if ($hasVoted)
                        <button 
                            wire:click.prevent="vote"
                            class="w-20 bg-blue-500 text-white text-xxs font-bold rounded-full border border-blue-500 hover:border-blue-400 transition duration-150 ease-in px-6 py-3 -mx-5">
                            Voted
                        </button>
                    @else
                        <button 
                            wire:click.prevent="vote"
                            class="w-20 bg-gray-200 text-xxs font-bold rounded-full border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 -mx-5">
                            Vote
                        </button>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
        {{-- end of idea container --}}
