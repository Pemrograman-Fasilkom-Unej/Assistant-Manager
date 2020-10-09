<?php


namespace App\Traits;


use App\Interfaces\LivewireTableData;

trait LivewireTableComponent
{
    public $currentPage = 1;
    public $firstPage = 1;
    public $limit = 10;
    public $total;
    public $totalPage;
    public $search;

    public function next()
    {
        $this->currentPage++;
        $this->getData();
    }

    public function previous()
    {
        $this->currentPage--;
        $this->getData();
    }

    public function changePage($page)
    {
        $this->currentPage = $page;
        $this->getData();
    }
}
