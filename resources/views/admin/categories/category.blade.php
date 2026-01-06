@extends("admin.layouts.master-layouts.plain")

<title>Category | Grocery station One</title>

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
                        <h2 class="text-xl font-semibold text-gray-800"> Category Management</h2>
                        <nav class="text-sm text-gray-500 hidden sm:block">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">Category Management</span>
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
    <form method="GET" action="{{ route('admin.categories.index') }}">
        <div class="flex flex-wrap items-center gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Apply Filters
                </button>
            </div>

            <a href="{{ route('admin.categories.index') }}" 
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                Reset
            </a>

            <button 
                id="addCategoryBtn"
                type="button"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Add Category
            </button>
        </div>
    </form>
</section>



                <!-- Category Table -->
      <!-- Category Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($categories as $index => $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tags text-primary"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::limit($category->description, 40) }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{-- Optional: show product count if relation exists --}}
                            {{ $category->products_count ?? 0 }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($category->status == 1)
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $category->created_at->format('Y-m-d') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <!-- Edit Button -->
                            <button 
                                class="text-indigo-600 hover:text-indigo-900 mr-3 edit-category-btn"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}"
                                data-description="{{ $category->description }}"
                                data-status="{{ $category->status }}"
                            >
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        {{ $categories->links() }}
    </div>
</div>

            </main>
        </div>
    </div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-10 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex justify-between items-center pb-3 border-b">
        <h3 class="text-lg font-medium text-gray-900">Add New Category</h3>
        <button id="closeAddModal" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
      @csrf
        <div>
          <label for="addCategoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
          <input type="text" id="addCategoryName" name="name"
                 class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary" required>
        </div>

        <div>
          <label for="addCategoryDescription" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="addCategoryDescription" name="description"
                    class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary"
                    rows="3" placeholder="Enter category description..."></textarea>
        </div>

        <div>
          <label for="addCategoryStatus" class="block text-sm font-medium text-gray-700">Status</label>
          <select id="addCategoryStatus" name="status"
                  class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>

        <div>
        <label for="addCategoryImage" class="block text-sm font-medium text-gray-700">Category Image</label>
        <input type="file" id="addCategoryImage" name="image"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary"
               accept="image/*">
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <button type="button" id="cancelAddBtn" class="px-4 py-2 border border-gray-300 rounded-md bg-white hover:bg-gray-50 text-sm">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-emerald-600">
            Save Category
        </button>
    </div>
</form>
    </div>
  </div>
</div>


<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-10 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex justify-between items-center pb-3 border-b">
        <h3 class="text-lg font-medium text-gray-900">Edit Category</h3>
        <button id="closeEditModal" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form method="POST" id="editCategoryForm" enctype="multipart/form-data" class="mt-4 space-y-4">
    @csrf
        @method('POST')
        <div>
          <label for="editCategoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
          <input type="text" id="editCategoryName" name="name"
                 class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary" required>
        </div>

        <div>
          <label for="editCategoryDescription" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="editCategoryDescription" name="description"
                    class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary"
                    rows="3" placeholder="Enter category description..."></textarea>
        </div>

        <div>
          <label for="editCategoryStatus" class="block text-sm font-medium text-gray-700">Status</label>
          <select id="editCategoryStatus" name="status"
                  class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>

        <div>
        <label for="editCategoryImage" class="block text-sm font-medium text-gray-700">Category Image</label>
        <input type="file" id="editCategoryImage" name="image"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-primary focus:border-primary"
               accept="image/*">
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <button type="button" id="cancelEditBtn" class="px-4 py-2 border border-gray-300 rounded-md bg-white hover:bg-gray-50 text-sm">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-emerald-600">
            Update Category
        </button>
    </div>
</form>
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