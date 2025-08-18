<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Online - Welcome</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f4f7;
            color: #333; 
        }

        .container {
            width: 90%;
            max-width: 1200px;
            background-color: white;
            padding: 40px; 
            box-shadow: 0 8px 16px rgba(0,0,0,0.1); 
            border-radius: 12px; 
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
            color: #2149da; 
        }

        .main-nav a {
            text-decoration: none;
            color: #555;
            margin-left: 30px;
            font-weight: 500;
            transition: color 0.3s ease; /* Thêm hiệu ứng chuyển đổi màu */
        }
        
        .main-nav a:hover {
            color: #2149da;
        }

        .hero-section {
            display: flex;
            align-items: center;
            padding: 50px 0;
            gap: 40px; /* Thêm khoảng cách giữa các phần tử flexbox */
        }

        .hero-content {
            flex: 1;
            padding-right: 20px;
        }

        .hero-content h1 {
            font-size: 56px; 
            line-height: 1.1;
            color: #222;
            margin-bottom: 15px;
        }

        .hero-content p {
            font-size: 18px; 
            color: #666;
            line-height: 1.6;
        }

        .read-more-btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #2149da;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            margin-top: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        
        .read-more-btn:hover {
            background-color: #1a3c9e;
        }

        .hero-image {
            flex: 1;
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
                <h1>TO-DO-LIST</h1>
                <p>một dự án nhỏ ở đây</p>
                <a href="todos" class="read-more-btn">GET STARTED</a>
            </div>
        </div>
    </main>
</div>

</body>
</html>