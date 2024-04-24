<!DOCTYPE html>
<html lang="cat">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Read dir PHP</title>

    <meta name="color-scheme" content="dark light">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            background-color: #101010;
            font-family: "Source Code Pro", monospace;
            color: #eee;
            overflow: clip;
        }

        a {
            color: #eee;
            text-decoration: none;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1rem 0;
            background-color: #0040ff;
            backdrop-filter: blur(12px);
            z-index: 1;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: min(1000px, 100% - 2rem);
            margin-inline: auto;
        }

        header img {
            height: 40px;
        }

        main {
            padding: 8rem 0;
            background: url(img/bg.webp) center no-repeat;
            background-size: 100%;
            height: 100vh;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            width: min(1000px, 100% - 2rem);
            margin-inline: auto;
        }

        .main-content > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-content form select {
            padding: .5rem 1rem;
            background-color: rgb(0 0 0 / .5);
            border: none;
            border-radius: .25rem;
            font-family: inherit;
        }

        .main-content form button {
            padding: .5rem 1rem;
            background-color: rgb(128 128 128 / .65);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: .25rem;
        }

        .main-content form button:hover {
            cursor: pointer;
        }

        .main-content h1 {
            font-size: 2.5rem;
            text-align: center;
        }
        
        nav {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 2rem;
        }

        .page-card {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: fit-content;
            aspect-ratio: 2 / 1;
            padding: 2rem 1rem;
            background-color: rgb(255 255 255 / .22);
            border: 1px solid rgb(255 255 255 / .25);
            border-radius: .25rem;
            text-align: center;
            backdrop-filter: blur(12px);
            transition: transform .2s ease-in-out;
        }

        .page-card:hover {
            transform: scale(1.04);
            cursor: pointer;
        }

        .page-card:before {
            position: absolute;
            top: 8px;
            left: 8px;
        }

        .page-card.folder {
            background-color: rgb(0 200 255 / .22);
        }

        .page-card.folder:before {
            content: '📁';
        }

        .page-card.file:before {
            content: '📄';
        }

        details {
            position: relative;
        }

        summary::marker {
            content: '';
        }

        details > ul {
            position: absolute;
            left: 0;
            padding: 1rem;
            margin-top: 5px;
            width: 100%;
            background-color: rgb(0 64 255 / .42);
            backdrop-filter: blur(12px);
            border-radius: .25rem;
            z-index: 1;
        }

        details > ul li {
            list-style: none;
            text-decoration: underline;
            text-decoration-color: transparent;
            transition: text-decoration-color .2s ease-in-out;
        }

        details > ul li:hover {
            text-decoration-color: currentColor;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 1rem 0;
            background-color: #052996;
            z-index: 1;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: min(1200px, 100% - 2rem);
            margin-inline: auto;
        }

        .footer-content > div {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .footer-content > div svg {
            width: 42px;
            height: 42px;
            aspect-ratio: 1 / 1;
            padding: 4px;
        }

        .credits {
            font-size: .75rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="https://itecbcn.eu" target="_blank" rel="noopener"><img src="img/ITB_logo.webp" alt="logo ITB" /></a>
            <strong>&lt;Ulises Castell i Carlos Capó&gt;</strong>
        </div>
    </header>

    <main>
        <div class="main-content">
            <div>
                <h1>Continguts del projecte</h1>
        
                <form id="filterForm">
                    <select name="filter" id="filter">
                        <option value="none">-- Selecciona un filtre</option>
                        <option value="folder-filter">No mostrar carpetes</option>
                        <option value="file-filter">No mostrar fitxers</option>
                    </select>
                    <button type="submit">Filtrar</button>
                </form>
            </div>
    
            <nav>
                <?php
                    $dir = opendir("./"); 
                    while ($file = readdir($dir)) {
    
                        if ($file != "index.php" && !str_starts_with($file, ".")) {
                            if (is_dir($file)) {
                                echo "<details name='folder-content' class='folder-filter'>";
                                echo "<summary class='page-card folder'>$file</summary>";
                                echo "<ul>";
                                $subdir = opendir($file);
                                while ($subfile = readdir($subdir)) {
                                    if ($subfile != "." && $subfile != "..") {
                                        echo "<li><a href='./$file/$subfile'>$subfile</a></li>";
                                    }
                                }
                                echo "</ul>";
                                echo "</details>";
                            }
                            else echo "<a href='$file' class='page-card file file-filter'>$file</a>";
                            
                        }
                    } 
                    closedir($dir);    
                    clearstatcache();
                ?>
            </nav>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <small><a href="https://itecbcn.eu" target="_blank" rel="noopener">Institut Tecnològic de Barcelona 2024</a></small>
            <div>
                <span class="credits">Made by <a href="https://carloscapo.com" target="_blank" rel="noopener">@carloscapo</a></span>
                <a href="https://github.com/picuu/itb-php-activity-template/" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 256 250" width="256" height="250" fill="currentColor" preserveAspectRatio="xMidYMid">
                        <path d="M128.001 0C57.317 0 0 57.307 0 128.001c0 56.554 36.676 104.535 87.535 121.46 6.397 1.185 8.746-2.777 8.746-6.158 0-3.052-.12-13.135-.174-23.83-35.61 7.742-43.124-15.103-43.124-15.103-5.823-14.795-14.213-18.73-14.213-18.73-11.613-7.944.876-7.78.876-7.78 12.853.902 19.621 13.19 19.621 13.19 11.417 19.568 29.945 13.911 37.249 10.64 1.149-8.272 4.466-13.92 8.127-17.116-28.431-3.236-58.318-14.212-58.318-63.258 0-13.975 5-25.394 13.188-34.358-1.329-3.224-5.71-16.242 1.24-33.874 0 0 10.749-3.44 35.21 13.121 10.21-2.836 21.16-4.258 32.038-4.307 10.878.049 21.837 1.47 32.066 4.307 24.431-16.56 35.165-13.12 35.165-13.12 6.967 17.63 2.584 30.65 1.255 33.873 8.207 8.964 13.173 20.383 13.173 34.358 0 49.163-29.944 59.988-58.447 63.157 4.591 3.972 8.682 11.762 8.682 23.704 0 17.126-.148 30.91-.148 35.126 0 3.407 2.304 7.398 8.792 6.14C219.37 232.5 256 184.537 256 128.002 256 57.307 198.691 0 128.001 0Zm-80.06 182.34c-.282.636-1.283.827-2.194.39-.929-.417-1.45-1.284-1.15-1.922.276-.655 1.279-.838 2.205-.399.93.418 1.46 1.293 1.139 1.931Zm6.296 5.618c-.61.566-1.804.303-2.614-.591-.837-.892-.994-2.086-.375-2.66.63-.566 1.787-.301 2.626.591.838.903 1 2.088.363 2.66Zm4.32 7.188c-.785.545-2.067.034-2.86-1.104-.784-1.138-.784-2.503.017-3.05.795-.547 2.058-.055 2.861 1.075.782 1.157.782 2.522-.019 3.08Zm7.304 8.325c-.701.774-2.196.566-3.29-.49-1.119-1.032-1.43-2.496-.726-3.27.71-.776 2.213-.558 3.315.49 1.11 1.03 1.45 2.505.701 3.27Zm9.442 2.81c-.31 1.003-1.75 1.459-3.199 1.033-1.448-.439-2.395-1.613-2.103-2.626.301-1.01 1.747-1.484 3.207-1.028 1.446.436 2.396 1.602 2.095 2.622Zm10.744 1.193c.036 1.055-1.193 1.93-2.715 1.95-1.53.034-2.769-.82-2.786-1.86 0-1.065 1.202-1.932 2.733-1.958 1.522-.03 2.768.818 2.768 1.868Zm10.555-.405c.182 1.03-.875 2.088-2.387 2.37-1.485.271-2.861-.365-3.05-1.386-.184-1.056.893-2.114 2.376-2.387 1.514-.263 2.868.356 3.061 1.403Z" />
                    </svg>
                </a>
    
                <a href="https://instagram.com/itecbcn" target="_blank" rel="noopener noreferrer">
                    <svg width="256" height="256" preserveAspectRatio="xMidYMid" viewBox="0 0 256 256">
                        <path fill="#fff" d="M128 23.064c34.177 0 38.225.13 51.722.745 12.48.57 19.258 2.655 23.769 4.408 5.974 2.322 10.238 5.096 14.717 9.575 4.48 4.479 7.253 8.743 9.575 14.717 1.753 4.511 3.838 11.289 4.408 23.768.615 13.498.745 17.546.745 51.723 0 34.178-.13 38.226-.745 51.723-.57 12.48-2.655 19.257-4.408 23.768-2.322 5.974-5.096 10.239-9.575 14.718-4.479 4.479-8.743 7.253-14.717 9.574-4.511 1.753-11.289 3.839-23.769 4.408-13.495.616-17.543.746-51.722.746-34.18 0-38.228-.13-51.723-.746-12.48-.57-19.257-2.655-23.768-4.408-5.974-2.321-10.239-5.095-14.718-9.574-4.479-4.48-7.253-8.744-9.574-14.718-1.753-4.51-3.839-11.288-4.408-23.768-.616-13.497-.746-17.545-.746-51.723 0-34.177.13-38.225.746-51.722.57-12.48 2.655-19.258 4.408-23.769 2.321-5.974 5.095-10.238 9.574-14.717 4.48-4.48 8.744-7.253 14.718-9.575 4.51-1.753 11.288-3.838 23.768-4.408 13.497-.615 17.545-.745 51.723-.745M128 0C93.237 0 88.878.147 75.226.77c-13.625.622-22.93 2.786-31.071 5.95-8.418 3.271-15.556 7.648-22.672 14.764C14.367 28.6 9.991 35.738 6.72 44.155 3.555 52.297 1.392 61.602.77 75.226.147 88.878 0 93.237 0 128c0 34.763.147 39.122.77 52.774.622 13.625 2.785 22.93 5.95 31.071 3.27 8.417 7.647 15.556 14.763 22.672 7.116 7.116 14.254 11.492 22.672 14.763 8.142 3.165 17.446 5.328 31.07 5.95 13.653.623 18.012.77 52.775.77s39.122-.147 52.774-.77c13.624-.622 22.929-2.785 31.07-5.95 8.418-3.27 15.556-7.647 22.672-14.763 7.116-7.116 11.493-14.254 14.764-22.672 3.164-8.142 5.328-17.446 5.95-31.07.623-13.653.77-18.012.77-52.775s-.147-39.122-.77-52.774c-.622-13.624-2.786-22.929-5.95-31.07-3.271-8.418-7.648-15.556-14.764-22.672C227.4 14.368 220.262 9.99 211.845 6.72c-8.142-3.164-17.447-5.328-31.071-5.95C167.122.147 162.763 0 128 0Zm0 62.27C91.698 62.27 62.27 91.7 62.27 128c0 36.302 29.428 65.73 65.73 65.73 36.301 0 65.73-29.428 65.73-65.73 0-36.301-29.429-65.73-65.73-65.73Zm0 108.397c-23.564 0-42.667-19.103-42.667-42.667S104.436 85.333 128 85.333s42.667 19.103 42.667 42.667-19.103 42.667-42.667 42.667Zm83.686-110.994c0 8.484-6.876 15.36-15.36 15.36-8.483 0-15.36-6.876-15.36-15.36 0-8.483 6.877-15.36 15.36-15.36 8.484 0 15.36 6.877 15.36 15.36Z"/>
                    </svg>
                </a>
    
                <a href="https://www.youtube.com/channel/UCoaBtXoia1xR2T3Bb5FRUnQ" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 256 180" width="256" height="180" preserveAspectRatio="xMidYMid">
                        <path d="M250.346 28.075A32.18 32.18 0 0 0 227.69 5.418C207.824 0 127.87 0 127.87 0S47.912.164 28.046 5.582A32.18 32.18 0 0 0 5.39 28.24c-6.009 35.298-8.34 89.084.165 122.97a32.18 32.18 0 0 0 22.656 22.657c19.866 5.418 99.822 5.418 99.822 5.418s79.955 0 99.82-5.418a32.18 32.18 0 0 0 22.657-22.657c6.338-35.348 8.291-89.1-.164-123.134Z" fill="currentColor"/>
                        <path fill="black" d="m102.421 128.06 66.328-38.418-66.328-38.418z"/>
                    </svg>
                </a>
    
                <a href="https://x.com/itecbcn" target="_blank" rel="noopener noreferrer">
                    <svg width="1200" height="1227" fill="none" viewBox="0 0 1200 1227">
                        <path fill="#fff" d="M714.163 519.284 1160.89 0h-105.86L667.137 450.887 357.328 0H0l468.492 681.821L0 1226.37h105.866l409.625-476.152 327.181 476.152H1200L714.137 519.284h.026ZM569.165 687.828l-47.468-67.894-377.686-540.24h162.604l304.797 435.991 47.468 67.894 396.2 566.721H892.476L569.165 687.854v-.026Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    <script>
        const filterForm = document.getElementById("filterForm")
        filterForm.addEventListener("submit", (e) => {
            e.preventDefault()
            resetFilter()

            const filter = document.getElementById("filter").value

            if (filter == "none") return

            const elementsToHide = document.getElementsByClassName(filter)
            for (e of elementsToHide) {
                e.style.display = "none"
            }
        })

        function resetFilter() {
            const folders = document.getElementsByClassName("folder-filter")
            const files = document.getElementsByClassName("file-filter")
            for (e of folders) {
                e.style.display = "flex"
            }
            for (e of files) {
                e.style.display = "flex"
            }
        }
    </script>
</body>
</html>