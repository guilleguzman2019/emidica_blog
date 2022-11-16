<div class="flex-1 relative" x-data>
    
    <form action="" autocomplete="off">

        <input name="name" wire:model="search" type="text" class="w-full" placeholder="Buscar..." />

    </form>

    
    @if(!empty($posts) && $posts->count())
    <div class="absolute w-full mt-1 hidden" :class="{ 'hidden' : !$wire.open }" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-4  py-3 space-y-1">
                @forelse ($posts as $post)
                <div class="d-flex flex-row">
                    <div class="p-1">
                        <img class="" src="{{$post -> image}}" alt="" height="70px;" width="100px">
                    </div>
                    <div class="ml-4 text-gray-700 p-1">
                        <a class="text-warning" href="/blog/{{$post -> slug}}"><p class="text-lg font-semibold leading-5">{{$post->title}}</p></a>
                    </div>
                </div>
                @empty
                    <p class="text-lg leading-5">
                        No existe ningún registro con los parametros especificados
                    </p>
                @endforelse
            </div>
        </div>
    </div>
    @endif
</div>
