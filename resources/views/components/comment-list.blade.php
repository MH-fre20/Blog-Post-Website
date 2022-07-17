@forelse ($comments as $item)
    {{ $item->content }}
    {{-- @tags(['tags' => $item->tags])@endtags --}}
    @component('components.updated', ['date' => $item->created_at, 'name' => $item->user->name, 'userId' => $item->user->id])
    @endcomponent
@empty
<div>
    <p class="p-2 shadow-3 shadow text-blue-400">no comments yet !!!</p>
</div>
    
@endforelse
