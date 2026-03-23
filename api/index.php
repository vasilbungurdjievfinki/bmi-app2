<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

function bmiCategory($bmi) {
    if ($bmi < 18.5) return ['Underweight', 'Consider a balanced calorie surplus and strength training.'];
    if ($bmi < 25.0) return ['Normal', 'Great job—aim for consistency with movement, sleep, and nutrition.'];
    if ($bmi < 30.0) return ['Overweight', 'A small calorie deficit + daily steps + strength training works well.'];
    return ['Obese', 'Consider a structured plan and, if possible, professional medical guidance.'];
}

$input = json_decode(file_get_contents('php://input'), true);

$units  = $input['units'] ?? 'metric';
$weight = $input['weight'] ?? '';
$height = $input['height'] ?? '';
$age    = $input['age'] ?? '';
$gender = $input['gender'] ?? 'na';

$errors = [];

$units = in_array($units, ['metric','imperial'], true) ? $units : 'metric';

$w = str_replace(',', '.', trim((string)$weight));
$h = str_replace(',', '.', trim((string)$height));
$a = str_replace(',', '.', trim((string)$age));

if ($w === '' || !is_numeric($w) || (float)$w <= 0) $errors[] = 'Please enter a valid weight.';
if ($h === '' || !is_numeric($h) || (float)$h <= 0) $errors[] = 'Please enter a valid height.';
if ($a !== '' && (!is_numeric($a) || (int)$a < 1 || (int)$a > 120)) $errors[] = 'Age must be between 1 and 120 (optional).';
if (!in_array($gender, ['na','f','m'], true)) $errors[] = 'Invalid gender value.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['errors' => $errors]);
    exit;
}

$w = (float)$w;
$h = (float)$h;

if ($units === 'metric') {
    $hMeters = $h / 100.0;
    $bmi = $w / ($hMeters * $hMeters);
} else {
    $bmi = 703.0 * $w / ($h * $h);
}

[$category, $advice] = bmiCategory($bmi);

echo json_encode([
    'bmi' => number_format($bmi, 2),
    'category' => $category,
    'advice' => $advice
]);