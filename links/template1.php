<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(the_title(), ENT_QUOTES); ?> - Secure Redirect</title>
    <link rel="icon" href="https://i.ibb.co/NNd05gt/money-bag-rupee-color-icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #6366f1;
            --primary-light: #e0e7ff;
            --secondary: #10b981;
            --danger: #ef4444;
            --text: #374151;
            --text-light: #6b7280;
            --light-bg: #f9fafb;
            --border: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 0.25rem;
            --radius: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            max-width: 640px;
            margin: auto;
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            padding: 24px;
            text-align: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }
        
        .logo {
            max-width: 220px;
            height: auto;
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.03);
        }
        
        .content {
            padding: 28px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        h1 {
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            color: #111827;
            text-align: center;
            font-weight: 600;
        }
        
        .progress-container {
            width: 100%;
            margin: 30px 0;
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 30px;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background-color: var(--border);
            z-index: 1;
            transform: translateY(-50%);
        }
        
        .progress-bar {
            position: absolute;
            top: 50%;
            left: 0;
            height: 4px;
            background-color: var(--primary);
            z-index: 2;
            transform: translateY(-50%);
            transition: width 0.4s ease;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: 3px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-light);
            position: relative;
            z-index: 3;
            transition: all 0.4s ease;
        }
        
        .step.active {
            border-color: var(--primary);
            color: var(--primary);
            background-color: var(--primary-light);
        }
        
        .step.completed {
            border-color: var(--secondary);
            background-color: var(--secondary);
            color: white;
        }
        
        .step-label {
            position: absolute;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.85rem;
            font-weight: 500;
            white-space: nowrap;
            color: var(--text-light);
        }
        
        .step.active .step-label,
        .step.completed .step-label {
            color: var(--text);
            font-weight: 600;
        }
        
        .countdown-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 30px 0;
            text-align: center;
        }
        
        .countdown-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 20px;
            background-color: var(--primary-light);
        }
        
        .countdown-loader {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 10px solid transparent;
        }
        
        .loader-outer {
            border-top-color: var(--primary);
            animation: spin 1.2s linear infinite;
        }
        
        .loader-inner {
            border-bottom-color: var(--primary);
            animation: spin 1.2s linear infinite reverse;
            width: 80%;
            height: 80%;
        }
        
        .countdown-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }
        
        .countdown-number i {
            font-size: 1.5rem;
            margin-right: 5px;
        }
        
        .instructions {
            text-align: center;
            margin: 20px 0;
            font-size: 1rem;
            color: var(--text-light);
            display: none;
        }
        
        .button-container {
            display: flex;
            justify-content: center;
            margin: 30px 0 20px;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 14px 28px;
            border-radius: var(--radius-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 180px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3), 0 4px 6px -2px rgba(79, 70, 229, 0.1);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 1px solid var(--border);
        }
        
        .btn-secondary:hover {
            background-color: var(--light-bg);
            border-color: var(--primary);
        }
        
        .btn-disabled {
            background-color: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
            box-shadow: none;
        }
        
        .ad-container {
            margin: 25px 0;
            padding: 20px;
            background-color: #f3f4f6;
            border-radius: var(--radius);
            text-align: center;
            border: 1px dashed var(--border);
        }
        
        .ad-label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-light);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .page-content {
            margin: 25px 0;
            line-height: 1.7;
        }
        
        .page-content p {
            margin-bottom: 1rem;
        }
        
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            padding: 12px;
            background-color: var(--primary-light);
            border-radius: var(--radius);
            color: var(--primary);
            font-weight: 500;
        }
        
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-light);
            border-top: 1px solid var(--border);
            background-color: #f9fafb;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }
        
        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary);
        }
        
        .tooltip {
            position: relative;
            display: inline-block;
        }
        
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #1f2937;
            color: #fff;
            text-align: center;
            border-radius: var(--radius-sm);
            padding: 8px;
            position: absolute;
            z-index: 10;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.85rem;
            font-weight: normal;
        }
        
        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #1f2937 transparent transparent transparent;
        }
        
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @media (max-width: 640px) {
            .container {
                margin: 10px auto;
            }
            
            .content {
                padding: 20px 16px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .countdown-circle {
                width: 120px;
                height: 120px;
            }
            
            .countdown-number {
                font-size: 2.5rem;
            }
            
            .btn {
                padding: 12px 20px;
                font-size: 0.95rem;
                min-width: 160px;
            }
            
            .step {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }
            
            .step-label {
                font-size: 0.75rem;
            }
        }
        
        @media (max-width: 480px) {
            .countdown-circle {
                width: 100px;
                height: 100px;
            }
            
            .countdown-number {
                font-size: 2rem;
            }
            
            .btn {
                width: 100%;
            }
            
            .button-container {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="/" class="logo-link">
                <img src="<?php echo esc_url($code['logo']); ?>" alt="Logo" class="logo">
            </a>
        </div>
        
        <div class="content">
            <h1><?php echo htmlspecialchars(the_title(), ENT_QUOTES); ?></h1>
            
            <div class="progress-container">
                <div class="progress-steps">
                    <div class="progress-bar" id="progress-bar"></div>
                    <div class="step active" id="step-1">
                        <span>1</span>
                        <span class="step-label">Verification</span>
                    </div>
                    <div class="step" id="step-2">
                        <span>2</span>
                        <span class="step-label">Security Check</span>
                    </div>
                    <div class="step" id="step-3">
                        <span>3</span>
                        <span class="step-label">Redirecting</span>
                    </div>
                </div>
            </div>
            
            <div class="ad-container">
                <span class="ad-label">Advertisement</span>
                <?php echo $wpsaf->ads1; ?>
            </div>
            
            <div class="countdown-container" id="countdown-section">
                <div class="countdown-circle">
                    <div class="countdown-loader loader-outer"></div>
                    <div class="countdown-loader loader-inner"></div>
                    <div class="countdown-number" id="countdown-display">
                        <i class="fas fa-shield-alt"></i>
                        <span><?php echo (int)$code['delay']; ?></span>
                    </div>
                </div>
                <p>Verifying link security and preparing your destination...</p>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-lock"></i>
                <span>Secure Encrypted Connection</span>
                <div class="tooltip">
                    <i class="fas fa-info-circle"></i>
                    <span class="tooltiptext">This redirect page uses SSL encryption to protect your data</span>
                </div>
            </div>
            
            <div class="ad-container">
                <span class="ad-label">Sponsored Content</span>
                <?php echo $wpsaf->ads2; ?>
            </div>

      <p class="instructions" id="instructions-text">
    <strong>Scroll Down Click the <span style="color: var(--primary);">Continue</span> button below to proceed to your destination</strong>
</p>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
            
            <div class="ad-container">
                <span class="ad-label">Recommended Offer</span>
                <?php echo $wpsaf->ads3; ?>
            </div>
        </div>
        
        <div class="footer">
            <p>© <?php echo date('Y'); ?> <?php echo htmlspecialchars(get_bloginfo('name'), ENT_QUOTES); ?>. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="/privacy-policy">Privacy Policy</a>
                <a href="/terms">Terms of Service</a>
                <a href="/contact">Contact Us</a>
            </div>
        </div>
    </div>
     
            <div class="button-container">
                <div id="continue-button">
                    <button class="btn btn-primary" onclick="initiateRedirect()">
                        <i class="fas fa-arrow-right"></i> Continue
                    </button>
                </div>
                <div id="waiting-button" style="display: none;">
                    <button class="btn btn-disabled">
                        <i class="fas fa-spinner fa-spin"></i> 
                        <span id="wait-time">5</span> seconds remaining
                    </button>
                </div>
                <div id="proceed-button" style="display: none;">
                    <form name="redirectForm" method="post">
                        <input type="hidden" name="newwpsafelink" value="<?php echo esc_attr($_POST['newwpsafelink']); ?>">
                        <?php wp_nonce_field('safelink_redirect', 'security_nonce'); ?>
                        <button type="submit" class="btn btn-primary" id="final-redirect-btn">
                            <i class="fas fa-external-link-alt"></i> Open Link
                        </button>
                    </form>
                </div>
            </div>

    <script>
        // Progress tracking
        const steps = document.querySelectorAll('.step');
        const progressBar = document.getElementById('progress-bar');
        
        // Initial countdown
        let count = <?php echo (int)$code['delay']; ?>;
        const countdownDisplay = document.getElementById('countdown-display').querySelector('span');
        const countdownSection = document.getElementById('countdown-section');
        
        const updateProgress = (currentStep) => {
            steps.forEach((step, index) => {
                if (index < currentStep - 1) {
                    step.classList.add('completed');
                    step.classList.remove('active');
                } else if (index === currentStep - 1) {
                    step.classList.add('active');
                    step.classList.remove('completed');
                } else {
                    step.classList.remove('active', 'completed');
                }
            });
            
            // Update progress bar width
            const progressWidth = ((currentStep - 1) / (steps.length - 1)) * 100;
            progressBar.style.width = `${progressWidth}%`;
        };
        
        updateProgress(1);
        
        const countdownInterval = setInterval(() => {
            count--;
            countdownDisplay.textContent = count;
            
            if (count <= 0) {
                clearInterval(countdownInterval);
                document.querySelector('.countdown-container p').textContent = 'Security verification complete!';
                document.getElementById('instructions-text').style.display = 'block';
                updateProgress(2);
                
                // Add animation to encourage clicking
                setTimeout(() => {
                    const continueBtn = document.querySelector('#continue-button .btn');
                    continueBtn.style.animation = 'pulse 1.5s infinite';
                }, 500);
            }
        }, 1000);
        
        // Redirect process
        function initiateRedirect() {
            document.getElementById('continue-button').style.display = 'none';
            document.getElementById('waiting-button').style.display = 'block';
            updateProgress(3);
            
            // Remove pulse animation if it was added
            const continueBtn = document.querySelector('#continue-button .btn');
            continueBtn.style.animation = '';
            
            let waitCount = 5;
            const waitDisplay = document.getElementById('wait-time');
            const waitInterval = setInterval(() => {
                waitCount--;
                waitDisplay.textContent = waitCount;
                
                if (waitCount <= 0) {
                    clearInterval(waitInterval);
                    document.getElementById('waiting-button').style.display = 'none';
                    document.getElementById('proceed-button').style.display = 'block';
                    
                    // Add bounce animation to final button
                    const finalBtn = document.getElementById('final-redirect-btn');
                    finalBtn.style.animation = 'bounce 0.8s 2';
                    
                    // Auto-submit form after 3 seconds if user doesn't click
                    setTimeout(() => {
                        if (document.getElementById('proceed-button').style.display !== 'none') {
                            document.redirectForm.submit();
                        }
                    }, 3000);
                }
            }, 1000);
        }
        
        // Fallback in case JavaScript is disabled
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.getElementById('instructions-text').style.display = 'block';
            }, <?php echo (int)$code['delay'] * 1000; ?>);
        });
        
        // Track time spent on page
        let timeSpentOnPage = 0;
        setInterval(() => {
            timeSpentOnPage++;
            // You could send this data to analytics
        }, 1000);
    </script>
</body>
</html>