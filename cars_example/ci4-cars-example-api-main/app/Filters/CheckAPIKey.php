<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class CheckAPIKey implements FilterInterface
{

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {

        // Get API Keys
        $api_config = config('API');


        $key = null;

        // Check get parameter first ($_GET)
        $key_by_parameter = $request->getGet('key');
        if (!empty($key_by_parameter)) {
            $key = $key_by_parameter;
        }
        else {

            // Then, check header if nothing is set
            $key_by_header = $request->header('key');
            if (!empty($key_by_header)) {
                $key_by_header = explode(':', $key_by_header);
                $key = $key_by_header[1] ?? null;
            }

        }

        if (array_key_exists($key, $api_config->keys)) {

            // Simple log for request
            $name = $api_config->keys[$key];
            $method = strtoupper($request->getMethod());
            $url = $request->getUri();
            log_message('info', 'API Request from '.$name.' to '.$url.' ('.$method.')');

        }
        else {

            // Send forbidden header
            header('HTTP/1.1 401 Unauthorized', true, 401);
            echo json_encode(['error' => 'Unauthorized']);
            exit();

        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
