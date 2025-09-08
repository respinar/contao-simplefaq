<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Schema;

use Contao\ContentModel;
use Contao\Model\Collection;
use Contao\StringUtil;

final class FaqSchemaGenerator
{
    public function generate(?Collection $items, ContentModel $model): ?array
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
                    'text' => strip_tags(StringUtil::stripInsertTags($item->simplefaq_answer)),
                ],
            ];
        }

        if ([] === $questions) {
            return null;
        }

        return [
            '@id' => sprintf('#/schema/faq/%d', $model->id),
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $questions,
        ];
    }
}