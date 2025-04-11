<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

trait TryCatchTraits
{
    public function tryThrow(callable $callback)
    {
        try {
            DB::beginTransaction();
            $result = $callback();
            DB::commit();
            return $result;
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function catchAPI(callable $callback)
    {
        $mess = null;
        $code = null;

        function getErrorCode($e)
        {
            $statusCode = $e->getCode() ?: 500;
            $statusCode = is_int($statusCode) && $statusCode >= 100 && $statusCode < 600
                ? $statusCode
                : 500;
            return $statusCode;
        }

        try {
            return $callback();
        } catch (TokenExpiredException $e) {
            $mess = "Refresh token expired";
            $code = getErrorCode($e);
        } catch (TokenInvalidException $e) {
            $mess = "Invalid refresh token";
            $code = getErrorCode($e);
        } catch (ValidationException $e) {
            $mess = implode(", ",  Arr::flatten($e->errors()));
            $code = $e->status;
        } catch (Exception $e) {
            $mess = $e->getMessage();
            $code = getErrorCode($e);
        }

        return response()->json(["err" => $mess], $code);
    }
}
