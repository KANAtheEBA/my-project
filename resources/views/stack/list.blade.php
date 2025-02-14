<x-app-layout>
    <x-slot name="header" class="flex">
        <div class="flex w-full text-white leading-tight">                    
            <div class="relative flex w-full">
                <img src="{{ $imagePath }}" alt="" class="w-full" />
                <div class="absolute inset-0 flex items-center">
                    <p class="p-8 text-white text-4xl font-extrabold">積んゲーリスト</p>
                </div>
                <div class="absolute inset-0 flex items-end justify-end">
                    <p class="px-8 py-4 text-xl">Lv.{{ $rank }}</p>                    
                </div>   
            </div>
    </x-slot>

    <div class="mx-auto px-6 bg-gray-900 text-white">
        @if(session('message'))
        <div class="text-red-600 font-bold">
            {{session('message')}}
        </div>
        @endif
        
                @foreach($games as $game)
        <div class="mt-4 p-8 bg-slate-800 w-full">
            <h1 class="p-2 text-2xl font-semibold">
                <a href="{{route('game.show', $game)}}" class="text-lime-300">
                {{$game->title}}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-2 p-2 font-semibold">
                プラットフォーム：{{$game->platform}} </br>
                ジャンル：
                @forelse($game->genres as $genre)
                    {{ $genre->name }}@if(!$loop->last), @endif
                @empty
                    -
                @endforelse
            </p>
            <div class="p-1">
                <img src="{{ asset('storage/images/' . $game->image)}}" alt="">
            </div>
            <div class="p-2 font-thin">
                <p>
                    開発元：{{$game->developer??'-'}} / 
                    パブリッシャー：{{$game->publisher??'-'}}
                </p>
                    <p>
                        発売日：{{$game->launch_date??'-'}} / 
                        購入日：{{$game->purchase_date??'-'}}
                    </p>
            </div>
            <div class="p-2 text-sm font-thin">
                登録日：{{$game->created_at->diffForHumans()}}
            </div>
        </div>
        @endforeach
        <div class="mb-4">
            {{ $games->links() }}
        </div>
    </div>
</x-app-layout>
