<div>

    @if($comments->isNotEmpty())

        <div class="comments-container relative md:ml-22 mt-1 pt-4 space-y-6 my-8">
            @foreach ($comments as $comment)
                <livewire:idea-comment 
                    :key="$comment->id"
                    :comment="$comment"
                    :ideaUserId="$idea->user->id"
                />
            @endforeach
        </div>

        <div class="my-8 md:ml-22">
            {{$comments->onEachSide(1)->links()}}
        </div>

        @else
            <div class="mx-auto w-70 mt-12 mb-10">
                <img src="{{asset('images/no-ideas.svg')}}" alt="No Ideas" class="mx-auto mix-blend-luminosity">
                <div class="text-gray-400 text-center font-bold mt-6">
                    No comments yet ...
                </div>
            </div>
        @endif

</div>