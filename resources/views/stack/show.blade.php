<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            個別表示
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <div class="bg-white w-full rouded-2xl">
            <div class="p-4 mt-4">
                <h1 class="text-lg font-semibold">
                    {{$game->title}}
                </h1>
                <div class="text-right flex">
                    <a href="{{route('game.edit', $game)}}" class="flex-1">
                        <x-primary-button>
                            編集
                        </x-primary-button>
                    </a>
                    <form method="post" action="{{route('game.destroy', $game)}}" class="flex-2">
                        @csrf
                        @method('delete')
                        <x-primary-button class="bg-red-700 ml-2">
                            削除
                        </x-primary-button>
                    </form>
                </div>
                <hr class="w-full">
                <p class="mt-4 font-semibold">
                    プラットフォーム：{{$game->platform}} </br>
                    ジャンル：
                    @forelse($game->genres as $genre)
                        {{ $genre->name }}@if(!$loop->last), @endif
                    @empty
                    -
                    @endforelse
                </p>

                <div class="p-4">
                <img src="{{ asset('storage/images/' . $game->image)}}" alt="">
                </div>
            </div>

            <div class="p-2 text-sm">
                <p>
                    開発元：{{$game->developer??'-'}} / 
                    パブリッシャー：{{$game->publisher??'-'}}
                </p>
                    <p>
                        発売日：{{$game->launch_date??'-'}} / 
                        購入日：{{$game->purchase_date??'-'}}
                    </p>
            </div>
            <div class="p-4 text-sm">
                登録日：{{$game->created_at}}
            </div>
        </div>

    </div>
</x-app-layout>
