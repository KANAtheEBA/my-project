<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            積んゲーリスト
        </h2>
    </x-slot>

    <div class="mx-auto px-6">
        @if(session('message'))
        <div class="text-red-600 font-bold">
            {{session('message')}}
        </div>
        @endif
        <p class="text-lg font-semibold">Hello, {{$user->name}}!</p>
                @foreach($games as $game)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <h1 class="p-4 text-lg font-semibold">
                <a href="{{route('game.show', $game)}}" class="text-blue-600">
                {{$game->title}}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-4 p-4 font-semibold">
                {{$game->platform}} /
                {{$game->genre}}
            </p>
            <div class="p-8">
                <img src="{{ asset('storage/images/' . $game->image)}}" alt="">
            </div>
            <div class="p-4 text-sm">
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
                登録日：{{$game->created_at->diffForHumans()}}
            </div>
        </div>
        @endforeach
        <div class="mb-4">
            {{ $games->links() }}
        </div>
    </div>
</x-app-layout>
