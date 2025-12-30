
<?php

    //variables
    $directory = '../'; // Replace with the actual directory path
    $gitServerURL = 'http://192.168.1.227:3000/chrisgreen/'; // Replace with your Git server URL
    $githubURL = 'https://github.com/chriscookiegreen/';
    

    $file_headers = array(
        'Name'        => 'Theme Name',
        'ThemeURI'    => 'Theme URI',
        'Description' => 'Description',
        'Author'      => 'Author',
        'AuthorURI'   => 'Author URI',
        'Version'     => 'Version',
        'CreationDate' => 'Creation Date',
    );

    function get_file_data( $file, $default_headers) {

        $fp = fopen( $file, 'r' );
        $file_data = fread( $fp, 8192 );
        fclose( $fp );
        $file_data = str_replace( "\r", "\n", $file_data );
        $all_headers = $default_headers;

        foreach ( $all_headers as $field => $regex ) {
            if (preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) 
                && $match[1])
                $all_headers[ $field ] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
            else
                $all_headers[ $field ] = '';
        }

        return $all_headers;
    }

    
    $entries = scandir($directory);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tailwind CDN Example</title>
        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>  
    </head>
    <body class="dark">

        <nav class="relative bg-gray-800 dark:bg-white">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="h-8 w-auto" />
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
            <a href="#" aria-current="page" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white">Dashboard</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Projects</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button type="button" class="relative rounded-full p-1 text-gray-400 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
            <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
        <button onclick="(() => document.body.classList.toggle('dark'))()"
        class="h-12 w-12 rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="fill-violet-700 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg class="fill-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>
        <!-- Profile dropdown -->
        <el-dropdown class="relative ml-3">
          <button class="relative flex rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">Open user menu</span>
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
          </button>

          <el-menu anchor="bottom end" popover class="w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">Your profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">Sign out</a>
          </el-menu>
        </el-dropdown>
      </div>
    </div>
  </div>

  <el-disclosure id="mobile-menu" hidden class="block sm:hidden">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
      <a href="#" aria-current="page" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Projects</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
    </div>
  </el-disclosure>
</nav>

        <section class="bg-white dark:bg-gray-900">
            <!-- Container -->
            <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-20">
                <!-- Component -->
                <div class="flex flex-col items-center">
                    <h2 class="text-center text-3xl font-bold md:text-5xl text-gray-700 dark:text-white">
                        The latest and greatest news
                    </h2>
                    <p class="mb-8 mt-4 text-center text-sm text-gray-500 sm:text-base md:mb-12 lg:mb-16 text-gray-300 dark:text-white">
                        Lorem ipsum dolor sit amet elit ut aliquam
                    </p>
                    <!-- Content -->
                    <div class="mb-6 grid gap-4 sm:grid-cols-2 sm:justify-items-stretch md:mb-10 md:grid-cols-3 lg:mb-12 lg:gap-6">
                        <?php
                            foreach ($entries as $entry) {
                                if ($entry !== '.' && $entry !== '..' && $entry !== 'System Volume Information') {
                                    $path = $directory . $entry;
                                    if (is_file($path)) {
                                    } elseif (is_dir($path)) {

                                        $data = get_file_data( $path.'/style.css', $file_headers);
                                        ?>
                                        <div class="flex flex-col border border-solid border-gray-300 px-4 py-8 md:p-0">
                                            <img src="<?php echo "{$entry}/screenshot.jpg"; ?>" alt="<?php echo $data['Name']; ?>" class="h-60 object-cover" />
                                            <div class="px-4 py-4">
                                                <p class="mb-2 text-xl font-semibold text-gray-700 dark:text-white">
                                                    <?php echo $data['Name']; ?>
                                                </p>
                                                <p class="mb-2 text-sm text-gray-500 sm:text-base lg:mb-4 text-gray-300 dark:text-white">
                                                    <?php echo $data['Description']; ?>
                                                </p>
                                                <div class="mb-4 flex">
                                                    <img src="https://firebasestorage.googleapis.com/v0/b/flowspark-1f3e0.appspot.com/o/Tailspark%20Images%2FPLaceholder%20Image%20Secondary.svg?alt=media&token=b8276192-19ff-4dd9-8750-80bc5f7d6844" alt="" class="mr-4 h-10 w-10 rounded-full object-cover" />
                                                    <div class="flex flex-col">
                                                        <div class="flex flex-col lg:flex-row">
                                                            <p class="text-sm text-gray-500 dark:text-white">Created: <?php echo $data['CreationDate']; ?></p>
                                                        </div>
                                                        <div class="flex flex-col lg:flex-row">
                                                            <p class="text-sm text-gray-500 dark:text-white">Version: <?php echo $data['Version']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full inline-flex rounded-base shadow-xs -space-x-px" role="group">
                                                    <a href="<?php echo $path; ?>" class="w-1/3 flex items-center justify-center text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-3 focus:ring-neutral-tertiary-soft font-medium leading-5 rounded-s-base text-sm px-3 py-2 focus:outline-none dark:text-white">
                                                        View Site
                                                    </a>
                                                    <a href="<?php echo $gitServerURL. $entry; ?>" target="_blank" class="w-1/3 flex items-center justify-center text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-3 focus:ring-neutral-tertiary-soft font-medium leading-5 rounded-s-base text-sm px-3 py-2 focus:outline-none dark:text-white">
                                                        Gitea
                                                    </a>
                                                    <a href="<?php echo $githubURL. $entry; ?>" target="_blank" class="w-1/3 flex items-center justify-center text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-3 focus:ring-neutral-tertiary-soft font-medium leading-5 rounded-s-base text-sm px-3 py-2 focus:outline-none dark:text-white">
                                                        Github
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </div> 
                </div>
            </div>
        </section>
        <script>
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

    // Change the icons inside the button based on previous settings
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }

    var themeToggleBtn = document.getElementById("theme-toggle");

    themeToggleBtn.addEventListener("click", function () {
        // Toggle icons inside button
        themeToggleDarkIcon.classList.toggle("hidden");
        themeToggleLightIcon.classList.toggle("hidden");

        // If set via local storage previously
        if (localStorage.getItem("color-theme")) {
            if (localStorage.getItem("color-theme") === "light") {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            } else {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            }

        // If NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains("dark")) {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            } else {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            }
        }
    });
</script>
    </body>
</html>