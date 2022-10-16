<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Index
        </h2>
    </x-slot>

    <div class="py-12">
        <div>
            @foreach ($users as $user)
                @if ($user->id != auth()->id())
                    <div class="flex items-center justify-between px-10 py-4 mx-20 my-4 bg-white rounded shadow">
                        <div>{{$user->name}}</div>
                        <a href={{route("messages.show", $user->id)}} class="bg-red-500 text-white py-1 px-3 rounded border-b-4 border-red-700 active:scale-95 active:border-opacity-10">Chat</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
