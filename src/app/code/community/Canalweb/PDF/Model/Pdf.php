<?php

use mikehaertl\wkhtmlto\Pdf;

class Canalweb_PDF_Model_Pdf
{
    /**
     * Define the wkhtmltopdf binary location
     */
    protected $binary = 'vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386';

    /**
     * Location of the saved pdf files
     */
    protected $saveDir;

    public function __construct()
    {
        // You may define here the saved files location
        $this->saveDir = Mage::getBaseDir('var') . '/pdf/';
        if(!is_dir($this->saveDir)){
            mkdir($this->saveDir);
        }
    }

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

        $saveDir = $this->saveDir;
        $name .= time() . '.pdf';

        if(!$pdf->saveAs($saveDir . $name)){
            Mage::log('Error generating pdf : ' . $pdf->getError());
        }

        return $name;
    }

    /**
     * Delete a pdf file
     * @param string $file
     */
    public function deletePdf($file)
    {
        $saveDir = $this->saveDir;
        if(is_file($saveDir . $file)){
            if(!unlink($saveDir . $file)){
                Mage::log('Error deleting pdf');
            }
        }
    }

}
