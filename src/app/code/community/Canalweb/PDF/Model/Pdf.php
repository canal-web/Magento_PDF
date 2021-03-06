<?php

use mikehaertl\wkhtmlto\Pdf;

class Canalweb_PDF_Model_Pdf
{
    /**
     * Define the wkhtmltopdf binary location
     */
    protected $binary = 'vendor/bin/wkhtmltopdf-amd64';

    /**
     * Location of the saved pdf files
     * @param string $saveDir
     */
    protected $saveDir;

    /**
     * Array of options
     * @param array $options
     */
    protected $options = array();

    public function __construct()
    {
        // You may define here the saved files location
        $this->saveDir = Mage::getBaseDir('var') . '/pdf/';
        if(!is_dir($this->saveDir)){
            mkdir($this->saveDir);
        }
        // Add a custom css file if it exists
        $storeId =  Mage::app()->getDefaultStoreView()->getStoreId();
        $themeOptions = array('_package' => Mage::getStoreConfig('design/package/name', $storeId));
        $theme = Mage::getDesign()->getSkinBaseDir($themeOptions);
        if(is_file($theme . '/css/pdf.css')){
            $this->options['user-style-sheet'] = $theme . '/css/pdf.css';
        }
    }

    /**
     * Generate a pdf from an url and return  it
     * @param string $url
     * @param string $name
     */
    public function generatePdf($url,  $name = "pdf-")
    {

        $pdf = new Pdf($this->options);
        $pdf->addPage($url);
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
        $pdf = new Pdf($this->options);
        $pdf->addPage($url);
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
