<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Http\Requests\CommitteeAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommitteeController extends Controller
{
    /**
     * Show the committee list.
     */
    public function index(): View
    {
        $general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', true)->get();
        $non_general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', false)->get();

        return view('committees', compact('general_committees', 'non_general_committees'));
    }

    /**
     * Add the committee information.
     */
    public function create(CommitteeAddRequest $request): RedirectResponse
    {
        Committee::create($request->validated());

        return back()->with('status', 'committee-created');
    }

    /**
     * Update the committee information.
     */
    public function update(CommitteeAddRequest $request): RedirectResponse
    {
        Committee::find($request->id)->update($request->validated());

        return back()->with('status', 'committee-updated');
    }

    /**
     * Delete the committee.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'committee_id' => 'required|exists:committees,id',
        ]);

        $committee = Committee::find($request->committee_id);
        $committee->delete();

        return back()->with('success', 'committee-destroyed');
    }
}
