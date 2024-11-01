<?php
function getRowCount($pdo, $tableName, $condition = '')
{
    try {
        $query = "SELECT COUNT(*) AS count FROM " . $tableName;

        if (!empty($condition)) {
            $query .= " WHERE " . $condition;
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    } catch (PDOException $e) {
        error_log('Query failed: ' . $e->getMessage(), 3, '/path/to/error.log');
        return false;
    }
}


function getData($pdo,  $yearLevel, $college, $ntspComponent, $sex, $search)
{
    // Build the base query
    $query = "SELECT * FROM `tbl_20_columns` WHERE 1=1";

    $params = [];

    if ($yearLevel) {
        $query .= " AND y_level = :yearLevel";
        $params[':yearLevel'] = $yearLevel;
    }

    if ($college) {
        $query .= " AND college = :college";
        $params[':college'] = $college;
    }

    if ($ntspComponent) {
        $query .= " AND nstp_component = :ntspComponent";
        $params[':ntspComponent'] = $ntspComponent;
    }
    if ($sex) {
        $query .= " AND sex = :sex";
        $params[':sex'] = $sex;
    }
    if ($search) {
        $query .= " AND (f_name LIKE CONCAT('%', :search, '%') OR l_name LIKE CONCAT('%', :search, '%') OR m_name LIKE CONCAT('%', :search, '%'))";
        $params[':search'] = $search;
    }

    // Prepare and execute the statement 
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    // Fetch all results as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}


function checkAccess($nstp_component = null)
{
    if (!isset($_SESSION['nstp_component']) || ($nstp_component && $_SESSION['nstp_component'] !== $nstp_component)) {
        header('Location: login-page.php');
        exit();
    }
}


function convertToGradePointScale($grade)
{
    $scaleRanges = [
        1.00 => [96, 100],
        1.25 => [94, 95],
        1.50 => [91, 93],
        1.75 => [88, 90],
        2.00 => [85, 87],
        2.25 => [83, 84],
        2.50 => [80, 82],
        2.75 => [78, 79],
        3.00 => [75, 77],
        5.00 => [1, 74]
    ];

    if ($grade === 'INC' || $grade === 'DROP') {
        return $grade;
    }

    $grade = (float)$grade;

    foreach ($scaleRanges as $gradePoint => [$min, $max]) {
        if ($grade >= $min && $grade <= $max) {
            return $gradePoint;
        }
    }

    return null;
}
