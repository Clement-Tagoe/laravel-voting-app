<div x-data="{ isOpen: false }" 
     x-init="
     Livewire.on('commentWasAdded', () => {
         isOpen = false
     })

     Livewire.hook('message.processed', (message, component) => {
        {{-- Pagination --}}
        if (['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)) {
            const firstComment = document.querySelector('.comment-container:first-child')
            firstComment.scrollIntoView({ behavior: 'smooth'})
        }
        
        {{-- Adding Comment --}}
        if (['commentWasAdded', 'statusWasUpdated'].includes(message.updateQueue[0].payload.event)
         && message.component.fingerprint.name === 'idea-comments') {
            const lastComment = document.querySelector('.comment-container:last-child')
            lastComment.scrollIntoView({ behavior: 'smooth'})
            lastComment.classList.add('bg-green-200')
            setTimeout(() => {
                lastComment.classList.remove('bg-green-200')
            }, 5000)
        }
    })

    @if(session('scrollToComment'))
        const commentToScrollTo = document.querySelector('#comment-{{session('scrollToComment')}}')
        commentToScrollTo.scrollIntoView({ behavior: 'smooth'})
        commentToScrollTo.classList.add('bg-green-200')
        setTimeout(() => {
            commentToScrollTo.classList.remove('bg-green-200')
        }, 5000)
    @endif
  "
     class="relative"
>
    <button @click="
            isOpen = !isOpen 
            if (isOpen) {
            $nextTick(() => $refs.comment.focus())
            }
            "

            type="button" 
            class="flex items-center w-32 justify-center h-11 text-sm font-semibold rounded-xl border border-blue-600 bg-blue-600 text-white hover:bg-blue-500 transition duration-150 ease-in px-6 py-3">
        Reply
    </button>
    <div 
        x-cloak 
        x-show.transition.origin.top.left.duration.500ms="isOpen" 
        @click.away="isOpen = false" 
        @keydown.escape.window="isOpen = false"
        class="absolute z-10 w-74 md:w-104 text-left font-semibold text-sm bg-white shadow-md rounded-xl mt-2"
    >
        
        @auth
        <form wire:submit.prevent="addComment" action="#" class="space-y-4 px-4 py-6">
            <div>
                <textarea x-ref="comment" wire:model="comment" name="post_comment" id="post_comment" cols="30" rows="4"
                class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Go ahead, don't be shy. Share your thoughts..." required></textarea>

                @error('comment')
                <p class="text-red-700 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-3">
                <button type="submit" class="flex items-center w-1/2 justify-center h-11 text-sm font-semibold rounded-xl border border-blue-600 bg-blue-600 text-white hover:bg-blue-500 transition duration-150 ease-in px-6 py-3">
                    Post Comment
                </button>
                <button type="button" class="flex items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <svg class="h-5 w-5 text-gray-600 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <span class="ml-1">Attach</span>
                </button>
            </div>
        </form>
        @else
            <div class="px-4 py-6">
                <p class="font-normal">Please login or create an account to post a comment.</p>
                <div class="flex items-center space-x-3 mt-8">
                    <a href="{{ route('login') }}"
                    class="w-1/2 h-11 text-sm text-center bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-500 transition duration-150 ease-in px-6 py-3">
                        Login
                    </a>
                    <a  href="{{ route('register') }}"
                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                        Sign Up
                    </a>
                </div>
            </div>
        @endauth
    </div>
</div>