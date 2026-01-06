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
                        <h2 class="text-xl font-semibold text-gray-800">Sliders Management</h2>
                        <nav class="text-sm text-gray-500 hidden sm:block">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">Sliders  Management</span>
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
            @yield('admin-content') 
            <div class="flex justify-center space-x-2">
    <button 
        id="addSliderBtn" 
        class="bg-primary hover:bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center justify-center transition duration-200"
    >
        <i class="fas fa-plus mr-2"></i>
        Add Slider
    </button>
</div>

        
                <!-- Sliders Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
    @forelse ($sliders as $index => $slider)
        <tr class="hover:bg-gray-50">
            <!-- ID -->
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $index + 1 }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
    <div class="w-20 h-12 rounded-md overflow-hidden bg-gray-200 flex items-center justify-center">
        @if ($slider->image)
            <img src="{{ asset('storage/app/public/' . $slider->image) }}" 
                 alt="Slider Image" 
                 class="object-cover w-full h-full">
        @else
            <i class="fas fa-image text-gray-400"></i>
        @endif
    </div>
</td>



            <!-- Position (optional) -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $slider->id }}
            </td>

            <!-- Status -->
            <td class="px-6 py-4 whitespace-nowrap">
                @if ($slider->status)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Inactive
                    </span>
                @endif
            </td>

            <!-- Created At -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $slider->created_at->format('Y-m-d') }}
            </td>

            <!-- Actions -->
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <!-- Edit Button -->
                <button 
    type="button"
    class="text-indigo-600 hover:text-indigo-900 mr-3 edit-slider-btn"
    data-id="{{ $slider->id }}"
    data-button_url="{{ $slider->button_url }}"
    data-status="{{ $slider->status }}"
    data-image="{{ $slider->image ? asset('storage/app/public/'.$slider->image) : '' }}"
>
    <i class="fas fa-edit"></i>
</button>


<form action="{{ route('admin.hero-sliders.destroy', $slider->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900"
        onclick="return confirm('Are you sure you want to delete this slider?')">
        <i class="fas fa-trash"></i>
    </button>
</form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center py-6 text-gray-500">No sliders found</td>
        </tr>
    @endforelse
</tbody>

                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">1</span>
                                    to
                                    <span class="font-medium">3</span>
                                    of
                                    <span class="font-medium">3</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 3 </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Preview Section -->
               
                </div>
            </main>
        </div>
    </div>

    <!-- Add/ Slider Modal -->
    <div id="addSliderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New Slider</h3>
                    <button  id="addCloseModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form action="{{ route('admin.hero-sliders.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form Inputs -->
        <div class="space-y-4">
           

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="sliderPosition" class="block text-sm font-medium text-gray-700">Position</label>
                    <input 
                        type="number" 
                        id="sliderPosition" 
                        name="position"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                        min="1" max="10">
                </div>

                <div>
                    <label for="sliderStatus" class="block text-sm font-medium text-gray-700">Status</label>
                    <select 
                        id="sliderStatus" 
                        name="status"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="buttonLink" class="block text-sm font-medium text-gray-700">Button Link</label>
                <input 
                    type="text" 
                    id="buttonLink" 
                    name="button_url"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                    placeholder="e.g. /products">
            </div>
        </div>

        <!-- Image Upload -->
        <div>
            <label for="sliderImage" class="block text-sm font-medium text-gray-700">Slider Image</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
                    <div class="flex text-sm text-gray-600">
                        <label for="sliderImage" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-emerald-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                            <span>Upload a file</span>
                            <input id="sliderImage" name="image" type="file" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>

            <!-- Preview Image -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                <div class="w-full h-40 bg-gray-200 rounded-md flex items-center justify-center">
                    <i class="fas fa-image text-gray-400 text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <button type="button" id="addCancelBtn" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Save Slider
        </button>
    </div>
</form>

            </div>
        </div>
    </div>

   <!-- Edit Slider Modal -->
<div id="editSliderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Edit Slider</h3>
                <button type="button" id="editCloseModal" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editSliderForm" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <input type="hidden" id="editSliderId" name="id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Inputs -->
                    <div class="space-y-4">
                    

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="editSliderStatus"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

             

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Link</label>
                            <input type="text" name="button_url" id="editButtonLink"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slider Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="sliderImage" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-emerald-500">
                                        <span>Upload a file</span>
                                        <input id="sliderImage" name="image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 10MB</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                            <div id="sliderImagePreview" class="w-full h-40 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
                                <i class="fas fa-image text-gray-400 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button"id="editCancelBtn"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-emerald-600">
                        Update Slider
                    </button>
                </div>
            </form>
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

document.addEventListener('DOMContentLoaded', function () {

/* -----------------------------
   ADD SLIDER MODAL FUNCTIONALITY
----------------------------- */
const addSliderBtn = document.getElementById('addSliderBtn');
const addSliderModal = document.getElementById('addSliderModal');
const addCloseBtn = document.getElementById('addCloseModal');
const addCancelBtn = document.getElementById('addCancelBtn');

const openAddModal = () => {
    addSliderModal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
};

const closeAddModal = () => {
    addSliderModal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
};

if (addSliderBtn) addSliderBtn.addEventListener('click', openAddModal);
if (addCloseBtn) addCloseBtn.addEventListener('click', closeAddModal);
if (addCancelBtn) addCancelBtn.addEventListener('click', closeAddModal);

addSliderModal?.addEventListener('click', (e) => {
    if (e.target === addSliderModal) closeAddModal();
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !addSliderModal.classList.contains('hidden')) closeAddModal();
});


/* -----------------------------
   EDIT SLIDER MODAL FUNCTIONALITY
----------------------------- */
const editButtons = document.querySelectorAll('.edit-slider-btn');
const editModal = document.getElementById('editSliderModal');
const editCloseBtn = document.getElementById('editCloseModal');
const editCancelBtn = document.getElementById('editCancelBtn');
const editPreview = document.getElementById('sliderImagePreview');
const editForm = document.getElementById('editSliderForm');

editButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const buttonUrl = btn.dataset.buttonUrl || btn.dataset.button_url;
        const status = btn.dataset.status;
        const image = btn.dataset.image;

        // Fill form fields
        editForm.action = `/admin/hero-sliders/update/${id}`;
        document.getElementById('editButtonLink').value = buttonUrl || '';
        document.getElementById('editSliderStatus').value = String(status ?? '0');

        // Image preview
        if (image) {
            editPreview.innerHTML = `<img src="${image}" class="object-cover h-full w-full rounded-md" />`;
        } else {
            editPreview.innerHTML = `<i class="fas fa-image text-gray-400 text-3xl"></i>`;
        }

        editModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
});

[editCloseBtn, editCancelBtn].forEach(btn => {
    btn?.addEventListener('click', () => {
        editModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
});

editModal?.addEventListener('click', (e) => {
    if (e.target === editModal) {
        editModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
});
});
</script>
@endpush