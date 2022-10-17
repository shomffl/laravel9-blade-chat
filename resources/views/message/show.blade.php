<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show
        </h2>
    </x-slot>

    <div class="py-12 px-10 h-[600px]">
        <div class="bg-white h-full mb-3 shadow-lg p-4">
            @foreach ($messages as $message)
                @if ($message->sender_id == auth()->id())
                    <div class="flex items-center gap-2">
                        <div class="bg-green-500 w-max px-3 py-1 my-2 rounded">
                            {{$message->message}}
                        </div>
                        <div class="text-xs">{{$message->created_at}}</div>
                    </div>

                @else
                    <div class="flex items-center gap-2">
                        <div class="ml-auto text-xs">{{$message->created_at}}</div>
                        <div class="bg-white border border-black w-max px-3 py-1 my-2 rounded">
                            {{$message->message}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
            <form class="flex gap-2" action={{route("messages.store")}} method="POST">
                @csrf
                {{-- messageと一緒に保存したいが画面には見せたくないデータはhiddenで隠してある。Controller側で値を設定することも可能だが、こっちの方が楽。 --}}
                <input value={{$reciever_id}} name="reciever_id" class="hidden">
                <input value={{auth()->id()}} name="sender_id" class="hidden">

                <textarea class="w-full" name="message"></textarea>
                <button type="submit" class="text-white bg-green-400 px-4 rounded border-b-4 border-green-600 active:scale-95 active:border-opacity-10">✔️</button>
            </form>
    </div>
</x-app-layout>
