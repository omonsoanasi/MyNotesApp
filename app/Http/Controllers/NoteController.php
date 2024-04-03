<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query()
            ->where('user_id', auth()->id())
            ->orderBy('created_at','desc')
            ->paginate();

        return view('note.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'note' => ['required', 'string']
        ]);
        $validatedData['user_id'] = auth()->id();
        $note = Note::create($validatedData);

        return to_route('note.show', $note)->with('message', 'the note was successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if($note->user_id !== auth()->id()) {
            abort(403);
        }
        return view('note.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if($note->user_id !== auth()->id()) {
            abort(403);
        }
        return view('note.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if($note->user_id !== auth()->id()) {
            abort(403);
        }
        $validatedData = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note->update($validatedData);

        return to_route('note.show', $note)->with('message', 'the note was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if($note->user_id !== auth()->id()) {
            abort(403);
        }
        $note->delete();

        return to_route('note.index')->with('message', 'the note was deleted');
    }
}
