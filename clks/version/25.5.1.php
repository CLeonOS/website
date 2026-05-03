<html>
    <head>
        <title>The CLeonOS offcial website</title>
    </head>
    <body>
        <?php
            include "../../header.php";
        ?>
        <h1>CLKS 26.5.1</h1>

        <h2>Update Details</h2>
        <ul>
            <li>Dynamic heap allocation (seems to have some issues)</li>
            <li>Removed the restriction that "writing to directories other than /temp is not allowed"</li>
            <li>Added support for changing TTY font size</li>
            <li>Split up some large code files</li>
            <li>Fixed an issue where input (e.g., keyboard or mouse input) during system boot prevented further input after the system had booted</li>
            <li>Made some optimizations to CPU logic</li>
            <li>Enhanced application runtime security</li>
            <li>Added support for booting the operating system from a disk (BIOS only)</li>
            <li>Added support for multi-user systems</li>
            <li>Added several disk-related syscalls</li>
        </ul>

        <h2>Maintainer of This Update</h2>
        <p>@<a href="../dev/leonmmcoset.php">Leonmmcoset</a>| Developer</p>

        <h2>Additional Notes</h2>
        <p>For general users: This update contains numerous major changes. Do not update lightly, as it may cause the distribution to malfunction or fail to boot properly. Please proceed with caution.</p>
        <p>For downstream branch developers: Please carefully review all commits from version 26.5.0 to 26.5.1 (<a href="https://github.com/CLeonOS/clks/compare/26.5.0...26.5.1">https://github.com/CLeonOS/clks/compare/26.5.0...26.5.1</a>) before updating the upstream clks repository to prevent any explicit or implicit bugs or errors caused by the update.</p>
    </body>
</html>