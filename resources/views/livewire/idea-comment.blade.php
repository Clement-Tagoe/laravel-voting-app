<div id="comment-{{$comment->id}}" class="@if ($comment->is_status_update) is-status-update {{ 'status-'.Str::kebab($comment->status->name)}}@endif comment-container relative mt-4 bg-white rounded-xl flex transition duration-500 ease-in">
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{$comment->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar">
            </a>
            @if ($comment->user->isAdmin())
                <div class="text-center font-bold text-blue-600 mt-1 text-xxs uppercase">
                    Admin
                </div>
            @endif
        </div>
        
        <div class="w-full md:mx-4">
            <div class="text-gray-600">
                @admin
                    @if ($comment->spam_reports > 0)
                        <div class="text-red-600 mb-2">Spam Reports: {{$comment->spam_reports}}</div>
                    @endif
                @endadmin

                @if ($comment->is_status_update)
                    <h4 class="text-xl font-semibold">
                        Status Changed to "{{$comment->status->name}}"
                    </h4>
                @endif

                <div>
                    {!! nl2br(e($comment->body)) !!}
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="@if ($comment->is_status_update) text-blue-600 @else text-gray-900 @endif font-bold">{{$comment->user->name}}</div>
                    <div>&bull;</div>
                    @if($comment->user->id === $ideaUserId)
                    <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                    <div>&bull;</div>
                    @endif
                    <div>{{$comment->created_at->diffForHumans()}}</div>
                </div>
                @auth
                <div x-data="{ isOpen: false }" class="flex items-center space-x-2">
                    <div class="relative">
                        <button @click="isOpen = !isOpen" class="relative bg-gray-100 text-gray-400 hover:bg-gray-200 border border-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 flex">
                            <svg class="h-6 w-6 self-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                        <ul x-cloak 
                            x-show.transition.origin.top.left.duration.500ms="isOpen" 
                            @click.away="isOpen = false" 
                            @keydown.escape.window="isOpen = false"
                            class="absolute w-36 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10 shadow-md text-left text-gray-900 font-semibold bg-white shadow-lg rounded-xl py-3">
                            @can('update', $comment)
                                <li>
                                    <a  
                                        href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setEditComment', {{ $comment->id }})
                                        "
                                    >
                                        Edit Comment
                                    </a>
                                </li>
                            @endcan
                            @can('delete', $comment)
                                <li>
                                    <a  
                                        href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setDeleteComment', {{ $comment->id }})
                                        "
                                    >
                                        Delete Comment
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a  
                                    href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                    "
                                >
                                    Mark as Spam
                                </a>
                            </li>
                            @admin
                                @if($comment->spam_reports > 0)
                                    <li>
                                        <a  
                                            href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            @click.prevent="
                                                isOpen = false
                                                Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                            "
                                        >
                                            Not Spam
                                        </a>
                                    </li>
                                @endif
                            @endadmin
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div> 