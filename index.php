<?php
// Check if the form is submitted
if (isset($_POST['update'])) {
    // Ensure the working directory is the project folder
    $projectPath = 'C:/xampp/htdocs/Update-Demo-From-Github';
    chdir($projectPath);

    // Execute git pull command
    $output = shell_exec('git pull origin main 2>&1');
    
    // Display the output
    $result = $output ? htmlspecialchars($output) : 'No output from git pull command.';
} else {
    $result = 'Click the button to pull the latest changes from the GitHub repository.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Update from GitHub</title>
    <meta name="theme-color" content="#28a745">
    <style>
        body {
            background: linear-gradient(to bottom, #f4f6f9, #e9ecef);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .btn-update {
            background: linear-gradient(45deg, #28a745, #34d058);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-update:hover {
            background: linear-gradient(45deg, #218838, #2cb44a);
        }
        .btn-update:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }
        .progress {
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-bar {
            transition: width 0.1s linear;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4 mt-4">
            <h2 class="text-center mb-4 text-dark">Update Project from GitHub</h2>
            <form method="post" id="updateForm">
                <button type="submit" name="update" id="updateButton" class="btn btn-update w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-github mr-2"></i> Pull Latest Changes
                </button>
            </form>
            <div class="progress mt-3">
                <div class="progress-bar bg-success" role="progressbar" id="progressBar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h3 class="mt-3 text-dark">Result:</h3>
            <div class="alert alert-info mt-2" id="message"><?php echo $result; ?></div>
            <?php if (isset($_POST['update'])) { ?>
                <pre class="bg-light p-3 rounded"><?php echo $result; ?></pre>
            <?php } ?>
        </div>
    </div>
    <script>
        const form = document.getElementById('updateForm');
        const button = document.getElementById('updateButton');
        const progressBar = document.getElementById('progressBar');
        const message = document.getElementById('message');

        form.addEventListener('submit', () => {
            // Disable button and show initial message
            button.disabled = true;
            button.classList.add('disabled');
            message.textContent = 'Checking for updates...';
            message.className = 'alert alert-info mt-2';

            // Simulate progress
            let progress = 0;
            progressBar.style.width = '0%';
            progressBar.setAttribute('aria-valuenow', 0);
            const interval = setInterval(() => {
                progress += 5;
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
                if (progress >= 100) {
                    clearInterval(interval);
                    message.textContent = 'Pulling changes...';
                }
            }, 100); // Update every 100ms to simulate ~2-second progress
        });
    </script>
</body>
</html>
