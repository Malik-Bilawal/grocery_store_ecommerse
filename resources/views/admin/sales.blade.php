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
                        <h2 class="text-xl font-semibold text-gray-800"> Sales Management</h2>
                        <nav class="text-sm text-gray-500 hidden sm:block">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">Sales  Management</span>
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
                        <!-- Messages Table -->
                        <div id="noSaleMessage" class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-percentage text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-700 mb-2">No Active Sale</h3>
                        <p class="text-gray-500 mb-6">There is currently no active sale running. Create a new sale to attract more customers.</p>
                        <button id="addSaleBtn" class="bg-primary hover:bg-emerald-600 text-white px-6 py-3 rounded-lg flex items-center justify-center transition duration-200 mx-auto">
                            <i class="fas fa-plus mr-2"></i>
                            Create New Sale
                        </button>
                    </div>
                </div>

                <!-- Active Sale Display -->
                <div id="activeSaleDisplay" class="hidden">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-primary to-emerald-500 p-6 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 id="saleTitle" class="text-2xl font-bold mb-2">Summer Special Sale</h2>
                                    <p id="saleDescription" class="text-emerald-100">Get amazing discounts on summer fruits and vegetables. Limited time offer!</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button id="editSaleBtn" class="bg-white text-primary hover:bg-gray-100 px-4 py-2 rounded-lg transition duration-200">
                                        <i class="fas fa-edit mr-2"></i>
                                        Edit
                                    </button>
                                    <button id="endSaleBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                                        <i class="fas fa-stop mr-2"></i>
                                        End Sale
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Timer Section -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-lg font-medium text-gray-700 mb-3">Sale Timer</h3>
                                    <div id="saleTimer" class="text-3xl font-bold text-primary text-center">
                                        02:15:36
                                    </div>
                                    <p class="text-gray-500 text-sm text-center mt-2">Time remaining</p>
                                </div>
                                
                                <!-- Sale Details -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-lg font-medium text-gray-700 mb-3">Sale Details</h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Start Date:</span>
                                            <span id="startDate" class="font-medium">2025-10-05 09:00</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">End Date:</span>
                                            <span id="endDate" class="font-medium">2025-10-07 23:59</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Discount:</span>
                                            <span id="discountPercentage" class="font-medium text-primary"></span>
                                        </div>
                                    </div>
                                </div>
                                
                               <!-- Performance Stats -->
                              
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add/Edit Sale Modal -->
    <div id="saleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New Sale</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="mt-4 space-y-4">
                    <div>
                        <label for="saleTitleInput" class="block text-sm font-medium text-gray-700 mb-1">Sale Title</label>
                        <input type="text" id="saleTitleInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Enter sale title">
                    </div>
                    
                    <div>
                        <label for="saleDescriptionInput" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="saleDescriptionInput" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Enter sale description"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="startDateInput" class="block text-sm font-medium text-gray-700 mb-1">Start Date & Time</label>
                            <input type="datetime-local" id="startDateInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                        
                        <div>
                            <label for="endDateInput" class="block text-sm font-medium text-gray-700 mb-1">End Date & Time</label>
                            <input type="datetime-local" id="endDateInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    
                    <div>
                        <label for="discountInput" class="block text-sm font-medium text-gray-700 mb-1">Discount Percentage</label>
                        <div class="relative">
                            <input type="number" id="discountInput" min="1" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Enter discount percentage">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500">%</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Cancel
                        </button>
                        <button type="button" id="saveSaleBtn" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Save Sale
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
document.addEventListener("DOMContentLoaded", function () {
    const addSaleBtn = document.getElementById("addSaleBtn");
    const editSaleBtn = document.getElementById("editSaleBtn");
    const endSaleBtn = document.getElementById("endSaleBtn");

    const saleModal = document.getElementById("saleModal");
    const modalTitle = document.getElementById("modalTitle");
    const closeModal = document.getElementById("closeModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const saveSaleBtn = document.getElementById("saveSaleBtn");

    // Inputs
    const titleInput = document.getElementById("saleTitleInput");
    const descInput = document.getElementById("saleDescriptionInput");
    const startInput = document.getElementById("startDateInput");
    const endInput = document.getElementById("endDateInput");
    const discountInput = document.getElementById("discountInput");

    // Display fields
    const activeSaleDisplay = document.getElementById("activeSaleDisplay");
    const saleTitle = document.getElementById("saleTitle");
    const saleDescription = document.getElementById("saleDescription");
    const startDate = document.getElementById("startDate");
    const endDate = document.getElementById("endDate");
    const discountPercentage = document.getElementById("discountPercentage");
    const saleTimer = document.getElementById("saleTimer");

    let editingSaleId = null;
    let saleData = null;
    let timerInterval = null;


    // Fetch existing active sale when page loads
fetch("{{ route('admin.sales.active') }}")
    .then(res => res.json())
    .then(data => {
        console.log("Fetched active sale:", data);
        if (data.success && data.sale) {
            saleData = data.sale;
            updateSaleDisplay(saleData);
        } else {
            activeSaleDisplay.classList.add("hidden");
        }
    })
    .catch(err => console.error("Failed to load active sale:", err));

    // Open modal for ADD
    addSaleBtn.addEventListener("click", () => {
        editingSaleId = null;
        modalTitle.textContent = "Add New Sale";
        saleModal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
        clearForm();
    });

    // Open modal for EDIT
    if (editSaleBtn) {
        editSaleBtn.addEventListener("click", () => {
            modalTitle.textContent = "Edit Sale";
            saleModal.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
            fillForm(saleData);
        });
    }

    // Close modal
    [closeModal, cancelBtn].forEach(btn => {
        btn.addEventListener("click", () => {
            saleModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        });
    });

    saveSaleBtn.addEventListener("click", async () => {
    console.log("Saving sale... editing:", editingSaleId);

    const payload = {
        name: titleInput.value.trim(),
        description: descInput.value.trim(),
        starts_at: startInput.value,
        ends_at: endInput.value,
        discount_percent: discountInput.value,
    };
    console.log("Payload:", payload);

    const routes = {
    store: "{{ route('admin.sales.store') }}",
    update: "{{ url('admin/sales/update') }}",
    delete: "{{ url('admin/sales/delete') }}"
};

    const url = editingSaleId
    ? `${routes.update}/${editingSaleId}`
    : routes.store;

    const method = editingSaleId ? "PUT" : "POST";
    console.log("Request:", method, url);

    try {
        const res = await fetch(url, {
            method,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload),
        });

        console.log("Response status:", res.status);
        const data = await res.json();
        console.log("Response data:", data);

        if (data.success) {
            saleData = data.sale;
            updateSaleDisplay(data.sale);
            saleModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        } else {
            alert(data.message || "Failed to save sale");
        }
    } catch (err) {
        console.error("Error:", err);
        alert("An error occurred while saving the sale.");
    }
});

    // End Sale button
    if (endSaleBtn) {
        endSaleBtn.addEventListener("click", async () => {
            if (!confirm("Are you sure you want to end this sale?")) return;
            try {
                const res = await fetch(`admin/sales/${saleData.id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await res.json();
                if (data.success) {
                    activeSaleDisplay.classList.add("hidden");
                    saleData = null;
                    clearInterval(timerInterval);
                } else {
                    alert(data.message || "Failed to end sale.");
                }
            } catch (err) {
                console.error(err);
                alert("An error occurred.");
            }
        });
    }

    // Update Active Sale section
    function updateSaleDisplay(sale) {
        activeSaleDisplay.classList.remove("hidden");
        saleTitle.textContent = sale.name;
        saleDescription.textContent = sale.description || "No description";
        startDate.textContent = sale.starts_at || "-";
        endDate.textContent = sale.ends_at || "-";
        discountPercentage.textContent = `${sale.discount_percent}%`;

        if (timerInterval) clearInterval(timerInterval);
        startCountdown(sale.ends_at);
    }

    // Countdown
    function startCountdown(endTime) {
        const end = new Date(endTime).getTime();

        function update() {
            const now = Date.now();
            const diff = end - now;
            if (diff <= 0) {
                saleTimer.textContent = "00:00:00";
                clearInterval(timerInterval);
                return;
            }
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            saleTimer.textContent =
                `${hours.toString().padStart(2, "0")}:${minutes
                    .toString()
                    .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
        }

        update();
        timerInterval = setInterval(update, 1000);
    }

    // Helpers
    function clearForm() {
        titleInput.value = "";
        descInput.value = "";
        startInput.value = "";
        endInput.value = "";
        discountInput.value = "";
    }

    function fillForm(data) {
        titleInput.value = data.name;
        descInput.value = data.description || "";
        startInput.value = data.starts_at?.slice(0, 16) || "";
        endInput.value = data.ends_at?.slice(0, 16) || "";
        discountInput.value = data.discount_percent;
        editingSaleId = data.id;
    }
});
</script>
@endpush