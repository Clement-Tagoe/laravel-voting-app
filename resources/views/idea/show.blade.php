<x-app-layout>
    <div>
        <a href="{{$backUrl}}" class="flex items-center font-semibold hover:underline">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
              </svg>
            <span class="ml-2">All ideas (or back to chosen category with filters)</span>
        </a>
    </div>

    <livewire:idea-show :idea="$idea" :votesCount="$votesCount" />

    @can('update', $idea)
        <livewire:edit-idea :idea="$idea"/>
    @endcan
    
    @can('delete', $idea)
        <livewire:delete-idea :idea="$idea"/>
    @endcan
    @auth
        <livewire:mark-idea-as-spam :idea="$idea"/>
    @endauth
    @auth
        <livewire:mark-idea-as-not-spam :idea="$idea"/>
    @endauth

    <div class="comments-container relative md:ml-22 mt-1 pt-4 space-y-6 my-8">
        <div class="comment-container relative mt-4 bg-white rounded-xl flex">
            <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="{{$idea->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar">
                    </a>
                </div>
                
                <div class="w-full md:mx-4">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">
                            A random title can go here
                        </a>
                    </h4> --}}
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim quaerat veniam sunt ut omnis reprehenderit neque 
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
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
        <div class="is-admin comment-container relative mt-4 bg-white rounded-xl flex">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="{{$idea->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar">
                    </a>
                    <div class="text-center font-bold text-blue-600 mt-1 text-xxs uppercase">
                        Admin
                    </div>
                </div>
                
                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" >
                            Status Changed to "Under Consideration"
                        </a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim quaerat veniam sunt ut omnis reprehenderit neque
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-blue-600">Andrea</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
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
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="comment-container relative mt-4 bg-white rounded-xl flex">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="{{$idea->user->getAvatar()}}" class="w-14 h-14 rounded-xl" alt="avatar">
                    </a>
                </div>
                
                <div class="w-full mx-4">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">
                            A random title can go here
                        </a>
                    </h4> --}}
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim quaerat veniam sunt ut omnis reprehenderit neque 
                    </div>
                    <div x-data="{ isOpen: false }" class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="flex items-center space-x-2">
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
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    {{-- end comments container --}}

</x-app-layout>
