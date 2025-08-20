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
    <title>Update from GitHub</title>
    <meta name="theme-color" content="#28a745">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e9f7ef, #d4edda);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .update-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            padding: 25px;
            max-width: 650px;
            width: 100%;
        }
        .update-btn {
            background: linear-gradient(90deg, #28a745, #218838);
            border: none;
            color: #fff;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 50px;
            transition: 0.3s ease-in-out;
        }
        .update-btn:hover {
            background: linear-gradient(90deg, #218838, #1e7e34);
            transform: scale(1.05);
        }
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            max-height: 300px;
            overflow-y: auto;
            font-size: 14px;
        }
        .progress {
            height: 20px;
            border-radius: 50px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="update-card">
        <h2 class="text-center text-success mb-4">🔄 GitHub </h2>
        <form method="post" id="updateForm" class="text-center mb-4">
            <button type="submit" name="update" class="update-btn" id="updateBtn">
                🚀 Pull Latest Changes
            </button>
        </form>

        <!-- Progress bar -->
        <div class="progress mb-3" id="progressBarContainer">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                 role="progressbar" style="width: 0%" id="progressBar"></div>
        </div>

        <h5 class="text-secondary">Result:</h5>
        <pre><?php echo $result; ?></pre>
    </div>

    <script>
        document.getElementById("updateForm").addEventListener("submit", function () {
            let progressBar = document.getElementById("progressBar");
            let container = document.getElementById("progressBarContainer");
            container.style.display = "block";
            let width = 0;

            let interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                } else {
                    width += 5; // progress speed
                    progressBar.style.width = width + "%";
                }
            }, 300); // update every 0.3s
        });
    </script>
</body>
</html>
