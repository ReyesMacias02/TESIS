<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    // Método para mapear los valores de Recurso
    public function ModeloRecurso($value)
    {
        return [
            'id' => $value->id,
            'nombre' => $value->name,
            'descripcion' => $value->descripcion,
        ];
    }

    // Método para obtener los detalles de un quiz por su ID
    public function detalle_quiz($id)
    {
        $quiz = Quiz::with('pregunta')->find($id);
        return response()->json($quiz);
    }

    // Método para almacenar las respuestas de un quiz
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

    // Método para obtener todos los registros de la tabla Recurso
    public function recurso_ajax()
    {
        $registros = Recurso::all();
        $json_data = [
            "data" => $registros->map(function($value) {
                return $this->ModeloRecurso($value);
            }),
        ];

        // Codificar el JSON y luego reemplazar \/ por /
        $json_encoded = json_encode($json_data);
        $json_encoded = str_replace('\/', '/', $json_encoded);

        return response()->json(json_decode($json_encoded, true));
    }
}
