<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="404 - Page Not Found">
    <title>404 - Page Not Found</title>
    <style>
        :root {
            --bg-primary: #000000;
            --bg-secondary: #0a0a0a;
            --text-primary: #ffffff;
            --text-secondary: #888888;
            --accent-light: rgba(255, 255, 255, 0.9);
            --accent-dim: rgba(255, 255, 255, 0.1);
            --shadow: rgba(0, 0, 0, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            position: relative;
            overflow: hidden;
        }

        /* Matrix Rain Effect */
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.3;
        }

        /* Glitch Container */
        .container {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 2rem;
        }

        .glitch-wrapper {
            position: relative;
            width: fit-content;
            margin: 0 auto;
        }

        .glitch {
            font-size: 12rem;
            font-weight: 900;
            line-height: 1;
            color: var(--text-primary);
            letter-spacing: -0.5rem;
            position: relative;
            text-shadow: 0.05em 0 0 var(--accent-dim),
                         -0.025em -0.05em 0 var(--accent-dim),
                         0.025em 0.05em 0 var(--accent-dim);
            animation: glitch 2s infinite;
        }

        .glitch span {
            position: absolute;
            top: 0;
            left: 0;
        }

        .glitch span:first-child {
            animation: glitch 650ms infinite;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
            transform: translate(-0.025em, -0.0125em);
            opacity: 0.75;
        }

        .glitch span:last-child {
            animation: glitch 375ms infinite;
            clip-path: polygon(0 80%, 100% 20%, 100% 100%, 0 100%);
            transform: translate(0.0125em, 0.025em);
            opacity: 0.75;
        }

        /* Message Styling */
        .message {
            font-size: 1.8rem;
            margin: 2rem 0;
            color: var(--text-secondary);
            line-height: 1.6;
            text-shadow: 0 2px 4px var(--shadow);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards 0.5s;
        }

        /* Button Styling */
        .home-button {
            display: inline-block;
            padding: 1.2rem 3rem;
            font-size: 1.2rem;
            color: var(--text-primary);
            text-decoration: none;
            border: 2px solid var(--text-primary);
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            background: transparent;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards 0.7s;
        }

        .home-button:hover {
            background: var(--text-primary);
            color: var(--bg-primary);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px var(--shadow);
        }

        .home-button::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .home-button:hover::before {
            left: 100%;
        }

        /* Scanline Effect */
        .scanlines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 3;
            background: linear-gradient(
                to bottom,
                rgba(255, 255, 255, 0) 50%,
                rgba(0, 0, 0, 0.1) 50%
            );
            background-size: 100% 4px;
            animation: scanlines 0.4s steps(60) infinite;
        }

        /* Animations */
        @keyframes glitch {
            0% {
                text-shadow: 0.05em 0 0 var(--accent-dim),
                            -0.025em -0.05em 0 var(--accent-dim),
                            0.025em 0.05em 0 var(--accent-dim);
            }
            14% {
                text-shadow: 0.05em 0 0 var(--accent-dim),
                            -0.025em -0.05em 0 var(--accent-dim),
                            0.025em 0.05em 0 var(--accent-dim);
            }
            15% {
                text-shadow: -0.05em -0.025em 0 var(--accent-dim),
                            0.025em 0.025em 0 var(--accent-dim),
                            -0.05em -0.05em 0 var(--accent-dim);
            }
            49% {
                text-shadow: -0.05em -0.025em 0 var(--accent-dim),
                            0.025em 0.025em 0 var(--accent-dim),
                            -0.05em -0.05em 0 var(--accent-dim);
            }
            50% {
                text-shadow: 0.025em 0.05em 0 var(--accent-dim),
                            0.05em 0 0 var(--accent-dim),
                            0 -0.05em 0 var(--accent-dim);
            }
            99% {
                text-shadow: 0.025em 0.05em 0 var(--accent-dim),
                            0.05em 0 0 var(--accent-dim),
                            0 -0.05em 0 var(--accent-dim);
            }
            100% {
                text-shadow: -0.025em 0 0 var(--accent-dim),
                            -0.025em -0.025em 0 var(--accent-dim),
                            -0.025em -0.05em 0 var(--accent-dim);
            }
        }

        @keyframes scanlines {
            from { transform: translateY(0); }
            to { transform: translateY(4px); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .glitch {
                font-size: 8rem;
                letter-spacing: -0.3rem;
            }
            .message {
                font-size: 1.4rem;
            }
            .home-button {
                padding: 1rem 2rem;
                font-size: 1rem;
                letter-spacing: 2px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .matrix-bg,
            .scanlines,
            .glitch,
            .home-button::before {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <canvas class="matrix-bg" id="matrix"></canvas>
    <div class="scanlines"></div>

    <main class="container" role="main">
        <div class="glitch-wrapper">
            <h1 class="glitch" aria-label="404 Error">
                404
                <span aria-hidden="true">404</span>
                <span aria-hidden="true">404</span>
            </h1>
        </div>
        <p class="message">SYSTEM ERROR: Reality not found<br>Recalibrating dimensions...</p>
        <a href="/" class="home-button" aria-label="Return to homepage">
            Return
        </a>
    </main>

    <script>
        // Matrix rain effect
        const canvas = document.getElementById('matrix');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const chars = '0123456789ABCDEF'.split('');
        const fontSize = 14;
        const columns = canvas.width / fontSize;
        const drops = new Array(Math.floor(columns)).fill(1);

        function draw() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = '#ffffff';
            ctx.font = `${fontSize}px monospace`;

            for (let i = 0; i < drops.length; i++) {
                const text = chars[Math.floor(Math.random() * chars.length)];
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);

                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i]++;
            }
        }

        setInterval(draw, 33);

        // Resize handler
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            drops.length = Math.floor(canvas.width / fontSize);
            drops.fill(1);
        });

        // Parallax effect
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth - 0.5;
            const mouseY = e.clientY / window.innerHeight - 0.5;

            document.querySelector('.glitch').style.transform = 
                `translate(${mouseX * 20}px, ${mouseY * 20}px)`;
        });
    </script>
</body>
</html>
