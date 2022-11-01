<div 
     wire:poll="getNotificationsCount" 
     x-data="{ isOpen: false}" 
     class="relative">
    <button @click=
        "isOpen = !isOpen
        if(isOpen) {
            Livewire.emit('getNotifications')
        }
        ">
        <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-gray-400">
            <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z" clip-rule="evenodd" />
        </svg>
        @if($notificationsCount)
            <div class="absolute rounded-full bg-red-500 text-white text-xxs w-6 h-6 flex justify-center items-center border-2 -top-2 -right-2">{{$notificationsCount}}</div>
        @endif
    </button>  
    <ul 
        x-cloak 
        x-show.transition.origin.top="isOpen" 
        @click.away="isOpen = false" 
        @keydown.escape.window="isOpen = false"
        class="absolute w-76 md:w-96 -right-28 md:-right-12 z-10 shadow-md text-left text-gray-900 text-left text-sm bg-white shadow-lg rounded-xl max-h-128 overflow-y-auto"
    >
        @if ($notifications->isNotEmpty() && ! $isLoading)
            @foreach ($notifications as $notification)
                <li>
                    <a  
                        href="{{ route('idea.show', $notification->data['idea_slug']) }}" 
                        class="flex hover:bg-gray-100 transition duration-150 ease-in px-5 py-3"
                        @click.prevent="
                            isOpen = false
                        "
                        wire:click.prevent="markAsRead('{{ $notification->id }}')"
                    >
                        <img src="{{ $notification->data['user_avatar'] }}" class="rounded-xl w-10 h-10" alt="avatar">
                        <div class="ml-4">
                            <div class="line-clamp-6">
                                <span class="font-semibold">{{ $notification->data['user_name'] }} </span>commented on <span class="font-semibold">{{ $notification->data['idea_title'] }}</span>:
                                <span>"{{ $notification->data['comment_body'] }}"</span>
                            </div>
                            <div class="text-xs text-gray-500 mt-2">{{$notification->created_at->diffForHumans()}}</div>
                        </div>
                    </a>
                </li> 
            @endforeach
            <li class="border-t border-gray-300 text-center">
                <button
                    wire:click="markAllAsRead"  
                    @click="isOpen = false"
                    class="w-full block font-semibold hover:bg-gray-100 transition duration-150 ease-in px-5 py-3"
                >
                    Mark all as read
                </button>
            </li>
        @elseif ( $isLoading)
            @foreach (range(1,3) as $item)
                <li class="animate-pulse flex items-cener transition duration-150 ease-in px-5 py-3">
                <div class="bg-gray-200 rounded-xl w-10 h-10"></div>
                <div class="flex-1 ml-4 space-y-2">
                        <div class="bg-gray-200 w-full rounded h-4"></div>
                        <div class="bg-gray-200 w-full rounded h-4"></div>
                        <div class="bg-gray-200 w-1/2 rounded h-4"></div>
                </div>
                </li>
            @endforeach
        @else
            <li class="mx-auto w-40 py-6">
                <img src="{{asset('images/no-ideas.svg')}}" alt="No Ideas" class="mx-auto mix-blend-luminosity">
                <div class="text-gray-400 text-center font-bold mt-6">
                    No new notifications...
                </div>
            </li>
        @endif
    </ul>                                                        
</div>