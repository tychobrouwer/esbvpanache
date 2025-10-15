<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $board = Board::orderBy('year', 'desc')->first();

        return view('contact', compact('board'));
    }
}
