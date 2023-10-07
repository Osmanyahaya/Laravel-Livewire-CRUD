<?php

namespace App\Livewire;
use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
        {
            use WithPagination;
            #[Rule('required|min:4|max:100')]
    public $name;
    public $search;
    public $updateTodoID;

    #[Rule('required|min:4|max:100')]
    public $updateTodoName;

    public function  create(){
                $validated= $this->validateOnly('name');
                Todo::create($validated);
                $this->reset('name');
                session()->flash('success','Created Successfully');
                $this->resetPage();
            }
    public function  edit($todoID){
               $this->updateTodoID=$todoID;
               $this->updateTodoName=Todo::findOrFail($todoID)->name;
           }

    public function  cancelUpdate (){
            $this->reset('updateTodoName');
            $this->reset('updateTodoID');

        }

    public function update()
        {
           $validated= $this->validateOnly('updateTodoName');
           Todo::findOrFail($this->updateTodoID)->update([
            'name'=>$this->updateTodoName
        ]);

        $this->cancelUpdate();
       }

    public function render()
       {
        return view('livewire.todo-list',['todos'=>Todo::latest()->where('name','like', "%{$this->search}%")->paginate(5)]);

    }

    public function delete($todoID)
    {
        try{
           Todo::findOrFail($todoID)->delete();  

       }catch(Exception $e){

        session()->flash('error','The Todo Item could not be delete');
       }

    }

    public function toggleCheck($todoID)
    {
      $todo=Todo::findOrFail($todoID);  
      $todo->completed=!$todo->completed;
      $todo->save();

    }
    }
