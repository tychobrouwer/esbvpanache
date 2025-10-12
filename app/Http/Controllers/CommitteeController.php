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
     * Add the committee information.
     */
    public function add(CommitteeAddRequest $request): RedirectResponse
    {
        \Log::info('Adding committee', $request->all());


        Committee::create($request->validated());

        return back()->with('status', 'committee-added');

    }

    /**
     * Delete the committee.
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'committee_id' => 'required|exists:committees,id',
        ]);

        $committee = Committee::find($request->committee_id);
        $committee->delete();

        return redirect()->back()->with('success', 'committee-deleted');
    }

    /**
     * Show the committee list.
     */
    public function index(): View
    {
        $general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', true)->get();
        $non_general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', false)->get();

        return view('committees', compact('general_committees', 'non_general_committees'));
    }
}
