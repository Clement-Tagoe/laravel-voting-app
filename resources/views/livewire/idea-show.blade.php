<div class="idea-and-buttons container"> 
    
    <div class="idea-container mt-4 bg-white rounded-xl flex">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-4">
                <a href="#">
                    <img src="{{$idea->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar1">
                </a>
            </div>
            
            <div class="w-full mx-2 md:mx-4">
                <h4 class="text-xl font-semibold">
                        {{$idea->title}}
                </h4>
                <div class="text-gray-600 mt-3">
                    @admin
                        @if ($idea->spam_reports > 0)
                            <div class="text-red-600 mb-2">Spam Reports: {{$idea->spam_reports}}</div>
                        @endif
                    @endadmin
                    {!! nl2br(e($idea->description)) !!}
                </div>
                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="hidden md:block font-bold text-gray-900">{{$idea->user->name}}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{$idea->created_at->diffForHumans()}}</div>
                        <div>&bull;</div>
                        <div>{{$idea->category->name}}</div>
                        <div>&bull;</div>
                        <div class="text-gray-700">{{$idea->comments()->count() . ' comment(s)'}}</div>
                    </div>
                    <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                        <div class="{{ 'status-'.Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{$idea->status->name}}</div>
                        @auth
                            <div class="relative">
                                <button @click="isOpen = !isOpen" class="relative bg-gray-100 text-gray-400 hover:bg-gray-200 border border-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 flex">
                                    <svg class="h-6 w-6 self-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </button>
                                <ul 
                                    x-cloak 
                                    x-show.transition.origin.top.left.duration.500ms="isOpen" 
                                    @click.away="isOpen = false" 
                                    @keydown.escape.window="isOpen = false"
                                    class="absolute w-36 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10 shadow-md text-left text-gray-900 font-semibold bg-white shadow-lg rounded-xl py-3">
                                    @can('update', $idea)
                                    <li>
                                        <a  
                                            href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            @click.prevent="
                                                isOpen = false
                                                $dispatch('custom-show-edit-modal')
                                            "
                                        >
                                            Edit Idea
                                        </a>
                                    </li>
                                    @endcan
                                    @can('delete', $idea)
                                    <li>
                                        <a  
                                            href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            @click="
                                                isOpen = false
                                                $dispatch('custom-show-delete-modal')
                                            "
                                        >
                                            Delete Idea
                                        </a>
                                    </li>
                                    @endcan
                                    <li>
                                        <a  
                                            href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            @click="
                                                isOpen = false
                                                $dispatch('custom-show-mark-idea-as-spam-modal')
                                            "
                                        >
                                            Mark As Spam
                                        </a>
                                    </li>
                                    @admin
                                        @if($idea->spam_reports > 0)
                                            <li>
                                                <a  
                                                    href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                                    @click="
                                                        isOpen = false
                                                        $dispatch('custom-show-mark-idea-as-not-spam-modal')
                                                    "
                                                >
                                                    Not Spam
                                                </a>
                                            </li>
                                        @endif
                                    @endadmin
                                </ul>
                            </div>
                        @endauth
                    </div>
                    <div class="flex items-center md:hidden mt-4 md:mt-0">
                        <div class="bg-gray-100 text-center rounded-full h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue-500 @endif">{{$votesCount}}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                        </div>
                        @if($hasVoted)
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
    </div>  {{-- End Ideas Container --}}

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="button-container flex flex-col md:flex-row items-center space-x-4 md:ml-6">
            <livewire:add-comment :idea="$idea" />
            @admin
                <livewire:set-status :idea="$idea" />
            @endadmin
        </div>


        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug @if($hasVoted) text-blue-500 @endif">{{$votesCount}}</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            @if ($hasVoted)
                <button type="button" 
                    wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-blue-500 text-white font-semibold uppercase rounded-xl border border-blue-500 hover:border-blue-400 transition duration-150 ease-in px-6 py-3">
                    <span>Voted</span>
                </button>   
            @else
                <button type="button" 
                    wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-gray-200 font-semibold uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <span>Vote</span>
                </button>
            @endif
            
        </div>
    </div>
    {{-- end buttons-container --}}
</div> {{-- end of idea and buttons container --}}
