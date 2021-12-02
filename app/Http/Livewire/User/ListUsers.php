<?php

namespace App\Http\Livewire\User;

use App\Http\Traits\WithSorting;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{

    use WithPagination;
    use WithSorting;

    protected $listeners = [
        'renderListUsers' => 'render',
        'resetListusers' => 'resetList'
    ];

    public function render()
    {
        $data = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
            
        return view('livewire.user.list-users', compact('data'));
    }
}
