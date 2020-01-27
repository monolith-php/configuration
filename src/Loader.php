<?php namespace Monolith\Configuration;

use Monolith\Collections\Collection;
use Monolith\Collections\Dictionary;

final class Loader
{
    public static function fromFile(string $filePath): Dictionary
    {
        $envPath = realpath($filePath);

        if ( ! $envPath) {
            throw new CanNotFindEnvFileAtPath($filePath);
        }

        $fileContents = Collection::of(
            file($envPath)
        );

        $values = $fileContents
            # trim whitespace
            ->map(
                function ($row) {
                    return trim($row);
                }
            # remove empty rows and comment rows
            )->filter(
                function ($row) {
                    if (strlen($row) == 0) return false;
                    if ($row[0] == '#') return false;
                    return true;
                }
            # create a dictionary of key value pairs
            )->toDictionary()
            ->map(
                function ($key, $value) use ($envPath) {
                    if ( ! stristr($value, '=')) {
                        throw new BadConfigurationDeclaration("Bad declaration in {$envPath} on row: {$value}");
                    }
                    [$key, $value] = explode('=', $value, 2);
                    if (empty($key)) {
                        throw new BadConfigurationDeclaration("Bad declaration in {$envPath} on row: {$value}");
                    }
                    return [$key => $value];
                }
            # format values to remove outermost quotes
            )->map(
                function ($key, $value) {
                    if (
                        strlen($value) > 1 &&
                        $value[0] == '"' &&
                        $value[strlen($value) - 1] == '"'
                    ) {
                        $value = substr($value, 1);
                        $value = substr($value, 0, -1);
                    }

                    return [$key => $value];
                }
            );

        return $values;
    }
}