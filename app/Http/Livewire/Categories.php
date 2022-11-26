<?php

namespace App\Http\Livewire;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class Categories extends Component
{
    public $modalFormVisible = false;
    public $catId;
    public $name;
    public $description;

    public function createShowModal(){
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }
    public function updateShowModal($id){
        $this->catId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }
    public function loadModel(){
        $data = Category::find($this->catId);
        $this->name = $data->name;
        $this->description = $data->description;
    }

    public function rules(){
        return [
            'name'  => ['required', Rule::unique('categories', 'name')],
        ];
    }

    public function save($id = NULL){
        $this->validate();
        if($id)
            Category::find($id)->update($this->modelData());
        else
            Category::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function modelData(){
        return [
            'name' => $this->name,
            'description' => $this->description
        ];
    }

    public function resetVars(){
        $this->catId = NULL;
        $this->name = NULL;
        $this->description = NULL;
    }

    public function read(){
        return Category::paginate(1);
    }

    // public function mount(){
    //     $this->resetPage();
    // }

    public function render()
    {
        return view('livewire.categories', [
            'data' => $this->read()
        ]);
    }
}
