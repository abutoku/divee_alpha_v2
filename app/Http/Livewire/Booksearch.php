<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Booksearch extends Component
{

    public $searchWord;

    // public function mount()
    // {
    //     $books = Book::where('user_id', Auth::user()->id )
    //     ->orderBy('fish_name', 'asc')->get();
    //     return view('livewire.booksearch',
    //         ['books' => $books]);
    // }


    public function render()
    {
        $searchWord = '%'.$this->searchWord.'%';
        $books = Book::where('user_id', Auth::user()->id )
        ->where('fish_name','LIKE',$searchWord)
        ->orderBy('fish_name', 'asc')->get();
        return view('livewire.booksearch',
            ['books' => $books]);
    }

}
