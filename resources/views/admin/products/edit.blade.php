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

      

        <!-- Main -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
            <!-- Keep the rest of your page contents here (filters, table, modals...) -->
            @yield('admin-content') {{-- or paste the content below this header directly --}}
            

            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Product Info</h2>
                <form id="product-form" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2" placeholder="Enter name" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full border rounded px-3 py-2" placeholder="SKU">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category *</label>
                            <select name="category_id" id="category" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Subcategory</label>
                            <select name="subcategory_id" id="subcategory" class="w-full border rounded px-3 py-2">
                                <option value="">Select Subcategory</option>
                                @foreach($product->category?->subcategories ?? [] as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price ($) *</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2" step="0.01" min="0" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock Quantity *</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-3 py-2" min="0" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rating</label>
                            <input type="number" name="rating" value="{{ old('rating', $product->rating) }}" class="w-full border rounded px-3 py-2" min="0" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
<input type="string" name="weight" value="{{ old('weight', $product->weight ?? 1) }}" class="w-full border rounded px-3 py-2" step="0.01">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="w-full border rounded px-3 py-2">
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- ===== SIZES & PRICES ===== -->
                    <div class="bg-white shadow rounded-xl p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Sizes & Prices</h2>
    <div id="sizesContainer" class="space-y-2"></div>
    <button type="button" onclick="addSize()" 
        class="px-4 py-2 bg-primary text-white rounded hover:bg-emerald-600">
        + Add Size
    </button>
</div>


                    <!-- ===== IMAGES ===== -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Images</h2>

                        <!-- Main Image -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                            <input type="file" name="main_image" id="main-image" class="hidden" accept="image/*">
                            <div id="main-image-preview" class="cursor-pointer">
                                @if($product->images->where('is_default', 1)->first())
                                    <div class="relative">
                                        <img src="{{ asset('storage/app/public/' . $product->images->where('is_default', 1)->first()->image_path) }}" class="w-full h-48 object-cover rounded-lg">
                                        <button type="button" onclick="removeMainImage()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center h-48 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary transition duration-200" onclick="document.getElementById('main-image').click()">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">Upload main product image</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Additional Images</label>
    <input type="file" id="additional-images" class="hidden" accept="image/*" multiple name="additional_images[]">
    <div id="additional-preview" class="flex gap-2 flex-wrap cursor-pointer">
        @foreach($product->images->where('is_default', 0) as $img)
            <div class="relative w-24 h-24">
                <img src="{{ asset('storage/app/public/' . $img->image_path) }}" class="w-full h-full object-cover rounded-lg">
                <button type="button" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center" onclick="removeExistingImage(this, '{{ $img->id }}')">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
        @endforeach
        <div class="w-24 h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center hover:border-primary" onclick="document.getElementById('additional-images').click()">
            <i class="fas fa-plus text-gray-400"></i>
        </div>
    </div>
</div>

<!-- Hidden input to track images to delete -->
<div id="deleted-images-container"></div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded hover:bg-emerald-600">Update Product</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>


@endsection

@push("script")
<!-- Add Alpine (defer so it doesn't block) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
   
   let sizeIndex = 0;

window.addSize = function(size = '') {
    const container = document.getElementById('sizesContainer');
    const html = `
        <div class="flex gap-2 items-center mb-2">
            <input type="number" 
                   name="sizes[${sizeIndex}][size]" 
                   placeholder="Size in kg e.g. 0.25" 
                   class="border px-2 py-1 rounded w-1/3 size-input" 
                   step="0.01" 
                   value="${size}" 
                   required>

            <input type="number" 
                   name="sizes[${sizeIndex}][price]" 
                   class="border px-2 py-1 rounded w-1/3 bg-gray-100 price-input" 
                   placeholder="Auto price" 
                   readonly>

            <button type="button" 
                    onclick="removeSize(this)" 
                    class="text-red-500 font-bold px-2">
                X
            </button>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    sizeIndex++;
    attachRecalcHandlers();
    recalcPrices();
};

window.removeSize = function(el){
    el.parentElement.remove();
    recalcPrices();
};

function recalcPrices() {
    const defaultPrice = parseFloat(document.querySelector('input[name="price"]')?.value) || 0;
    const defaultWeight = parseFloat(document.querySelector('input[name="weight"]')?.value) || 1;

    document.querySelectorAll('#sizesContainer .size-input').forEach((input) => {
        const size = parseFloat(input.value) || 0;
        const priceInput = input.parentElement.querySelector('.price-input');
        const calculatedPrice = (defaultPrice / defaultWeight) * size;
        priceInput.value = calculatedPrice ? calculatedPrice.toFixed(2) : '';
    });
}

function attachRecalcHandlers() {
    document.querySelectorAll('.size-input').forEach(input => {
        input.removeEventListener('input', recalcPrices);
        input.addEventListener('input', recalcPrices);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    @foreach($product->sizes as $size)
        addSize('{{ $size->size }}');
    @endforeach

    attachRecalcHandlers();

    // Recalculate whenever main price or weight changes
    document.querySelector('input[name="price"]').addEventListener('input', recalcPrices);
    document.querySelector('input[name="weight"]').addEventListener('input', recalcPrices);
});



document.getElementById('product-form').addEventListener('submit', function(e) {
    const defaultPrice = parseFloat(document.querySelector('input[name="price"]').value); // price per default weight
    const defaultWeight = parseFloat(document.querySelector('input[name="weight"]').value) || 1;
    const sizeRows = document.querySelectorAll('#sizesContainer div');

    sizeRows.forEach((row, index) => {
        const sizeInput = row.querySelector('input[name^="sizes"][name$="[size]"]');
        const sizeValue = parseFloat(sizeInput.value);

        const calculatedPrice = (defaultPrice / defaultWeight) * sizeValue;

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = `sizes[${index}][price]`;
        hiddenInput.value = calculatedPrice.toFixed(2);
        row.appendChild(hiddenInput);
    });
});


    function removeMainImage(){
        document.getElementById('main-image-preview').innerHTML = `
            <div class="flex flex-col items-center justify-center h-48 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary cursor-pointer" onclick="document.getElementById('main-image').click()">
                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500">Upload main product image</p>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP up to 5MB</p>
            </div>`;
        document.getElementById('main-image').value = '';
    }
    const additionalInput = document.getElementById('additional-images');
    const additionalPreview = document.getElementById('additional-preview');
    const deletedImagesContainer = document.getElementById('deleted-images-container');

    let filesArray = [];

    additionalInput.addEventListener('change', function(e) {
        Array.from(e.target.files).forEach(file => {
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);

                const reader = new FileReader();
                reader.onload = function(ev) {
                    const div = document.createElement('div');
                    div.className = "relative w-24 h-24";
                    div.innerHTML = `
                        <img src="${ev.target.result}" class="w-full h-full object-cover rounded-lg">
                        <button type="button" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center" onclick="removeNewImage(this, '${file.name}')">
                            <i class="fas fa-times text-xs"></i>
                        </button>`;
                    additionalPreview.insertBefore(div, additionalPreview.lastElementChild);
                }
                reader.readAsDataURL(file);
            }
        });

        const dt = new DataTransfer();
        filesArray.forEach(f => dt.items.add(f));
        additionalInput.files = dt.files;
    });

    window.removeNewImage = function(el, filename) {
        el.parentElement.remove();
        filesArray = filesArray.filter(f => f.name !== filename);

        const dt = new DataTransfer();
        filesArray.forEach(f => dt.items.add(f));
        additionalInput.files = dt.files;
    }

    window.removeExistingImage = function(el, id) {
        el.parentElement.remove();
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deleted_images[]';
        input.value = id;
        deletedImagesContainer.appendChild(input);
    }

    $(document).ready(function() {
    var selectedCategory = "{{ $product->category_id }}";
    var selectedSubcategory = "{{ $product->subcategory_id }}";

    if(selectedCategory) {
        $.ajax({
            url: '/admin/get-subcategories/' + selectedCategory,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const subcatSelect = $('#subcategory');
                subcatSelect.html('<option value="">Select Subcategory</option>');

                $.each(data, function(key, subcategory) {
                    const selected = subcategory.id == selectedSubcategory ? 'selected' : '';
                    subcatSelect.append('<option value="'+subcategory.id+'" '+selected+'>'+subcategory.name+'</option>');
                });
            }
        });
    }

    $('#category').on('change', function() {
        var categoryId = $(this).val();
        $('#subcategory').html('<option>Loading...</option>');

        if(categoryId) {
            $.ajax({
                url: '/admin/get-subcategories/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const subcatSelect = $('#subcategory');
                    subcatSelect.html('<option value="">Select Subcategory</option>');
                    $.each(data, function(key, subcategory) {
                        subcatSelect.append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                    });
                },
                error: function() {
                    $('#subcategory').html('<option value="">Error loading subcategories</option>');
                }
            });
        } else {
            $('#subcategory').html('<option value="">Select Subcategory</option>');
        }
    });
});

</script>
@endpush