<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Bookings;
use Illuminate\Support\Facades\DB;

class HomeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $orderBy = 'bookings_id';
    public $orderAsc = false;

    public function render()
    {
        $data_bookings = DB::table('bookings AS b')
                        ->join('classrooms AS c', 'c.classrooms_id', '=', 'b.classrooms_id')
                        ->join('semesters AS s', 's.semesters_id', '=', 'b.semesters_id')
                        ->where('s.semesters_status', '=', 1)
                        ->where('b.status', '!=', 0)
                        ->select('*', 'b.status AS bookingStatus', 'b.seats AS bookingSeats')->get();
        $count_bookings = $data_bookings->count();
                    
        $search_bookings = Bookings::searchHome($this->search)
                        ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                        ->simplePaginate($this->perPage);
        $count_search = $search_bookings->count();

        return view('livewire.front.home-table', [
            'data_bookings'  =>  $data_bookings,
            'count_bookings' =>  $count_bookings,
            'search_bookings'  =>  $search_bookings,
            'count_search'   =>  $count_search,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
