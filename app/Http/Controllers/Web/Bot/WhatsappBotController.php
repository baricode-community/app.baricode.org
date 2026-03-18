<?php

namespace App\Http\Controllers\Web\Bot;

use App\Http\Controllers\Controller;

class WhatsappBotController extends Controller
{
    public function index()
    {
        return view('pages.bot.whatsapp.index');
    }
}
