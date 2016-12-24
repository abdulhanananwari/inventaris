<?php

namespace Inventori\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Inventori\App\Inventori\InventoriModel;

class MaintenaceReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $inventori;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InventoriModel $inventori)
    {
        $this->inventori = $inventori;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $viewData = [

        	'inventori'=> $this->inventori
        ];

        return $this->view('inventori.emails::inventori.maintenaceReminder')
        		->with('viewData', $viewData);
    }
}