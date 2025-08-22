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
    --background-gradient: linear-gradient(135deg, blue, aquamarine);
    --border-radius-lg: 14px;
    --box-shadow: 0 8px 20px rgba(45, 58, 75, 0.1);
    --transition: all 0.3s ease-in-out;
}

body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: var(--background-gradient);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--dark-color);
}

.container {
    width: 92%;
    max-width: 1200px;
    background-color: white;
    padding: 40px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--box-shadow);
    animation: fadeIn 0.8s ease;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 20px;
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
    margin-left: 25px;
    font-weight: 600;
    transition: color 0.3s ease, transform 0.2s ease;
}

.main-nav a:hover {
    color: var(--primary-color);
    transform: translateY(-2px);
}

.hero-section {
    display: flex;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
}

.hero-content {
    flex: 1 1 300px;
}

.hero-content h1 {
    font-size: 48px;
    line-height: 1.1;
    margin-bottom: 15px;
    color: var(--dark-color);
}

.hero-content h1 span {
    color: var(--primary-color);
}

.hero-content p {
    font-size: 18px;
    color: var(--text-color);
}

.read-more-btn {
    display: inline-block;
    padding: 15px 35px;
    background-color: var(--primary-color);
    color: white;
    border-radius: 30px;
    font-weight: 600;
    margin-top: 25px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: var(--transition);
}

.read-more-btn:hover {
    background-color: #3B75B5;
    transform: translateY(-2px) scale(1.02); 
}

/* Hero image */
.hero-image {
    flex: 1 1 300px;
    text-align: center; 
}
.hero-image img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--box-shadow); 
    transition: transform 0.3s ease;  
}
.hero-image img:hover {
    transform: scale(1.03);
}

@media (max-width: 768px) {
    .hero-section {
        flex-direction: column;
        text-align: center;
    }
    .hero-content {
        padding-right: 0;
    }
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
                <h1><span>TO-DO-LIST</span></h1>
                <p>Một dự án nho nhỏ </p>
                <a href="todos" class="read-more-btn">GET STARTED</a>
            </div>
            <div class="hero-image">
                <img src="https://mega.com.vn/media/news/0106_hinh-nen-4k-may-tinh11.jpg" alt="Task Illustration">
            </div>
        </div>
    </main>
</div>
</body>
</html>
