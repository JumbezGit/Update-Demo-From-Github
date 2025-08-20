<?php
// Check if the form is submitted
if (isset($_POST['update'])) {
    // Ensure the working directory is the project folder
    $projectPath = 'C:/xampp/htdocs/Update-Demo-From-Github';
    chdir($projectPath);

    // Execute git pull command
    $output = shell_exec('git pull origin main 2>&1');
    
    // Determine success or failure
    if (strpos($output, 'Already up to date') !== false || strpos($output, 'Updating') !== false) {
        $result = ['status' => 'success', 'message' => 'Update successful! Repository is up to date.'];
    } else {
        $result = ['status' => 'error', 'message' => 'Update failed: ' . htmlspecialchars($output)];
    }
} else {
    $result = ['status' => 'idle', 'message' => 'Click the button to pull the latest changes from the GitHub repository.'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update from Khamis</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        button:disabled { background-color: #6c757d; cursor: not-allowed; }
        pre { background-color: #f8f9fa; padding: 10px; border-radius: 5px; }
        .progress-container { width: 100%; background-color: #f3f3f3; border-radius: 5px; margin: 10px 0; }
        .progress-bar { width: 0%; height: 20px; background-color: #28a745; border-radius: 5px; transition: width 0.1s linear; }
        .message { font-weight: bold; margin: 10px 0; }
        .success { color: #28a745; }
        .error { color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Project from JumbezGit</h2>
        <form method="post" id="updateForm">
            <button type="submit" name="update" id="updateButton">Pull Latest Changes</button>
        </form>
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        <h3>Status:</h3>
        <div class="message <?php echo $result['status']; ?>" id="message"><?php echo $result['message']; ?></div>
        <?php if ($result['status'] === 'error') { ?>
            <pre><?php echo $result['message']; ?></pre>
        <?php } ?>
    </div>
    <script>
        const form = document.getElementById('updateForm');
        const button = document.getElementById('updateButton');
        const progressBar = document.getElementById('progressBar');
        const message = document.getElementById('message');

        form.addEventListener('submit', () => {
            // Disable button and show initial message
            button.disabled = true;
            message.textContent = 'Starting update...';
            message.className = 'message';

            // Simulate progress
            let progress = 0;
            progressBar.style.width = '0%';
            const interval = setInterval(() => {
                progress += 5;
                progressBar.style.width = `${progress}%`;
                if (progress >= 100) {
                    clearInterval(interval);
                    message.textContent = 'Update in progress...';
                }
            }, 100); // Update every 100ms to simulate 2-second progress
        });
    </script>
</body>
</html>
