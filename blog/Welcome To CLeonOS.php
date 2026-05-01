<html>
    <head>
        <title>The CLeonOS offcial website</title>
    </head>
    <body>
        <?php
            include "../header.php";
        ?>

        <h1>CLeonOS</h1>
        
        <h2>Main Text</h2>

        <p>Experimental x86_64 operating system project with a C kernel, Rust-assisted runtime pieces, and user-space ELF apps.</p>

        <h2>Highlights</h2>

        <ul>
            <li>x86_64 kernel booted by Limine</li>
            <li>RAM-disk VFS layout (<code>/system</code>, <code>/shell</code>, <code>/temp</code>, <code>/driver</code>)</li>
            <li>Virtual disk backend with FAT32 format + mount support (default mount path: <code>/temp/disk</code>)</li>
            <li>Virtual TTY subsystem (multi TTY, ANSI handling, cursor, PSF font support)</li>
            <li>Keyboard and mouse input stack, plus desktop mode on TTY2</li>
            <li>User-space ELF app model with syscall ABI (<code>int 0x80</code>)</li>
            <li>User shell with external command apps (<code>ls</code>, <code>cat</code>, <code>grep</code>, <code>mkdir</code>, <code>cp</code>, <code>mv</code>, <code>rm</code>, etc.)</li>
            <li>Pipe and redirection support in user shell (<code>|</code>, <code>&gt;</code>, <code>&gt;&gt;</code>)</li>
            <li>Optional host-side CLeonOS-Wine runner (Python + Unicorn) in <code>wine/</code></li>
        </ul>

        <h2>Repository Layout</h2>

        <pre>
        .
        |- clks/                 # CLKS kernel submodule (standalone kernel repository)
        |- cleonos/              # Userland runtime, libc-like layer, user apps, Rust user library
        |- kit/                  # Standalone user-app SDK (build ELF without kernel source tree)
        |- ramdisk/              # Static files copied into runtime ramdisk
        |- configs/              # Boot configuration (Limine)
        |- bdt/                  # Build Tool source
        |- docs/                 # Stage documents and syscall reference
        |- wine/                 # Host runner for CLeonOS user ELF (no full VM required)
        |- project.bdt           # Main bdt project definition
        |- Makefile              # Developer-friendly wrapper around bdt targets
        </pre>

        <h2>Build Requirements</h2>

        <p>Minimum required tools:</p>

        <ul>
            <li><code>make</code></li>
            <li>host C compiler for bootstrapping <code>bdt</code></li>
            <li><code>git</code></li>
            <li><code>tar</code></li>
            <li><code>xorriso</code></li>
            <li><code>sh</code> (POSIX shell)</li>
            <li><code>rustc</code></li>
            <li>Kernel/user toolchain (resolved automatically with fallback):
                <ul>
                    <li>kernel: <code>gcc</code>/<code>g++</code> + <code>ld</code></li>
                    <li>user: <code>gcc</code> + <code>ld</code></li>
                </ul>
            </li>
        </ul>

        <p>For building Limine from source, install extras such as <code>autoconf</code>, <code>automake</code>, <code>libtool</code>, <code>pkg-config</code>, <code>mtools</code>, and <code>nasm</code>.</p>

        <p>For runtime:</p>

        <ul>
            <li><code>qemu-system-x86_64</code> (for <code>make run</code> / <code>make debug</code>)</li>
        </ul>

        <h2>Quick Start</h2>

        <pre><code>git clone &lt;your-repo-url&gt;
        cd cleonos
        git submodule update --init --recursive
        make run
        </code></pre>

        <p><code>make run</code> now auto-prepares <code>build/x86_64/cleonos_disk.img</code> (if missing) and attaches it as a QEMU emulated physical disk (<code>-drive ... if=ide</code>).
        This disk is <strong>not</strong> packed into the ISO and is <strong>not</strong> loaded through Limine modules.
        Kernel currently uses an in-memory disk cache window (default up to 8MB) for metadata/file operations.
        You can override disk size (MB), for example: <code>make run DISK_IMAGE_MB=128</code>.
        Inside CLeonOS, use <code>diskinfo</code> to confirm the disk is visible.</p>

        <h2>Common Targets</h2>

        <ul>
            <li><code>make setup</code> - check tools and prepare Limine</li>
            <li><code>make kernel</code> - build kernel ELF</li>
            <li><code>make userapps</code> - build user-space ELF apps</li>
            <li><code>make ramdisk</code> - package runtime ramdisk</li>
            <li><code>make disk-image</code> - create/resize runtime disk image (<code>build/x86_64/cleonos_disk.img</code>)</li>
            <li><code>make iso</code> - build bootable ISO</li>
            <li><code>make run</code> - launch QEMU</li>
            <li><code>make debug</code> - launch QEMU with <code>-s -S</code> for GDB</li>
            <li><code>make clean</code> - clean <code>build/x86_64</code></li>
            <li><code>make clean-all</code> - clean all build output</li>
        </ul>

        <h2>Debugging (GDB)</h2>

        <p>Start debug VM:</p>

        <pre><code>make debug
        </code></pre>

        <p>Attach in another terminal:</p>

        <pre><code>gdb build/x86_64/clks_kernel.elf
        (gdb) target remote :1234
        </code></pre>

        <h2>User Shell Examples</h2>

        <pre><code>help
        ls /shell
        cat /shell/init.cmd
        grep -n exec /shell/init.cmd
        cat /shell/init.cmd | grep -n exec
        ls /shell &gt; /temp/shell_list.txt
        diskinfo
        partctl list
        partctl init-mbr
        partctl create 1 2048 32768 0x0C 1
        partctl delete 1
        mkfsfat32 CLEONOS
        mount /temp/disk
        write /temp/disk/hello.txt hello-disk
        </code></pre>

        <h2>Documentation</h2>

        <ul>
            <li>Stage index: <a href="docs/README.md"><code>docs/README.md</code></a></li>
            <li>Syscall ABI reference: <a href="docs/syscall.md"><code>docs/syscall.md</code></a></li>
        </ul>

        <h2>CI</h2>

        <p>GitHub Actions workflow <a href=".github/workflows/build-os.yml"><code>build-os.yml</code></a> builds the OS ISO on push and pull request, and uploads the ISO as an artifact.</p>

        <h2>Contributing</h2>

        <ol>
            <li>Fork and create a feature branch.</li>
            <li>Run at least <code>make iso</code> before opening a PR.</li>
            <li>Include boot log snippets or screenshots for kernel/user visible changes.</li>
        </ol>

        <h2>License</h2>

        <p>Apache-2.0. See <a href="License"><code>License</code></a>.</p>

        <p></p>
        <p></p>

        <p>This article was copied from Github</p>

        <h2>Maintainer of This Update</h2>
        <p>@<a href="../dev/leonmmcoset.php">Leonmmcoset</a>| Developer</p>
        <p>@<a href="../dev/jgzyes.php">JGZ_YES</a>| Moving article & Edit</p>
    </body>
</html>
