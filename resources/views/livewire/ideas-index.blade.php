<div>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-1/3">
            <select wire:model="category" name="category" id="category" class="w-full rounded-xl border-none px-4 py-2">
                <option value="All Categories">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/3">
            <select name="other_filters" id="other_filters" class="w-full rounded-xl border-none px-4 py-2">
                <option value="Filter One">Filter One</option>
                <option value="Filter Two">Filter Two</option>
                <option value="Filter Three">Filter Three</option>
                <option value="Filter Four">Filter Four</option>
            </select>
        </div>

        <div class="w-full md:w-2/3 relative">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div> 
            <input type="search" placeholder="Find an idea" class="w-full placeholder-gray-900 rounded-xl bg-white border-none px-4 py-2 pl-8">
        </div>
    </div>
    {{-- end filters --}}

    <div class="ideas-container space-y-6 my-6">
        @foreach ($ideas as $idea)
            <livewire:idea-index 
                :key="$idea->id"
                :idea="$idea"
                :votesCount="$idea->votes_count"
            />
        @endforeach
        
    </div>

    <div class="py-6">
        {{-- {{$ideas->links()}} --}}
        {{$ideas->appends(request()->query())->links()}}
    </div>
</div>