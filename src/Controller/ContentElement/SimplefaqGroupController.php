<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Respinar\ContaoSimplefaqBundle\Schema\FaqSchemaGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(
    category: 'simplefaq',
    // nestedFragments: true
    nestedFragments: [
        'allowedTypes' => [
            SimplefaqItemController::TYPE,
        ],
    ],
)]
class SimplefaqGroupController extends AbstractContentElementController
{
    public const TYPE = 'simplefaq_group';

    public function __construct(
        private readonly FaqSchemaGenerator $schemaGenerator,
    ) {
    }

    protected function getResponse(
        FragmentTemplate $template,
        ContentModel $model,
        Request $request
    ): Response {
        
        $children = ContentModel::findBy(
            [
                'pid=?',
                'ptable=?',
            ],
            [
                $model->id,
                'tl_content',
            ],
            [
                'order' => 'sorting',
            ]
        );

        $template->set(
            'schemaOrgData',
            $this->schemaGenerator->generate($children),
        );

        return $template->getResponse();
    }
}