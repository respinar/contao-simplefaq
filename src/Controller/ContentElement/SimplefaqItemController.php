<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'simplefaq')]
class SimplefaqItemController extends AbstractContentElementController
{

    public const TYPE = 'simplefaq_item';

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {        

        $template->set('question', $model->simplefaq_question);
        $template->set('answer', $model->simplefaq_answer);
        
        return $template->getResponse();
    }
}
