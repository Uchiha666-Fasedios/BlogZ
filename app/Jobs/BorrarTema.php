<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Theme;
use Illuminate\Support\Facades\Storage;


class BorrarTema implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     protected $tema;

    public function __construct(Theme $tema)
    {
        $this->tema=$tema;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $articulos=$this->tema->articles()->with(['images'])->get();
        foreach ($articulos as $articulo){
            foreach ($articulo->images as $image){
                //Storage::disk('public')->delete('/imagenesArticulos/'.$image->nombre);
                Storage::disk('imagenesArticulos')->delete($image->nombre);
                //Storage::disk('images')->delete($image->image_path);
            }
    }
    $this->tema->Delete();
}

}
