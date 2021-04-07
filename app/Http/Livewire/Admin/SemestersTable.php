<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Semesters;
use App\Classrooms;

class SemestersTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'semesters_id';
    public $orderAsc = false;

    public function render()
    {
        $data_classrooms = Classrooms::all();

        return view('livewire.admin.semesters-table', [
            'data' => Semesters::searchAdmin($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
            'classrooms' => $data_classrooms,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
