<?php

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

require "../includes/functions.php";
require "../connection/dsn.php";

if (isset($_POST['generate-report'])) {
	// $fileName = $_POST['file-name'];
	// $reportTitle = $_POST['report-title'];
	$college = $_POST['college'] ?? '';
	$yearLevel = $_POST['year-level'] ?? '';
	$ntspComponent = $_POST['nstp-component'] ?? '';
	$reportTitle = "Student Grades Report"; // Add a report title variable

	// Get database connection (you should implement this function)
	$pdo = getDatabaseConnection();

	// Determine which table to use based on ntspComponent
	$tableName = "cwts"; // Default table
	if (!empty($ntspComponent)) {
		switch ($ntspComponent) {
			case "cwts":
				$tableName = "cwts";
				break;
			case "lts":
				$tableName = "lts";
				break;
			case "rotc":
				$tableName = "rotc";
				break;
			default:
				$tableName = "cwts"; // Default to cwts if none match
		}
	}

	// Retrieve data based on the form input
	$data = getData($pdo, $tableName, $yearLevel, $college, $ntspComponent); // Implement this function to get data from the database

	$headers = [
		'Seq No.' => 'seq_no', // Add sequence number column
		'NSTP Serial Number' => 'serial_number', // Add serial number column
		'Last Name' => 'l_name',
		'First Name' => 'f_name',
		'Name Extension' => 'ex_name',
		'Middle Name' => 'm_name',
		'Year Level' => 'y_level',
		'Course' => 'course',
		// 'First Semester' and 'Second Semester' will span across 5 columns each: Quater 1, Quarter 2, Average, Remarks, School Year
	];

	// Initialize PhpSpreadsheet
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();

	// Set the title
	$columnCount = count($headers) + 10; // Adding 10 extra columns for both semesters (5 each)
	$lastColumn = chr(64 + $columnCount); // Calculate last column letter
	$sheet->mergeCells('A1:' . $lastColumn . '1'); // Merge cells for title
	$sheet->setCellValue('A1', $reportTitle);
	$sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
	$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center title horizontally
	$sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Center title vertically
	$sheet->getRowDimension(1)->setRowHeight(30); // Adjust row height for title

	// Set main headers (row 2)
	$column = 'A';
	foreach ($headers as $header => $key) {
		$sheet->setCellValue($column . '2', $header);
		$sheet->getStyle($column . '2')->getFont()->setBold(true); // Make headers bold
		$sheet->getStyle($column . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center column headers
		$sheet->mergeCells($column . '2:' . $column . '3'); // Merge header cells across two rows
		$column++;
	}

	// Merge cells for "First Semester" and set its label (row 2)
	$firstSemesterStartColumn = $column;
	$sheet->mergeCells($firstSemesterStartColumn . '2:' . chr(ord($firstSemesterStartColumn) + 4) . '2');
	$sheet->setCellValue($firstSemesterStartColumn . '2', 'First Semester');
	$sheet->getStyle($firstSemesterStartColumn . '2')->getFont()->setBold(true); // Make header bold
	$sheet->getStyle($firstSemesterStartColumn . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

	// Set sub-headers for First Semester (row 3)
	$firstSemesterSubHeaders = ['Quarter 1', 'Quarter 2', 'Average', 'Remarks', 'School Year'];
	foreach ($firstSemesterSubHeaders as $subHeader) {
		$sheet->setCellValue($column . '3', $subHeader);
		$sheet->getStyle($column . '3')->getFont()->setBold(true);
		$sheet->getStyle($column . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$column++;
	}

	// Merge cells for "Second Semester" and set its label (row 2)
	$secondSemesterStartColumn = $column;
	$sheet->mergeCells($secondSemesterStartColumn . '2:' . chr(ord($secondSemesterStartColumn) + 4) . '2');
	$sheet->setCellValue($secondSemesterStartColumn . '2', 'Second Semester');
	$sheet->getStyle($secondSemesterStartColumn . '2')->getFont()->setBold(true); // Make header bold
	$sheet->getStyle($secondSemesterStartColumn . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

	// Set sub-headers for Second Semester (row 3)
	$secondSemesterSubHeaders = ['Quarter 1', 'Quarter 2', 'Average', 'Remarks', 'School Year'];
	foreach ($secondSemesterSubHeaders as $subHeader) {
		$sheet->setCellValue($column . '3', $subHeader);
		$sheet->getStyle($column . '3')->getFont()->setBold(true);
		$sheet->getStyle($column . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$column++;
	}

	// Add data rows (starting from row 4)
	$rowNumber = 4;
	if (!empty($data)) {
		foreach ($data as $row) {
			$column = 'A';
			foreach ($headers as $key) {
				$value = $row[$key] ?? '';
				$sheet->setCellValue($column . $rowNumber, $value);
				$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center content cells
				$column++;
			}

			// Fill in the "First Semester" data for each row
			$sheet->setCellValue($column . $rowNumber, $row['quarter_1_grade_sem_1'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Quarter 1
			$sheet->setCellValue(++$column . $rowNumber, $row['quarter_2_grade_sem_1'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Quarter 2
			$sheet->setCellValue(++$column . $rowNumber, $row['average_sem_1'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Average
			$sheet->setCellValue(++$column . $rowNumber, $row['remarks_sem_1'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Remarks
			$sheet->setCellValue(++$column . $rowNumber, $row['school_year_sem_1'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // School Year

			// Fill in the "Second Semester" data for each row
			$sheet->setCellValue(++$column . $rowNumber, $row['quarter_1_grade_sem_2'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Quarter 1
			$sheet->setCellValue(++$column . $rowNumber, $row['quarter_2_grade_sem_2'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Quarter 2
			$sheet->setCellValue(++$column . $rowNumber, $row['average_sem_2'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Average
			$sheet->setCellValue(++$column . $rowNumber, $row['remarks_sem_2'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Remarks
			$sheet->setCellValue(++$column . $rowNumber, $row['school_year_sem_2'] ?? '');
			$sheet->getStyle($column . $rowNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // School Year

			$rowNumber++;
		}
	} else {
		// Handle empty data case
		$sheet->setCellValue('A4', 'No data found');
		$sheet->mergeCells('A4:' . $lastColumn . '4');
	}

	// Set styles for the header row
	$sheet->getStyle('A2:' . $lastColumn . '3')->getFont()->setBold(true);
	$sheet->getStyle('A2:' . $lastColumn . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

	// Auto-adjust column widths
	foreach (range('A', $lastColumn) as $columnID) {
		$sheet->getColumnDimension($columnID)->setAutoSize(true);
	}

	// Create the 'grade_reports' directory if it does not exist
	$directory = '../reports/grade_reports';
	if (!is_dir($directory)) {
		mkdir($directory, 0755, true);
	}

	// Create a writer instance and save the file
	$writer = new Xlsx($spreadsheet);
	$filePath = $directory . '/Student Grades_' . date('Ymd_His') . '.xlsx';

	// Save the file
	$writer->save($filePath);

	// Start the download process
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="' . basename($filePath) . '"');
	header('Cache-Control: max-age=0');
	readfile($filePath);

	// Delete the .tmp file if it exists
	$tempFile = $filePath . '.tmp';
	if (file_exists($tempFile)) {
		unlink($tempFile);
	}

	exit;
}
