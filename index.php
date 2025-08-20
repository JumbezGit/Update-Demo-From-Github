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
    <title>Update from GitHub</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        pre { background-color: #f8f9fa; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
<<<<<<< HEAD
        <h2>Update Project from GitHub</h2>
        <form method="post">
            <button type="submit" name="update">Pull Latest Changes</button>
        </form>
        <h3>Result:</h3>
        <pre><?php echo $result; ?></pre>
=======
        <div class="card shadow-sm p-4" style="max-width: 600px; margin: 0 auto;">
            <h2 class="card-title text-center mb-4">Update Project from JumbezGit</h2>
            <form method="post" id="updateForm">
                <button type="submit" name="update" id="updateButton" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                    </svg>
                     Changes
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
>>>>>>> 9af09a21e0d473b1a9ca248514464197f8c58379
    </div>
</body>
</html>