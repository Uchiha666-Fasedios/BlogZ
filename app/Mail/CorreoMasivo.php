<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; //se utiliza para encolar
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;


class CorreoMasivo extends Mailable implements ShouldQueue // con esto encolo los emails
{

    use Queueable, SerializesModels;

    public $usuario;
    public $asunto;
    public $contenido;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usuario , $asunto , $contenido)
    {
        $this->usuario = $usuario;
        $this->asunto = $asunto;
        $this->contenido = $contenido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     //ESTA ES LA VISTA Q RESIVE EL USURIO EN EL CORREO
    public function build()
    {
       // return $this->view('view.name');
        //return $this->view('emails.correo-masivo')->subject($this->asunto);//subject esto es el asunto siempre a un correo se le envia el asunto esa funcion es la q se refiere con el asunto
        return $this->markdown('emails.correo-masivo')->subject($this->asunto);//markdown UTILIZO LA VISTA CON LENGUAJE markdown
    }
}
