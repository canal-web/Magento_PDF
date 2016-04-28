<?php
class Canalweb_PDF_Model_Pdf
{
    /**
     * Generate a pdf from an url and send it
     * @param string $url
     * @param string $name
     */
    public function generatePdf($url,  $name = "pdf-")
    {

        $pdf = new Pdf($url);
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
    public function savePdf($pdf, $name = "pdf-")
    {
        $saveDir = Mage::getBaseDir('var') . '/pdf/';
        $pdf = new Pdf($url);
        $name .= time() . '.pdf';

        if(!$pdf->saveAs($saveDir . $name)){
            Mage::log('Error generating pdf : ' . $pdf->getError());
        }

        return $name;
    }

}
