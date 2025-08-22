<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Online - Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50E3C2;
            --dark-color: #2D3A4B;
            --text-color: #6C757D;
            --background-color: #F8F9FA;
            --border-radius-lg: 12px;
            --box-shadow: 0 8px 20px rgba(45, 58, 75, 0.1);
            --box-shadow-hover: 0 12px 24px rgba(45, 58, 75, 0.15); 
            --transition: all 0.3s ease-in-out;
            --transition-hover: all 0.3s ease-in-out;
            
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--background-color);
            color: var(--dark-color);
            line-height: 1.6;
            transition: var(--transition);

        }

        .container {
            width: 90%;
            max-width: 1200px;
            background-color: white;
            padding: 40px; 
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius-lg);
            position: relative;
            transition: var(--transition); 

        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 30px;
            border-bottom: 1px solid #eee;
            margin-bottom: 30px;
        }

        .company-logo {
            font-weight: 700; 
            font-size: 28px; 
            color: var(--primary-color);
        }

        .main-nav a {
            text-decoration: none;
            color: var(--text-color);
            margin-left: 30px;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .main-nav a:hover {
            color: var(--primary-color);
        }

        .hero-section {
            display: flex;
            align-items: center;
            padding: 50px 0;
            gap: 40px;
        }

        .hero-content {
            flex: 1;
            padding-right: 20px;
        }

        .hero-content h1 {
            font-size: 56px; 
            line-height: 1.1;
            color: var(--dark-color);
            margin-bottom: 15px;
        }

        .hero-content p {
            font-size: 18px; 
            color: var(--text-color);
            line-height: 1.6;
        }

        .read-more-btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            margin-top: 25px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        
        .read-more-btn:hover {
            background-color: #3B75B5;
            transform: translateY(-2px); /* Hiệu ứng nâng nhẹ khi di chuột */
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div class="company-logo">TO-DO-LIST</div>
        <nav class="main-nav">
            <a href="#">ABOUT</a>
            <a href="#">PRODUCTS</a>
            <a href="#">PRICES</a>
            <a href="#">CONTACT US</a>
        </nav>
    </header>
    <main>
        <div class="hero-section">
            <div class="hero-content">
                <h1>Manage your tasks with <br>
                <span class="text-primary">TO-DO-LIST</span></h1>
                <p>
                    một dự án nho nhỏ ở đây
                </p>
                
                <a href="todos" class="read-more-btn">GET STARTED</a>
            </div>
        </div>
    </main>
</div>
</body>
</html>