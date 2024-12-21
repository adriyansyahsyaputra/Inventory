<aside class="min-h-screen flex">
    <div class="fixed top-0 left-0 h-screen bg-white shadow-md w-56 flex flex-col z-20">
        <div class="p-4 border-b">
            <h1 class="font-bold text-xl text-teal-500">Dashboard</h1>
        </div>

        <nav class="p-4">
            <div class="mb-4">
                <a href="/" class="block py-2 px-4 text-gray-900 rounded hover:font-medium hover:bg-teal-100">
                    <i class="fa-solid fa-table-columns mr-2 text-xl"></i>Dashboard
                </a>
            </div>

            <!-- Menu Products with Dropdown -->
            <div class="mb-4">
                <div class="flex justify-between items-center py-2 px-4 text-gray-900 rounded hover:font-medium hover:bg-teal-100 cursor-pointer dropdown-toggle" data-dropdown="products">
                    <span><i class="fa-solid fa-bag-shopping mr-2 text-lg"></i>Products</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="hidden dropdown-menu" id="products">
                    <a href="/table-product" class="block py-2 px-8 text-gray-700 hover:bg-teal-50 text-sm"><i class="fa-solid fa-table mr-2"></i>Table Product</a>
                    <a href="/add-product" class="block py-2 px-8 text-gray-700 hover:bg-teal-50 text-sm"><i class="fa-solid fa-plus mr-2"></i>New Product</a>
                </div>
            </div>

            <!-- Menu Users with Dropdown -->
            <div class="mb-4">
                <div class="flex justify-between items-center py-2 px-4 text-gray-900 rounded hover:font-medium hover:bg-teal-100 cursor-pointer dropdown-toggle" data-dropdown="users">
                    <span><i class="fa-solid fa-user mr-2 text-lg"></i>Users</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="hidden dropdown-menu" id="users">
                    <a href="/table-user" class="block py-2 px-8 text-gray-700 hover:bg-teal-50 text-sm"><i class="fa-solid fa-list mr-2"></i>List User</a>
                    <a href="/add-user" class="block py-2 px-8 text-gray-700 hover:bg-teal-50 text-sm"><i class="fa-solid fa-plus mr-2"></i>New User</a>
                </div>
            </div>

            <div class="mb-4">
                <a href="/" class="block py-2 px-4 text-gray-900 rounded hover:font-medium hover:bg-teal-100">
                    <i class="fa-solid fa-chart-line mr-2 text-lg"></i>Log Product
                </a>
            </div>
            <div class="mb-4">
                <a href="/" class="block py-2 px-4 text-gray-900 rounded hover:font-medium hover:bg-teal-100">
                    <i class="fa-solid fa-book mr-2 text-lg"></i>Reports
                </a>
            </div>
        </nav>
    </div>
</aside>