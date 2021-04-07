<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Bookings;

class BookingsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'bookings_id';
    public $orderAsc = false;

    public function render()
    {
        return view('livewire.front.bookings-table', [
            'data' => Bookings::searchFront($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
