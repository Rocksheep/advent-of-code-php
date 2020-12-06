<?php

namespace App\AdventOfCode\Year2020\Day6;

use App\Collection;

class TravelGroup
{
    /**
     * @var Collection
     */
    private Collection $filledForms;

    public function __construct(Collection $filledForms)
    {
        $this->filledForms = $filledForms;
    }

    public function questionsAnsweredWithYes(): int
    {
        $allQuestionAnswers = $this->filledForms->reduce(function ($mergedQuestions, $form) {
            foreach ($form->questionsAnsweredWithYes() as $question) {
                $mergedQuestions->add($question);
            }

            return $mergedQuestions;
        }, new Collection());

        return $allQuestionAnswers->unique()->count();
    }

    public function questionsAnsweredByEveryoneWithYes(): int
    {
        if ($this->filledForms->count() === 0) {
            return 0;
        }

        $collection = $this->filledForms->get(0)->questionsAnsweredWithYes();

        if ($this->filledForms->count() === 1) {
            return $collection->count();
        }

        for ($i = 1; $i < $this->filledForms->count(); $i++) {
            $collection = $collection->intersect($this->filledForms->get($i)->questionsAnsweredWithYes());
        }

        return $collection->count();
    }
}
