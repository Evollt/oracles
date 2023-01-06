<?php

use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('array_filter_recursive')) {
    /** function array_filter_recursive
     *
     *      Exactly the same as array_filter except this function
     *      filters within multi-dimensional arrays
     *
     * @param array
     * @param string optional callback function name
     * @param bool optional flag removal of empty arrays after filtering
     * @return array merged array
     */
    function array_filter_recursive(array $array, string $callback = null, bool $remove_empty_arrays = false): array
    {
        foreach ($array as $key => & $value) { // mind the reference
            if (is_array($value)) {
                $value = array_filter_recursive($value, $callback, $remove_empty_arrays);
                if ($remove_empty_arrays && !(bool) $value) {
                    unset($array[$key]);
                }
            } else {
                if ($callback !== null && is_callable($callback)) {
                    if (!$callback($value, $key)) {
                        unset($array[$key]);
                    }
                } elseif (null === $value || '' === $value) {
                    unset($array[$key]);
                }
            }
        }
        unset($value); // kill the reference

        return $array;
    }
}

if (!function_exists('get_format')) {
    /**
     * Returns default Y-m-d
     * Types: date, datetime
     *
     * @param array $array
     * @return string
     */
    function get_format($type = 'date'): string
    {
        if('date' === $type){
            return 'nl' === app()->getLocale() ? 'd-m-Y' : 'Y-m-d';
        }
        if('datetime' === $type){
            return 'nl' === app()->getLocale() ? 'd-m-Y H:i:s' : 'Y-m-d H:i:s';
        }

        return 'Y-m-d'; //default
    }
}

if (!function_exists('array_md5')) {
    /**
     * @param array $array
     * @return string
     */
    function array_md5(array $array): string
    {
        // since we're inside a function (which uses a copied array, not
        // a referenced array), you shouldn't need to copy the array
        array_multisort($array);

        return md5(json_encode($array));
    }
}

if (!function_exists('can_visit')) {
    /**
     * @param array $item
     * @return boolean
     */
    function can_visit(array $item): bool
    {
        $necessaryPermissions = get_necessary_permissions($item);
        /** @var User */
        $user = Auth::user();

        if (!count($necessaryPermissions)) {
            return true;
        } elseif (count($necessaryPermissions) == 1) {
            return $user->can($necessaryPermissions[0]);
        }

        return $user->canAny($necessaryPermissions);
    }
}

if (!function_exists('get_necessary_permissions')) {
    /**
     * @param array $item
     * @return array
     */
    function get_necessary_permissions(array $item): array
    {
        $permissions = [];

        if (isset($item['can'])) {
            $permissions = $item['can'];
        }

        if (isset($item['children'])) {
            foreach ($item['children'] as $child) {
                $permissions = array_merge($permissions, get_necessary_permissions($child));
            }
        }

        return array_unique($permissions);
    }
}

if (!function_exists('import_csv')) {
    /**
     * @param $filename
     * @param string $delimiter
     * @return array|null
     */
    function import_csv($filename, string $delimiter = ','): ?array
    {
        if(!file_exists($filename) || !is_readable($filename)){
            return null;
        }

        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false){
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false){
                if(!$header) {
                    $header = $row;
                } else {
                    foreach($row as &$element){
                        if($element === ""){
                            $element = null;
                        }
                    }
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}

if (!function_exists('nft_image_url')) {
    /**
     * @param string $url
     * @return string
     */
    function nft_image_url(string $url = null): string
    {
        if(null === $url){
            return '';
        }
        $url = str_replace('ipfs://', 'https://ipfs.moralis.io:2053/ipfs/', $url);
        return $url;
    }
}
