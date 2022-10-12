<div class="comment-container relative mt-4 bg-white rounded-xl flex">
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{$comment->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar">
            </a>
        </div>
        
        <div class="w-full md:mx-4">
            <div class="text-gray-600 line-clamp-3">
                {{ $comment->body }}
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold text-gray-900">{{$comment->user->name}}</div>
                    <div>&bull;</div>
                    <div>{{$comment->created_at->diffForHumans()}}</div>
                </div>
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
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Idea</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 