<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\UserHeaderResponses;
use App\Models\AnswerDetails;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function Modelo($value)
    {
        return [
            'id' => $value->id,
            'nombre' => $value->name,
            'descripcion' => $value->descripcion,
            'created_at' => $value->created_at,
            'updated_at' => $value->updated_at,
        ];
    }

    public function detalle_quiz($id)
    {
        $quiz = Quiz::with('pregunta')->find($id);
        return response()->json($quiz);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required',
                'quiz_id' => 'required',
                'responses.*.user_response_id' => 'required',
                'responses.*.question_id' => 'required',
                'responses.*.selected_option' => 'required',
            ], [
                'responses.*.user_response_id.required' => 'El ID del usuario es requerido',
                'responses.selected_option' => 'La opción seleccionada es requerida',
                'responses.question_id' => 'La pregunta es requerida',
            ]);

            // Guardar la cabecera de la respuesta del usuario
            $userResponse = UserHeaderResponses::create([
                'user_id' => $request->user_id,
                'quiz_id' => $request->quiz_id,
            ]);

            // Guardar los detalles de las respuestas
            foreach ($request->responses as $response) {
                AnswerDetails::create([
                    'user_response_id' => $userResponse->id,
                    'question_id' => $response['question_id'],
                    'selected_option' => $response['selected_option'],
                ]);
            }

            return response()->json(['message' => 'Respuestas guardadas correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 403);
        }
    }

    public function quiz_ajax()
    {
        $registros = Quiz::all();
        $json_data = [
            "data" => $registros->map(function($value) {
                return $this->Modelo($value);
            }),
        ];

        // Codificar el JSON y luego reemplazar \/ por /
        $json_encoded = json_encode($json_data);
        $json_encoded = str_replace('\/', '/', $json_encoded);

        return response()->json(json_decode($json_encoded, true));
    }
}
