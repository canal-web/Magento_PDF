# Magento PDF

Magento model that generates, saves and deletes PDF files from a provided url.

## Installation

`composer require canal-web/magento-pdf`

## Generating a PDF and sending it as a file download

```php
Mage::getModel('canalweb_pdf/pdf')->generatePdf($my_url);
```

By default, the pdf name is `pdf-*timestamp*.pdf`. The prefix may be overridden like this :

```php
Mage::getModel('canalweb_pdf/pdf')->generatePdf($my_url, 'my-prefix-');
```

## Generating a PDF and saving it

```php
Mage::getModel('canalweb_pdf/pdf')->savePdf($my_url);
```

## Deleting a PDF

```php
Mage::getModel('canalweb_pdf/pdf')->deletePdf('pdf-name.pdf');
```
## Customize rendered PDF

Add a `pdf.css` file in  the css folder of your magento theme. E.g. `skin/frontend/myTheme/default/css/pdf.css`
