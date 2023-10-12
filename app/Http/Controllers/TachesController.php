<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTachesRequest;
use App\Http\Requests\EditTachesRequest;
use App\Models\Taches;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Exception;
use Illuminate\Console\View\Components\Task;

class TachesController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'statut_message' => 'voici la liste des taches',
                'data' => Taches::all()
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function store(CreateTachesRequest $request)
    {

        try {

            $task = new Taches();
            $task->titre = $request->titre;
            $task->description = $request->description;
            $task->date_limite = $request->date_limite;
            $task->status = $request->status;
            $task->save();

            return response()->json([
                'statut_message' => 'la tache a ete ajouter avec succes!',
                'data' => $task
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function update(EditTachesRequest $request, $id)
    {
        $task = Taches::find($id);
        $task->titre = $request->titre;
        $task->description = $request->description;
        $task->date_limite = $request->date_limite;
        $task->status = $request->status;
        $task->update();
    }

    public function delete(Taches $task)
    {
        try {
            $task->delete();

            return response()->json([
                'statut_message' => 'la tache a ete supprimer avec succes!',
                'data' => $task
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}