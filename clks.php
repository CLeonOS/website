<html>
    <head>
        <title>The CLeonOS offcial website</title>
    </head>
    <body>
        <?php
            include "header.php";
        ?>
        <h1>CLKS</h1>
        <p>CLKS is the standalone kernel repository used by CLeonOS. It contains architecture startup code, interrupt handling, memory management, scheduler, syscall/runtime layers, storage, TTY/console, and kernel support libraries.</p>
        <hr>
        <h2>Versions</h2>
        <ul>
            <?php
            $versionDir = __DIR__ . '/clks/version';
            $files = glob($versionDir . '/*.php');
            $versions = array();
            foreach ($files as $file) {
                $versions[] = basename($file, '.php');
            }
            usort($versions, 'version_compare');
            $versions = array_reverse($versions);
            foreach ($versions as $version) {
                echo '<li><a href="/clks/version/' . $version . '.php">' . $version . '</a></li>';
            }
            ?>
        </ul>
    </body>
</html>
