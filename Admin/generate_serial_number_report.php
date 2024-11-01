<?php

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

require "../includes/functions.php";
require "../connection/dsn.php";

if (isset($_POST['generate-report'])) {
  $search = isset($_POST['search']) ? $_POST['search'] : '';
  $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
  $college = isset($_POST['college']) ? $_POST['college'] : '';
  $yearLevel = isset($_POST['year_level']) ? $_POST['year_level'] : '';
  $ntspComponent = isset($_POST['nstp-component']) ? $_POST['nstp-component'] :  '';

  // Get database connection
  $pdo = getDatabaseConnection();

  $data = getData(pdo: $pdo, yearLevel: $yearLevel, college: $college, ntspComponent: $ntspComponent, sex: $sex, search: $search);

  // Define headers
  $headers = [
    'SEQNO.' => 'std_id',
    'NSTP COMPONENT (CWTS/LTS/ROTC)' => 'nstp_component',
    'LAST NAME' => 'l_name',
    'FIRST NAME' => 'f_name',
    'EXTENSION NAME' => 'ex_name',
    'MIDDLE NAME' => 'm_name',
    'NSTP SERIAL NUMBER' => 'serial_number',
    'NSTP GRADUATION YEAR' => 'nstp_grad_year',
    // 'Civil Status' => 'c_status',
    // 'Religion' => 'religion',
    // 'College' => 'college',
    // 'Major' => 'major',
    // 'CPCE' => 'cpce',
    // 'CPCE Contact Number' => 'cpce_cp_number',
  ];

  // Initialize PhpSpreadsheet
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

  // // Set the title
  // $columnCount = count($headers);
  // $lastColumn = chr(64 + $columnCount); // Calculate last column letter
  // $sheet->mergeCells('A1:' . $lastColumn . '1'); // Merge cells for title
  // $sheet->setCellValue('A1', $reportTitle);
  // $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
  // $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center title horizontally
  // $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Center title vertically
  // $sheet->getRowDimension(1)->setRowHeight(30); // Adjust row height for title

  // Set header row
  $column = 'A';
  foreach ($headers as $header => $key) {
    $sheet->setCellValue($column . '2', $header);
    $sheet->getStyle($column . '2')->getFont()->setBold(true); // Make headers bold
    $sheet->getStyle($column . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center column headers
    $column++;
  }
  // Add data rows
  $rowNumber = 3;
  $emailColumnIndex = array_search('email_add', array_values($headers)) + 1; // Get the index of the email column (1-based)

  if (!empty($data)) {
    foreach ($data as $row) {
      $column = 'A';
      foreach ($headers as $key) {
        $value = $row[$key] ?? '';

        // Check if the key is 'sex' and adjust the value
        if (
          $key === 'sex'
        ) {
          if (strtoupper($value) === 'MALE') {
            $value = 'M';
          } elseif (
            strtoupper($value) === 'FEMALE'
          ) {
            $value = 'F';
          }
        }

        $sheet->setCellValue($column . $rowNumber, $value);

        // Format email column as hyperlink if it contains a valid email
        if ($key === 'email_add' && filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $sheet->getCell($column . $rowNumber)->getHyperlink()->setUrl('mailto:' . $value);
        }

        // Center all cells horizontally
        $sheet->getStyle($column . $rowNumber)
          ->getAlignment()
          ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $column++;
      }
      $rowNumber++;
    }
  } else {
    // Handle empty data case
    $sheet->setCellValue('A3', 'No data found');
    $sheet->mergeCells('A3:' . $column . '3');
    $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center the "No data found" message
  }

  // // Add data rows
  // $rowNumber = 3;
  // $emailColumnIndex = array_search('email_add', array_values($headers)) + 1; // Get the index of the email column (1-based)
  // if (!empty($data)) {
  // 	foreach ($data as $row) {
  // 		$column = 'A';
  // 		foreach ($headers as $key) {
  // 			$value = $row[$key] ?? '';

  // 			if ($key === 'sex') {
  // 				if (strtoupper($value) === 'MALE') {
  // 					$value = 'M';
  // 				} elseif (strtoupper($value) === 'FEMALE') {
  // 					$value = 'F';
  // 				}
  // 			}

  // 			$sheet->setCellValue($column . $rowNumber, $value);

  // 			// Format email column as hyperlink if it contains a valid email
  // 			if ($key === 'email_add' && filter_var($value, FILTER_VALIDATE_EMAIL)) {
  // 				$sheet->getCell($column . $rowNumber)->getHyperlink()->setUrl('mailto:' . $value);
  // 			} else {
  // 				$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Left-justify content cells
  // 			}

  // 			$column++;
  // 		}
  // 		$rowNumber++;
  // 	}
  // } else {
  // 	// Handle empty data case
  // 	$sheet->setCellValue('A3', 'No data found');
  // 	$sheet->mergeCells('A3:' . $column . '3');
  // }

  // Auto-adjust column widths
  foreach (range('A', chr(64 + count($headers))) as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
  }

  // Create a writer instance and save the file
  $writer = new Xlsx($spreadsheet);
  $filePath = '../reports/Student_List_' . date('Ymd_His') . '.xlsx';

  // Ensure the directory exists and is writable
  if (!is_dir(dirname($filePath))) {
    mkdir(dirname($filePath), 0755, true);
  }

  // Save the file
  $writer->save($filePath);

  // Redirect to the generated file for download
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="' . basename($filePath) . '"');
  header('Cache-Control: max-age=0');
  readfile($filePath);
  exit;
}
