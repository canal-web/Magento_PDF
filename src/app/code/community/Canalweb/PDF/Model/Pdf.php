<?php

use mikehaertl\wkhtmlto\Pdf;

class Canalweb_PDF_Model_Pdf
{
    /**
     * Define the wkhtmltopdf binary location
     */
    protected $binary = 'vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386';

    /**
     * Generate a pdf from an url and return  it
     * @param string $url
     * @param string $name
     */
    public function generatePdf($url,  $name = "pdf-")
    {

        $pdf = new Pdf($url);
        $pdf->binary = $this->binary;

        $name .= time() . '.pdf';
        if(!$pdf->send($name)){
            Mage::log('Error generating pdf : ' . $pdf->getError());
        }
    }

    /**
     * Generate a pdf from an url and store it
     * @param string $url
     * @param string $name
     * @return string $name
     */
    public function savePdf($url, $name = "pdf-")
    {
        $pdf = new Pdf($url);
        $pdf->binary = $this->binary;

        $saveDir = Mage::getBaseDir('var') . '/pdf/';
        $name .= time() . '.pdf';

        if(!$pdf->saveAs($saveDir . $name)){
            Mage::log('Error generating pdf : ' . $pdf->getError());
        }

        return $name;
    }

}
