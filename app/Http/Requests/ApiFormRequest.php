<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 9:30 PM
 */

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class ApiFormRequest extends FormRequest
{


    /**
     * @param Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => false,
            'message' => 'Please fix following errors',
            'errors' => $errors,
            'body' => null
        ],Response::HTTP_OK);
    }
}