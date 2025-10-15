<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Http\Requests\BoardAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Http\FormRequest;
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
    public function create(BoardAddRequest $request): RedirectResponse
    {
        Board::create($request->validated());

        return redirect()->back()->with('status', value: 'board-created');
    }

    /**
     * Update the board information.
     */
    public function update(FormRequest $request): RedirectResponse
    {       
        $validated = $request->validateWithBag('board', [
            'year' => [ 'required', 'integer', Rule::unique(Board::class)->ignore($request->id) ],
            'chairperson' => [ 'required', 'string', 'max:255' ],
            'vice_chairperson' => [ 'required', 'string', 'max:255' ],
            'secretary' => [ 'required', 'string', 'max:255' ],
            'treasurer' => [ 'required', 'string', 'max:255' ],
            'slogan' => [ 'required', 'string', 'max:255' ],
            'message_en' => [ 'nullable', 'string' ],
            'message_nl' => [ 'nullable', 'string' ],
        ]);

        Board::find($request->id)->update($validated);

        return redirect()->back()->with('status', value: 'board-updated');
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

        return redirect()->back()->with('success', 'board-destroyed');
    }
}
