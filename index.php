<?php
// Check if the form is submitted
if (isset($_POST['update'])) {
    // Ensure the working directory is the project folder
    $projectPath = 'C:/xampp/htdocs/Update-Demo-From-Github';
    chdir($projectPath);

    // Execute git pull command
    $output = shell_exec('git pull origin main 2>&1');
    
    // Determine the update status
    if (strpos($output, 'Already up to date') !== false) {
        $result = ['status' => 'no-update', 'message' => 'Your project is already up to date!'];
    } elseif (strpos($output, 'Updating') !== false || strpos($output, 'files changed') !== false) {
        $result = ['status' => 'success', 'message' => 'New changes have been successfully pulled from GitHub!'];
    } else {
        $result = ['status' => 'error', 'message' => 'Failed to update: ' . htmlspecialchars($output)];
    }
} else {
    $result = ['status' => 'idle', 'message' => 'Click the button to check for updates from the GitHub repository.'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update from Khamis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">JumbezGit</h2>
        <form method="post" id="updateForm" class="mb-4">
            <button type="submit" name="update" id="updateButton" 
                    class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Pull Latest Changes
            </button>
        </form>
        <div class="progress-container w-full bg-gray-200 rounded-full h-4 mb-4 overflow-hidden">
            <div class="progress-bar bg-green-600 h-full rounded-full transition-all duration-100" id="progressBar" style="width: 0%"></div>
        </div>
        <div class="message text-center text-lg font-medium <?php echo $result['status'] === 'success' ? 'text-green-600' : ($result['status'] === 'error' ? 'text-red-600' : 'text-gray-600'); ?>" id="message">
            <?php echo $result['message']; ?>
        </div>
        <?php if ($result['status'] === 'error') { ?>
            <pre class="bg-gray-100 p-3 rounded-md text-sm text-gray-700 mt-2"><?php echo $result['message']; ?></pre>
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
            button.classList.add('bg-gray-400', 'cursor-not-allowed');
            message.textContent = 'Checking for updates...';
            message.className = 'message text-center text-lg font-medium text-gray-600';

            // Simulate progress
            let progress = 0;
            progressBar.style.width = '0%';
            const interval = setInterval(() => {
                progress += 5;
                progressBar.style.width = `${progress}%`;
                if (progress >= 100) {
                    clearInterval(interval);
                    message.textContent = 'Pulling changes...';
                }
            }, 100); // Update every 100ms to simulate ~2-second progress
        });
    </script>
</body>
</html>
