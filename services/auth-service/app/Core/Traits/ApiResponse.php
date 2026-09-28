<?php

namespace App\Core\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    /**
     * Réponse de succès standard.
     */
    protected function successResponse(
        mixed $data = null,
        string $message = 'Opération réussie',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ], $status);
    }

    /**
     * Réponse d'erreur standard.
     */
    protected function errorResponse(
        string $code,
        string $message,
        int $status = 400,
        array $fields = []
    ): JsonResponse {
        $error = [
            'code'    => $code,
            'message' => $message,
        ];

        if (! empty($fields)) {
            $error['fields'] = $fields;
        }

        return response()->json([
            'success' => false,
            'error'   => $error,
        ], $status);
    }

    /**
     * Réponse paginée.
     */
    protected function paginatedResponse(
        LengthAwarePaginator $paginator,
        string $message = 'Liste récupérée'
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'data'    => $paginator->items(),
            'meta'    => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
            ],
            'message' => $message,
        ]);
    }

    /**
     * Ressource créée — 201.
     */
    protected function createdResponse(
        mixed $data = null,
        string $message = 'Ressource créée'
    ): JsonResponse {
        return $this->successResponse($data, $message, 201);
    }

    /**
     * Suppression réussie — 204.
     */
    protected function noContentResponse(): JsonResponse
    {
        return response()->json(null, 204);
    }
}