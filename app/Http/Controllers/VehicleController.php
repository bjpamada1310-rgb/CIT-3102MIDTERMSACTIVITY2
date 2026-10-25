<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    /** Allowed query-string filters. */
    private const FILTERS = ['make', 'model', 'year'];

    public function index(Request $request): JsonResponse
    {
        $query = Vehicle::query();

        foreach (self::FILTERS as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->query($field));
            }
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $vehicle = Vehicle::create($this->validated($request));

        return response()->json($vehicle, 201);
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        return response()->json($vehicle, 200);
    }

    public function update(Request $request, Vehicle $vehicle): JsonResponse
    {
        $vehicle->update($this->validated($request));

        return response()->json($vehicle, 200);
    }

    public function destroy(Vehicle $vehicle): Response
    {
        $vehicle->delete();

        return response()->noContent(); // 204
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'make'  => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year'  => ['required', 'integer', 'min:1886', 'max:' . (date('Y') + 1)],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        ]);
    }
}
