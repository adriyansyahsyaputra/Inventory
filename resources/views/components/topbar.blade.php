<header class="bg-white shadow-sm">
    <div class="flex justify-between items-center p-4">
        <!-- Search Form -->
        <form action="" class="flex flex-1 items-center">
            <div class="relative max-w-md w-full">
                <input type="text" placeholder="Search..."
                    class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:border-teal-500">
                <span class="absolute top-1/2 transform -translate-y-1/2 left-3 text-gray-400 text-lg">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>
        </form>

        <!-- Notifications and User Profile -->
        <div class="flex items-center gap-6 ml-4 relative">
            <!-- Notification Bell -->
            <button class="p-2 rounded-lg hover:bg-teal-100 relative">
                <i class="fa-regular fa-bell text-lg text-gray-600"></i>
                <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border border-white"></span>
            </button>

            <!-- User Profile -->
            <div class="relative">
                @auth
                    <div id="profileMenuToggle"
                        class="flex items-center gap-2 hover:bg-gray-50 p-2 rounded-lg cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=John+Doe" alt="User Avatar"
                            class="w-10 h-10 rounded-full">
                        <div>
                            <h1 class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</h1>
                            <p class="text-xs text-gray-500">{{ auth()->user()->role }}</p>
                        </div>
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="profileDropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-200">
                        <ul class="py-2">
                            <li>
                                <a href="/account" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Account
                                </a>
                            </li>
                            <li class="border-t border-gray-200">
                                <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Login
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Dropdown Toggle Logic
    document.addEventListener("DOMContentLoaded", () => {
        const profileMenuToggle = document.getElementById("profileMenuToggle");
        const profileDropdown = document.getElementById("profileDropdown");

        profileMenuToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle("hidden");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", () => {
            if (!profileDropdown.classList.contains("hidden")) {
                profileDropdown.classList.add("hidden");
            }
        });
    });
</script>
