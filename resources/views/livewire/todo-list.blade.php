        <div>
        @if(session('error'))
            <div role="alert">
              <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error!
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>{{session('error')}}</p>
            </div>
        </div>
        @endif
        <div class="container content py-6 mx-auto">
            <div class="mx-auto">
                @include('livewire.includes.create')
            </div>
        </div>
        <div id="search-box" class="flex flex-col items-center px-2 my-4 justify-center">
            @include('livewire.includes.search')
        </div>
        <div id="todos-list">
            @foreach($todos as $todo)
            @include('livewire.includes.todo-card')

            @endforeach 
            <div class="my-2">
               {{$todos->links()}}
           </div>

       </div>

    </div>
