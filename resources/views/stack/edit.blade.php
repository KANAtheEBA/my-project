<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            積む
        </h2>
    </x-slot>
    <div class="max-w-7xl mx auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form method="post" action="{{route('game.update', $game)}}" enctype="multipart/form-data">
        @csrf
        @method('patch')
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">タイトル</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2"></x-input-error>
                    <input type="text" name= "title" class="w-auto py-2 border border-gray-300 rounded-md" id="title" value="{{old('title', $game->title)}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="platform" class="font-semibold mt-4">プラットフォーム</label>
                    <x-input-error :messages="$errors->get('platform')" class="mt-2"></x-input-error>
                    <input type="text" name= "platform" class="w-auto py-2 border border-gray-300 rounded-md" id="platform" value="{{old('platform', $game->platform)}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="genre" class="font-semibold mt-4">ジャンル</label>
                    <x-input-error :messages="$errors->get('genre')" class="mt-2"></x-input-error>                   
                    <input type="text" name= "genre" class="w-auto py-2 border border-gray-300 rounded-md" id="genre" value="{{old('genre', $game->genre)}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="launch_date" class="font-semibold mt-4">発売日</label>
                    <input type="date" name= "launch_date" class="w-auto py-2 border border-gray-300 rounded-md" id="launch_date" value="{{old('launch_date', $game->launch_date)}}>
                </div>
                <div class="w-full flex flex-col">
                    <label for="purchase_date" class="font-semibold mt-4">購入日</label>
                    <input type="date" name= "purchase_date" class="w-auto py-2 border border-gray-300 rounded-md" id="purchase_date" value="{{old('purchase_date', $game->purchase_date)}}>
                </div>
                <div class="w-full flex flex-col">
                    <label for="developer" class="font-semibold mt-4">デベロッパー</label>
                    <input type="text" name= "developer" class="w-auto py-2 border border-gray-300 rounded-md" id="developer" value="{{old('developer', $game->developer)}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="publisher" class="font-semibold mt-4">パブリッシャー</label>
                    <input type="text" name= "publisher" class="w-auto py-2 border border-gray-300 rounded-md" id="publisher" value="{{old('publisher', $game->publisher)}}">
                </div>

                <div class="w-full flex flex-col">
                    <label for="image" class="font-semibold mt-4">画像</label>
                    <input type="file" name= "image" id="image">
                </div>
            </div>
            <x-primary-button class="mt-4">
                Update!
            </x-primary-button>
        </form>
    </div>
</x-app-layout>