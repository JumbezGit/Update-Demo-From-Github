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
    <title>Update from Khamis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="card shadow-sm p-4" style="max-width: 600px; margin: 0 auto;">
            <h2 class="card-title text-center mb-4">Update Project from JumbezGit</h2>
            <form method="post" id="updateForm">
                <button type="submit" name="update" id="updateButton" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                    </svg>
                    Pull Latest Changes
                </button>
            </form>
            <div class="progress mt-3" style="height: 20px;">
                <div class="progress-bar bg-success" role="progressbar" id="progressBar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h3 class="mt-3">Result:</h3>
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
            button.classList.add('btn-secondary');
            button.classList.remove('btn-primary');
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
