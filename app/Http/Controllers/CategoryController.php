<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\MessageBag;

class CategoryController extends Controller
{
    public function new(Request $request) {
        $validator = $request->validate([
            "name" => "required|min:3",
        ]);

        Categories::create([
            'name' => $request->name,
            'order_number' => Categories::all()->count() + 1,
            'status' => 'Ativado'
        ]);

        return redirect(route("carte"));
    }

    public function edit(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|min:3'
        ]);

        $category = Categories::find($request->id);

        $data = $request->only([
            'name'
        ]);

        $category->update($data);
        $category->save();

        return redirect(route("carte"));
    }

    public function organize(Request $request) {
        $reorderedIndexes = $request->input('reorderedIndexes');

        foreach ($reorderedIndexes as $index => $categoryId) {
            // Incrementamos o índice em 1 para começar com 1 ao invés de 0
            $orderNumber = (string)$index + 1;

            // Atualizamos o registro no banco de dados
            $updated = Categories::where('id', $categoryId)->update(['order_number' => $orderNumber]);
        }
    }
}
