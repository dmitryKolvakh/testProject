<?php
namespace App\Service;

class TagGeneratorService
{
    /**
     * @param string $name
     * @param int $length
     * @param bool $removeSimilarCharacters Remove I1l0Oo characters
     * @return string The generated tag
     */
    public static function generator(string $name = '', int $length = 12, bool $removeSimilarCharacters = true): string
    {
        $token = "";
        try {
            $bytesWithMargin = random_bytes($length*3);

            $base64 = base64_encode($bytesWithMargin);
            $purified = preg_replace("/[+=\/.]/", "", $base64);

            if ($removeSimilarCharacters){
                $purified = preg_replace("/[I1l0Oo]/", "", $purified);
            }

            $token = substr($purified, 0, $length);

        } catch (\Exception $e){
            echo $e->getMessage();
        }

        return "$name-$token";
    }
}
