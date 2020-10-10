<?php

namespace App\Http\Livewire;

use App\Repositories\Shortlink;
use Livewire\Component;

class ShortlinkCreateModal extends Component
{
    public $longUrl;
    public $shortUrl;

    public function submit()
    {
        $this->validate([
            'longUrl' => 'required'
        ]);

        if(filter_var($this->longUrl, FILTER_VALIDATE_URL)){
            Shortlink::storeLink($this->longUrl, ($this->shortUrl !== ''), $this->shortUrl);
            $this->emit('alert', [
                'type' => 'success',
                'message' => 'Link has been shorted'
            ]);
            $this->emit('refreshLinks');
        }
    }

    public function render()
    {
        return view('livewire.shortlink-create-modal');
    }
}
