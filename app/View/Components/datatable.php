<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datatable extends Component
{
   public $id;

   public $th;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $th=[])
    {
        //
       $this->id = $id;
      $this->th = $th;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable');
    }
}
