<?php
require_once '../classes/database.php';

try {
    // Connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=rms_db', 'username', 'password');

    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate user input
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        // Input validation
        if (empty($title) || empty($start) || empty($end)) {
            throw new Exception('All fields are required.');
        }

        // Create a new event in the database
        $stmt = $pdo->prepare('INSERT INTO events (title, start, end) VALUES (?, ?, ?)');
        $stmt->execute([$title, $start, $end]);

        // Redirect to the calendar page
        header('Location: /calendar.php');
        exit;
    }

    // Fetch events from the database
    $stmt = $pdo->prepare('SELECT id, title, start, end FROM events');
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convert the events to the format expected by FullCalendar
    $fcEvents = [];
    foreach ($events as $event) {
        $fcEvent = [
            'id' => $event['id'],
            'title' => $event['title'],
            'start' => $event['start'],
            'end' => $event['end'],
        ];
        $fcEvents[] = $fcEvent;
    }

    // Send the events to the client in JSON format
    header('Content-Type: application/json');
    echo json_encode($fcEvents);
} catch (PDOException $e) {
    // Handle database errors
    echo 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    // Handle other errors
    echo 'Error: ' . $e->getMessage();
}