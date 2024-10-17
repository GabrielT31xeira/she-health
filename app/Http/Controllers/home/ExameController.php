<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\home\PedirExameRequest;
use App\Models\Exame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExameController extends Controller
{
    public function create(PedirExameRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::guard('api')->user();
            $exam = Exame::create([
                'cartao_sus' => $request->cartao_sus,
                'endereco' => $request->endereco,
                'nome_exame' => $request->nome_exame,
                'nome_mae' => $request->nome_mae,
                'cid10_diagnostico' => $request->cid10_diagnostico,
                'motivo_consulta' => $request->motivo_consulta,
                'status' => "Em espera",
                'user_id' => $user->id,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Solicitação de exame criado com sucesso!',
                'data' => $exam
            ]);

        } catch(\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function meusExames()
    {
        try {
            DB::beginTransaction();
            $user = Auth::guard('api')->user();
            $exam = Exame::where('user_id', $user->id)->get();
            DB::commit();
            return response()->json([
                'message' => 'Aqui estão seus exames!',
                'data' => $exam
            ]);

        } catch(\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Exame::where('user_id',$id)->first()->delete();
            DB::commit();
            return response()->json([
                'message' => 'Exame cancelado com sucesso!',
            ]);

        } catch(\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }
}
