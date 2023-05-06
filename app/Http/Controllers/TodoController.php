<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Todo::class);

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        auth()->user()->todos()->create($request->only('title', 'description'));

        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'is_completed' => 'sometimes|boolean',
        ]);

        $todo->update($request->only('title', 'description', 'is_completed'));

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()->route('dashboard');
    }
}
