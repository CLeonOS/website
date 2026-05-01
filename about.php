<html>
    <head>
        <title>The CLeonOS offcial website</title>
    </head>
    <body>
        <?php
            include "header.php";
        ?>
        <h1>About</h1>
        <p>Experimental x86_64 operating system project with a C kernel, Rust-assisted runtime pieces, and user-space ELF apps.</p>

        <h2>Highlights:</h2>
        <ul>
            <li>x86_64 kernel booted by Limine</li>
            <li>RAM-disk VFS layout (/system, /shell, /temp, /driver)</li>
            <li>Virtual disk backend with FAT32 format + mount support (default mount path: /temp/disk)</li>
            <li>Virtual TTY subsystem (multi TTY, ANSI handling, cursor, PSF font support)</li>
            <li>Keyboard and mouse input stack, plus desktop mode on TTY2</li>
            <li>User-space ELF app model with syscall ABI (int 0x80)</li>
            <li>User shell with external command apps (ls, cat, grep, mkdir, cp, mv, rm, etc.)</li>
            <li>Pipe and redirection support in user shell (|, >, >>)</li>
            <li>Optional host-side CLeonOS-Wine runner (Python + Unicorn) in wine/</li>
        </ul>
    </body>
</html>
