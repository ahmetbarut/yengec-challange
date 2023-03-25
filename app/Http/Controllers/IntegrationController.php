<?php

namespace App\Http\Controllers;

use App\Contracts\IntegrationContract;
use App\Http\Requests\StoreIntegrationRequest;
use App\Http\Requests\UpdateIntegrationRequest;
use App\Http\Resources\IntegrationResource;
use App\Models\Integration;

class IntegrationController extends Controller
{
    public function __construct(protected IntegrationContract $integrationRepository)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIntegrationRequest $request): \Illuminate\Http\JsonResponse
    {
        $mergeData = array_merge($request->validated(), ['user_id' => auth()->id()]);

        return response()->json([
            new IntegrationResource(
                $this->integrationRepository->create(
                    $mergeData
                )
            )
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIntegrationRequest $request, Integration $integration): \Illuminate\Http\JsonResponse
    {
        if ($integration->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not authorized to update this integration',
            ], 403);
        }

        $integration->update($request->validated());

        return response()->json([
            'message' => 'Integration updated successfully',
        ], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Integration $integration): \Illuminate\Http\JsonResponse
    {
        if ($integration->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not authorized to delete this integration',
            ], 403);
        }

        $integration->delete();

        return response()->json([
            'message' => 'Integration deleted successfully',
        ], 204);
    }
}
