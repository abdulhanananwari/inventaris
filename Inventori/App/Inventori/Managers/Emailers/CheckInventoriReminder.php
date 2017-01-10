<?php

namespace Inventori\App\Inventori\Managers\Emailers;

use Inventori\App\InventoriModel;

class CheckInventoriReminder {

    protected $inventori;

    public function __construct($inventori) {

        $this->inventori = $inventori;
    }

    public function email() {
        $pics = json_decode($this->inventori->pic, true);

        try {

            foreach ($pics as $pic) {

                try {

                    \Mail::to('abdulhananx42@gmail.com')//$pic['email']
                            ->send(new \Inventori\App\Mail\CheckInventoriReminder($this->inventori));
                } catch (\Swift_RftComplianceException $e) {
                    
                }
            }
        } catch (\ErrorException $e) {
            
        }
    }

}
