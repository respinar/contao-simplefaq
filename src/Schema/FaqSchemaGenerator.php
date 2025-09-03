<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Schema;

use Contao\Model\Collection;

final class FaqSchemaGenerator
{
    public function generate(?Collection $items): ?array
    {
        if (null === $items) {
            return null;
        }

        $questions = [];

        while ($items->next()) {
            $item = $items->current();

            if ('simplefaq_item' !== $item->type) {
                continue;
            }

            $questions[] = [
                '@type' => 'Question',
                'name' => $item->simplefaq_question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item->simplefaq_answer,
                ],
            ];
        }

        if ([] === $questions) {
            return null;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $questions,
        ];
    }
}