<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Http\Requests\BoardAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 

class BoardController extends Controller
{
    /**
     * Show the board list.
     */
    public function index(): View
    {
        $board = Board::orderBy('year', 'desc')->first();
        $boards = Board::orderBy('year', 'desc')->skip(1)->get();

        return view('board', compact('board', 'boards'));
    }

    /**
     * Add the board information.
     */
    public function store(Request $request): RedirectResponse
    {
        $formId = $request->input('form_id', 'board-form');
        
        // Create validator with prefixed error bag
        $validator = Validator::make($request->all(), (new BoardAddRequest())->rules());
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors(), $formId);
        }
        
        Board::create($validator->validated());

        return back()->with('status', 'board-created');
    }

    /**
     * Update the board information.
     */
    public function update(Request $request, Board $board): RedirectResponse
    {
        $formId = $request->input('form_id', 'board-form');
        
        // Create validator with prefixed error bag
        $validator = Validator::make($request->all(), (new BoardAddRequest())->rules());
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors(), $formId);
        }
        
        $board->update($validator->validated());
        
        return back()->with('status', 'board-updated');
    }

    /**
     * Delete the board.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'board_id' => 'required|exists:boards,id',
        ]);

        $board = Board::find($request->board_id);
        $board->delete();

        return back()->with('success', 'board-destroyed');
    }
}
