<?php

require 'vendor/autoload.php';
require_once('vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

use Elsheref\Pdf\PDFReport;

$application = new PDFReport('P', true, true);
 $application->setReportHeaderTitle("جـــامـعــــــة المنـــوفيــــة#كلية الحاسبات والمعلومات#قســــم علـــــوم الحاســب");
 $application->setReportTitle("كشف بيانات قسم علوم الحاسب سكشن 2");
 $application->setReportHeaderLogo('report-header-logo.png');
 $application->showBorder(true, ['width'=>0.8,'color'=> array(0,0,0)]);
 $application->print("مرحبا حاتم");
