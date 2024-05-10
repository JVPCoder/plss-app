<?php

namespace App\Http\Controllers;

use App\Models\Calling;
use App\Models\Category;
use App\Models\Situation;
use Illuminate\Http\Request;

class CallingController extends Controller
{
    public function index(){
        $callings = Calling::all();

        $totalChamados = Calling::whereYear('creation', '=', now()->year)
            ->whereMonth('creation', '=', now()->month)
            ->count();

            $totalResolvidosDentroPrazo = Calling::whereHas('situation', function ($query) {
                $query->where('name', 'Resolvido');
            })
            ->whereYear('solution', '=', now()->year)
            ->whereMonth('solution', '=', now()->month)
            ->whereColumn('solution', '<=', 'limits')
            ->count();

        $percentual = ($totalChamados > 0) ? ($totalResolvidosDentroPrazo / $totalChamados) * 100 : 0;

        return view('callings.index', ['callings' => $callings, 'percentual' => $percentual, 'totalChamados' => $totalChamados]);
    }

    public function create(){
        $categories = Category::all();
        $situations = Situation::all();
        return view('callings.create', compact('categories', 'situations'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'desc' => 'required',
            'situation' => 'exists:situations,id',
            'creation' => 'required|date',
            'limits' => 'required|date',
            'solution' => 'nullable'
        ]);

        $data = $request->all();
        $data['creation'] = now();
        $data['situation'] = Situation::where('name', 'Novo')->first()->id;

        $data['category_id'] = $request->input('category');
        $data['situation_id'] = $request->input('situation');

        $newCalling = Calling::create($data);

        return redirect()->route('calling.index')->with('success', 'Chamado criado com sucesso !');
    }

    public function edit(Calling $calling){
        $situations = Situation::all();
        return view('callings.edit', ['calling' => $calling, 'situations' => $situations]);
    }

    public function update(Calling $calling, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'desc' => 'required',
            'situation' => 'required|exists:situations,id',
            'creation' => 'required|date',
            'limits' => 'required|date',
            'solution' => 'required'
        ]);

        $calling->update([
            'title' => $data['title'],
            'category_id' => $data['category'],
            'desc' => $data['desc'],
            'situation_id' => $data['situation'],
            'creation' => $data['creation'],
            'limits' => $data['limits'],
            'solution' => $data['solution']
        ]);

        return redirect(route('calling.index'))->with('success', 'Chamado Atualizado !');
    }

    public function destroy(Calling $calling){
        $calling->delete();

        return redirect(route('calling.index'))->with('success', 'Chamado Deletado !');
    }
}
