@extends("admin.layouts.master-layouts.plain")

<title>Category | Grocery Store</title>

@push("script")
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#10b981',
                    secondary: '#1f2937'
                }
            }
        }
    }
</script>
@endpush

@push("style")
<style>
  /* Prevent flash before Alpine loads */
  [x-cloak] { display: none !important; }
</style>
@endpush

@section("content")
<!-- Root wrapper with Alpine state -->
<!-- Root wrapper with Alpine state -->
<div 
    x-data="{ sidebarOpen: false }" 
    @close-sidebar.window="sidebarOpen = false" 
    class="flex h-screen overflow-hidden"
>

    <!-- Mobile backdrop -->
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>


    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>

    <!-- Main content wrapper (push right on large screens) -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100">

        <!-- Top Bar -->
        <header class="bg-white shadow-sm z-10">
            <div class="flex justify-between items-center p-4">
                <div class="flex items-center">
                    <!-- Mobile Hamburger -->
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none"
                            aria-label="Open sidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Page Title -->
                    <div class="ml-3">
                        <h2 class="text-xl font-semibold text-gray-800"> Product Management</h2>
                        <nav class="text-sm text-gray-500 hidden sm:block">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">product Management</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <button class="p-2 rounded-full hover:bg-gray-100 relative">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <div class="ml-2 relative">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:inline">Admin</span>
                            <i class="fas fa-chevron-down ml-1 text-gray-500 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
            <!-- Keep the rest of your page contents here (filters, table, modals...) -->
            @yield('admin-content') {{-- or paste the content below this header directly --}}
            

            <section class="px-6 py-4 bg-white shadow-sm mt-1">
    <form method="GET" action="{{ route('admin.products.index') }}">
        <div class="flex flex-wrap items-center gap-4">

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="categoryFilter" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subcategory</label>
                <select name="subcategory_id" id="subcategoryFilter" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Subcategories</option>
                    @if(request('category_id'))
                        @foreach(\App\Models\SubCategory::where('category_id', request('category_id'))->get() as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ request('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Apply Filters -->
            <div class="flex items-end">
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Apply Filters
                </button>
            </div>

            <!-- Reset Filters -->
            <a href="{{ route('admin.products.index') }}" 
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                Reset
            </a>

            <!-- Add Product Button -->
            <a href="{{ route('admin.products.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Add Product
            </a>

        </div>
    </form>
</section>



               <!-- Product Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $index => $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    @if($product->images->where('is_default', 1)->first())
                                        <img src="{{ asset('storage/app/public/' . $product->images->where('is_default', 1)->first()->image_path) }}" class="w-10 h-10 object-cover rounded-lg" alt="{{ $product->name }}">
                                    @else
                                        <i class="fas fa-box text-gray-600"></i>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->subcategory?->name ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->subcategory?->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Rs. {{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->stock }}</div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                @php
                                    $stockPercent = $product->stock > 0 ? min(100, ($product->stock / 100) * 100) : 0;
                                @endphp
                                <div class="bg-green-600 h-1.5 rounded-full" style="width: {{ $stockPercent }}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->status == 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        {{ $products->links() }} <!-- Use Laravel pagination -->
    </div>
</div>
</div>

            </main>

    </div>
</div>
@endsection

@push("script")
<!-- Add Alpine (defer so it doesn't block) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
   document.addEventListener("DOMContentLoaded", () => {

const addModal = document.getElementById("addCategoryModal");
const addBtn = document.getElementById("addCategoryBtn"); 
const cancelAddBtn = document.getElementById("cancelAddBtn");
const closeAddModal = document.getElementById("closeAddModal");

addBtn?.addEventListener("click", () => {
    addModal.classList.remove("hidden");
});

[cancelAddBtn, closeAddModal].forEach(btn => {
    btn?.addEventListener("click", () => {
        addModal.classList.add("hidden");
    });
});

window.addEventListener("click", (e) => {
    if (e.target === addModal) {
        addModal.classList.add("hidden");
    }
});


const editModal = document.getElementById("editCategoryModal");
const closeEditModal = document.getElementById("closeEditModal");
const cancelEditBtn = document.getElementById("cancelEditBtn");
const editButtons = document.querySelectorAll(".edit-category-btn");

editButtons.forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        const id = btn.getAttribute("data-id");
        const name = btn.getAttribute("data-name");
        const desc = btn.getAttribute("data-description");
        const status = btn.getAttribute("data-status");

        document.getElementById("editCategoryName").value = name;
        document.getElementById("editCategoryStatus").value = status;
        document.getElementById("editCategoryDescription").value = desc;


        const form = document.getElementById("editCategoryForm");
        form.action = `/admin/categories/update/${id}`;

        editModal.classList.remove("hidden");
    });
});

// Close Edit Modal
[closeEditModal, cancelEditBtn].forEach(btn => {
    btn?.addEventListener("click", () => {
        editModal.classList.add("hidden");
    });
});

window.addEventListener("click", (e) => {
    if (e.target === editModal) {
        editModal.classList.add("hidden");
    }
});

});
</script>
@endpush