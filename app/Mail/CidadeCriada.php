<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CidadeCriada extends Mailable
{
    use Queueable, SerializesModels;

    public $cidade;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('cidades.cidade_criada')
            ->from('contato@sistema.com.br')
            ->subject("Cidade Criada: {$this->cidade->nome}")
            ->cc('diogoko@gmail.com');
    }
}
