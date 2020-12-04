<?php

namespace App\AdventOfCode\Year2020\Day4;

use App\Collection;
use App\InputInterface;
use App\SolutionInterface;

class Solution implements SolutionInterface
{
    public function partOne(InputInterface $input): string
    {
        $validationRules = Collection::fromArray([
            new ContainsRequiredFields(),
        ]);

        $passports = $this->createPassportsFromInput($input, $validationRules);

        return $passports->reduce(function ($validPassports, $passport) {
            return $validPassports + ($passport->isValid() ? 1 : 0);
        }, 0);
    }

    public function partTwo(InputInterface $input): string
    {
        $validationRules = Collection::fromArray([
            new BirthYearValidationRule(),
            new ExpirationYearValidationRule(),
            new HeightValidationRule(),
            new IssueYearValidationRule(),
            new HairColorValidationRule(),
            new EyeColorValidationRule(),
            new PassportIDValidationRule(),
        ]);

        $passports = $this->createPassportsFromInput($input, $validationRules);

        return $passports->reduce(function ($validPassports, $passport) {
            return $validPassports + ($passport->isValid() ? 1 : 0);
        }, 0);
    }

    private function createPassportsFromInput(InputInterface $input, Collection $validationRules): Collection
    {
        $fields = Collection::fromArray($input->split("\n\n"));

        return $fields->map(function ($rawPassportFields) use ($validationRules) {
            $lines = explode("\n", $rawPassportFields);

            $formattedPassportFields = new Collection();

            foreach ($lines as $line) {
                $fields = explode(' ', $line);

                foreach ($fields as $field) {
                    $keyValuePair = explode(':', $field);
                    $formattedPassportFields->set($keyValuePair[0], $keyValuePair[1]);
                }
            }

            return new Passport($formattedPassportFields, $validationRules);
        });
    }
}
