<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class GenericCrudController extends Controller
{
    protected $model;
    
    // Define the allowed models here
    protected $allowedModels = [
        'motors' => \App\Models\Motor::class,
    ];

    public function __construct(Request $request)
    {
        // Extract the model name from the route
        $modelKey = $request->route('model');

        // Check if the model is in the allowed list
        if (!isset($this->allowedModels[$modelKey])) {
            abort(400, 'Invalid model specified.');
        }

        $modelClass = $this->allowedModels[$modelKey];

        // Ensure the model exists and is a subclass of Model
        if (!is_subclass_of($modelClass, Model::class)) {
            abort(400, 'Invalid model specified.');
        }

        $this->model = new $modelClass;
    }

    public function index()
    {
        return response()->json($this->model->all());
    }

    public function show($motors, $id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }
        return response()->json($record);
    }

    public function store(Request $request)
    {
        $rules = $this->model->getFillable();

        $validator = Validator::make($request->all(), array_fill_keys($rules, 'required'));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record = $this->model->create($request->only($rules));

        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $record = $this->model->find($id);

        if (!$record) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $rules = $this->model->getFillable();
  
        $validator = Validator::make($request->all(), array_fill_keys($rules, 'sometimes|required'));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record->update($request->only($rules));

        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $record->delete();
        return response()->json(['message' => 'Record deleted successfully.']);
    }

    protected function getValidationRules()
    {
        return [];
    }
}
