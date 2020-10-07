<?php

namespace App\Http\Livewire;

use App\Repositories\Shortlink;
use Livewire\Component;

class ShortlinkTable extends Component
{
    public $links;
    public $firstPage = 1;
    public $totalItems;
    public $itemsPerPage;
    public $pageNumber;
    public $totalPages;
    public $search;

    protected $listeners = ['refreshLinks' => 'getLinks'];

    public function mount()
    {
        $this->pageNumber = 1;
        $this->itemsPerPage = 10;
        $this->getLinks();
    }

    public function getLinks()
    {
        $response = Shortlink::getLinks([
            'perPage' => $this->itemsPerPage,
            'pageNumber' => $this->pageNumber,
            'search' => $this->search
        ]);
        $this->links = $response['items'];
        $this->totalItems = $response['totalItems'];
        $this->totalPages = $response['totalPages'];
    }

    public function previous()
    {
        $this->pageNumber--;
        $this->getLinks();
    }

    public function next()
    {
        $this->pageNumber++;
        $this->getLinks();
    }

    public function changePage($page)
    {
        $this->pageNumber = $page;
        $this->getLinks();
    }

    public function deleteLink($id)
    {
        Shortlink::deleteLink($id);
        $this->search = '';
        $this->getLinks();
    }

    public function render()
    {
        return view('livewire.shortlink-table');
    }
}
