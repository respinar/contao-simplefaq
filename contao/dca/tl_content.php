<?php

declare(strict_types=1);

use Respinar\ContaoSimplefaqBundle\Controller\ContentElement\SimplefaqGroupController;
use Respinar\ContaoSimplefaqBundle\Controller\ContentElement\SimplefaqItemController;

/*
 * Modify the DCA for FAQ list
 */
// FAQ Wrapper (Start)
$GLOBALS['TL_DCA']['tl_content']['palettes'][SimplefaqGroupController::TYPE] = '
    {type_legend},type,headline;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},cssID;
    {invisible_legend:hide},invisible,start,stop
';

// FAQ Item
$GLOBALS['TL_DCA']['tl_content']['palettes'][SimplefaqItemController::TYPE] = '
    {type_legend},type;
    {simplefaq_legend},simplefaq_question,simplefaq_answer;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},cssID;
    {invisible_legend:hide},invisible,start,stop
';

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['simplefaq_question'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'tl_class' => 'w100'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['simplefaq_answer'] = [
    'inputType' => 'textarea',
    'eval' => ['mandatory' => true, 'rte' => 'tinyMCE', 'helpwizard' => true],
    'sql' => 'text NULL',
];
