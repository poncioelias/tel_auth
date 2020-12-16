<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function doubt()
    {
        $title = '<strong> <i class="fas fa-link"></i> Como vincular um usuário </strong>';

        $body = '
        <p>Usuários admistradores do sistema, podem adicionar, editar, inativar e criar novos usuários em seus sistemas. 
        <p>Basta ir no menu do usuário, na opção usuários, estando logado no sistema que precisar. 
        <p>Lá terá todas as ferramentas para o gerenciamento dos mesmos.
        <p>Verifique com seu superior!';

        $footer = ' <button type="button" class="btn btn-secondary" data-dismiss="modal">OK!</button>';

        return view('template_auth.includes.components.modal', [
            'title' => $title ,
            'body' =>  $body,
            'footer' => $footer,
        ]);
    }
}
