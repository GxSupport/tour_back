<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

function throwErrors($errors, $code = 400)
{
    if (DB::transactionLevel()) DB::rollBack();
    throw new HttpResponseException(response_errors($errors, $code));
}


/**
 * @param $message
 * @param int $code
 * @throws HttpResponseException
 */
function throwError($message, int $code = 400)
{
    throwErrors(['data' => [
        "error"=>true,
        "messages"=>['message'=>$message]
    ]], $code);
}


function failedValidation($validator)
{
    $errors = [];
    foreach ($validator->errors()->toArray() as $key => $value) {
        $errors[] = ['message' => $value['0'] . " ($key)"];
    }
    throwErrors(['data' =>[
        "error"=>true,
        "messages"=>$errors
    ]]);
}



/* RESPONSE START */
/**
 * Response JSON success
 */
function success($data = false): JsonResponse
{
    if ($data === false) $data = ['success' => 1];
    return response()->json($data);
}


/**
 * Response JSON errors
 */
function response_errors($errors, int $code = 400): JsonResponse
{
    return response()->json($errors, $code);
}


/**
 * Response JSON error
 */
function error($message, int $code = 400): JsonResponse
{
    return response_errors(['errors' => [['message' => $message]]], $code);
}
/* RESPONSE END */
