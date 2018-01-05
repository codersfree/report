<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 17/09/2017
 * Time: 21:55
 */

namespace Greenter\Report;

use Greenter\Model\DocumentInterface;

/**
 * Class HtmlReport
 * @package Greenter\Report
 */
class HtmlReport implements ReportInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $template;

    /**
     * HtmlReport constructor.
     * @param string $templatesDir
     * @param array $optionTwig
     */
    public function __construct($templatesDir = '', $optionTwig = [])
    {
        if (empty($templatesDir)) {
            $templatesDir = __DIR__ . '/Templates';
        }
        $loader = new \Twig_Loader_Filesystem($templatesDir);
        $this->twig = new \Twig_Environment($loader, $optionTwig);
    }

    /**
     * Build html report.
     *
     * @param DocumentInterface $document
     * @param array $parameters
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(DocumentInterface $document, $parameters = [])
    {
        $html = $this->twig->render($this->template, [
            'doc' => $document,
            'params' => $parameters
        ]);

        return $html;
    }

    /**
     * Set filename templte.
     *
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}