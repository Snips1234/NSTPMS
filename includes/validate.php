<?php

function validate($data, $rules, $pdo)
{
	$errors = [];

	foreach ($rules as $field => $fieldRules) {
		$value = isset($data[$field]) ? $data[$field] : '';

		foreach ($fieldRules as $rule => $message) {
			if (strpos($rule, ':') !== false) {
				list($ruleName, $ruleValue) = explode(':', $rule, 2);
				$ruleValue = trim($ruleValue);
			} else {
				$ruleName = $rule;
				$ruleValue = null;
			}

			switch ($ruleName) {
				case 'required':
					if (empty($value)) {
						$errors[$field] = $message;
					}
					break;
				case 'min':
					if (strlen($value) < $ruleValue) {
						$errors[$field] = $message;
					}
					break;
				case 'max':
					if (strlen($value) > $ruleValue) {
						$errors[$field] = $message;
					}
					break;
				case 'numeric':
					if (!is_numeric($value)) {
						$errors[$field] = $message;
					}
					break;
				case 'email':
					if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
						$errors[$field] = $message;
					}
					break;
				case 'date':
					if (!strtotime($value)) {
						$errors[$field] = $message;
					}
					break;
				case 'unique':
					$table = isset($ruleValue) ? $ruleValue : 'tbl_20_columns_cwts';
					if (!isUsernameUnique($pdo, $value)) {
						$errors[$field] = $message;
					}
					break;
			}
		}
	}

	return $errors;
}

// function isUsernameUnique($pdo, $username, $table)
// {
// 	$query = "SELECT COUNT(*) FROM $table WHERE username = :username";
// 	$stmt = $pdo->prepare($query);
// 	$stmt->bindValue(':username', $username);
// 	$stmt->execute();
// 	return $stmt->fetchColumn() == 0;
// }
function isUsernameUnique($pdo, $username)
{
	// Define the tables you want to check
	$tables = ['tbl_20_columns_cwts', 'tbl_20_columns_lts', 'tbl_20_columns_rotc'];

	// Prepare the query to check across multiple tables
	$queryParts = [];
	foreach ($tables as $table) {
		$queryParts[] = "SELECT COUNT(*) FROM $table WHERE username = :username";
	}
	$query = implode(' UNION ALL ', $queryParts);

	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':username', $username);
	$stmt->execute();

	// Check the total count from all queries
	$totalCount = 0;
	foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $count) {
		$totalCount += $count;
	}

	// Return true if the username is unique (count is 0)
	return $totalCount == 0;
}
