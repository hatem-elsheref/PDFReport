<?php

namespace Elsheref\Pdf;

use TCPDF;

class PDFReport extends TCPDF
{
    private $orientation = 'P';
    private $withBorder = fasle;
    private $hasLogo;
    private $logoProperties;
    private $logo;
    private $hasHeaderTitle;
    private $headerTitle;
    private $reportTitle;
    private $languageOptions = ['a_meta_charset' => 'UTF-8', 'a_meta_dir' => 'rtl', 'a_meta_language' => 'fa', 'w_page' => 'page'];
    private $borderStyle = ['width'=>0.8,'color'=> array(0,0,0)];

    const REPORT_HEADER_TITLE_SEPARATOR = '#';
    
    public function __construct($orientation = 'P', $hasLogo = false, $hasHeaderTitle = true)
    {
        $this->setOrientation($orientation);
        $this->reportHeaderHasLogo($hasLogo);
        $this->reportHeaderHasTitle($hasHeaderTitle);
        $this->setReportLanguageOptions();
        Parent::__construct($this->orientation);
    }

 
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
    }

    public function reportHeaderHasLogo($hasLogo)
    {
        $this->hasLogo = $hasLogo;
    }

    public function reportHeaderHasTitle($hasTitle)
    {
        $this->hasHeaderTitle = $hasTitle;
    }


    public function setReportHeaderLogo($logo, $logoProperties = ['x' => 8, 'y' => 2, 'size' => 35])
    {
        $this->logo = $logo;
        $this->logoProperties = $logoProperties;
    }

    public function setReportHeaderTitle($title)
    {
        $this->headerTitle = $title;
    }

    public function setReportTitle($title)
    {
        $this->reportTitle = $title;
    }

    public function setReportLanguageOptions($options = [])
    {
        if (!empty($options)) {
            $this->languageOptions = $options;
        }

        $this->setLanguageArray($this->languageOptions);
    }


    public function Header()
    {
        if ($this->hasLogo) {
            $logoPosition = 'R';
            if ($this->l['a_meta_dir'] == 'rtl') {
                $logoPosition = 'L';
            }

            $this->Image(K_PATH_IMAGES . $this->logo, $this->logoProperties['x'], $this->logoProperties['y'], $this->logoProperties['size'], '', 'PNG', '', $logoPosition, false, 0, '', false, false, 0, false, false, false);
        }

        if ($this->hasHeaderTitle) {
            $html = explode(self::REPORT_HEADER_TITLE_SEPARATOR, $this->headerTitle);
            $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', implode('<br>', $html), $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        }
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Page number

        $pageTitle = 'page ';

        if ($this->l['a_meta_dir'] == 'rtl') {
            $pageTitle = 'صفحة ';
        }

        // $this->Cell(0, 10, $pageTitle.$this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetY(-15);
        // Set font
        $this->SetFont('aealarabiya', 'I', 8);
        // Page number
        $this->writeHTMLCell(0, 0, $this->getPageWidth()/2  - 20, -15, $pageTitle.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);


        if ($this->withBorder) {
            $this->SetLineStyle($this->borderStyle);
            $this->Line(3, 3, $this->getPageWidth()-3, 3);
            $this->Line($this->getPageWidth()-3, 3, $this->getPageWidth()-3, $this->getPageHeight()-3);
            $this->Line(3, $this->getPageHeight()-3, $this->getPageWidth()-3, $this->getPageHeight()-3);
            $this->Line(3, 3, 3, $this->getPageHeight()-3);
        }
    }



    public function showBorder($showBorder = false, $borderStyle = ['width'=>0.8,'color'=> array(0,0,0)])
    {
        $this->withBorder = $showBorder;
        $this->borderStyle = $borderStyle;
    }

    public function print($content)
    {
        $this->setRTL(true);
        $this->setHeaderFont(array('XZar', '', 15));
        $this->setFooterFont(array('XZar', 15));
        // set margins
        $this->setMargins(5, PDF_MARGIN_TOP, 5, true);
        $this->setHeaderMargin(PDF_MARGIN_HEADER);
        $this->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        // $this->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        // $this->setImageScale(PDF_IMAGE_SCALE_RATIO);



        // add a page
        $this->AddPage();

        $this->setFont('XZar', '', 9, true);
        $this->WriteHTML('<br><h2 style="text-align:center;">'. $this->reportTitle .'</h2><hr>', true, 0, true, 0);

        $this->WriteHTML($content, true, 0, true, 0);

        $this->Output('example_.pdf', 'I');
    }
}
