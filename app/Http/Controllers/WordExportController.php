<?php

namespace App\Http\Controllers;

use App\Models\WeeklyAllowance;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Border;

// Create a new PhpWord object
$phpWord = new PhpWord();

// Add a new section to the document
$section = $phpWord->addSection();

// Add a table to the section
$table = $section->addTable();

// Add cells to the table
for ($row = 1; $row <= 3; $row++) {
    $table->addRow();
    for ($col = 1; $col <= 3; $col++) {
        $cell = $table->addCell(500);
        applyBorderStyles($cell);
    }
}

// Function to apply border styles to a cell
function applyBorderStyles($cell)
{
    $cellStyle = $cell->getStyle();
    $cellStyle->setBorderTop(2, '000000', Border::SINGLE);
    $cellStyle->setBorderBottom(2, '000000', Border::SINGLE);
    $cellStyle->setBorderLeft(2, '000000', Border::SINGLE);
    $cellStyle->setBorderRight(2, '000000', Border::SINGLE);
    $cell->setStyle($cellStyle);
}

// Save the document as a Word file
$filename = 'document.docx';
$filePath = storage_path($filename);

$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($filePath);

// Return the file download response
return response()->download($filePath)->deleteFileAfterSend(true);
