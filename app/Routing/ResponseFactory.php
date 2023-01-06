<?php

namespace App\Routing;

use Illuminate\Routing\Route;
use Illuminate\Http\JsonResponse;

/**
 * Add default data to responses to prevent duplicate code and bugs due to missing data.
 */
class ResponseFactory extends \Illuminate\Routing\ResponseFactory
{
    /**
     * Create a new JSON response instance.
     *
     * @param  mixed  $data
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     * @return JsonResponse
     */
    public function json($data = [], $status = 200, array $headers = [], $options = 0)
    {
        // Merge default array with data from controllers. This adds the possibility to overwrite default response
        // $data = array_merge($default, $data);

        return parent::json($data, $status, $headers, $options);
    }
}
