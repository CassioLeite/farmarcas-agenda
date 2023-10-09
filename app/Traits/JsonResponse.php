<?php

namespace App\Traits;

use Throwable;

trait JsonResponse
{
    public function success(mixed $data, $message = null, $code = null)
    {
        $code = $code ?? 200;

        return response()
            ->json([
                'success' => true,
                'message' => $message ?? 'Requisição, aceita com sucesso.',
                'data' => $data,
            ], $code);
    }

    public function error(Throwable $th)
    {
        return response()
            ->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
    }
}