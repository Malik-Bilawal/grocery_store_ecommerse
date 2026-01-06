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
            <section class="px-6 py-4 bg-white shadow-sm mt-1">
    <form method="GET" action="{{ route('admin.users.index') }}">
        <div class="flex flex-wrap items-center gap-4">

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="blockd" {{ request('status') == 'inactive' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>

          

            <!-- Subcategory Filter -->
            

            <!-- Apply Filters -->
            <div class="flex items-end">
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Apply Filters
                </button>
            </div>

            <!-- Reset Filters -->
            <a href="{{ route('admin.users.index') }}" 
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                Reset
            </a>

            <!-- Add Product Button -->
            <button type="button" id="addUserBtn"
               class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Add User
    </button>

        </div>
    </form>
</section>


                <!-- User Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
    @foreach ($users as $index => $user)
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $users->firstItem() + $index }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </div>
                </div>
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ ucfirst($user->role ?? 'Customer') }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
                @if ($user->status === 'active')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Blocked
                    </span>
                @endif
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $user->last_login ?? 'N/A' }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                @if ($user->status === 'active')
                    <form action="{{ route('admin.users.toggleStatus', $user) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-yellow-600 hover:text-yellow-900 mr-3">
                            <i class="fas fa-ban"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.users.toggleStatus', $user) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                @endif

                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
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
                                    <span class="font-medium">5</span>
                                    of
                                    <span class="font-medium">24</span>
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
            </main>
        </div>
    </div>
    </div>

       <!-- Add User Modal -->
       <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New User</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form  method="post" action="{{ route('admin.users.store') }}"class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label for="userName" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="userName" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div>
                        <label for="userEmail" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="userEmail" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div>
                        <label for="userPassword" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="userPassword" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Save User
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

const modal = document.getElementById('userModal');
        const confirmModal = document.getElementById('confirmModal');
        const addUserBtn = document.getElementById('addUserBtn');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const modalTitle = document.getElementById('modalTitle');
        const confirmCancel = document.getElementById('confirmCancel');
        const confirmAction = document.getElementById('confirmAction');
        const confirmModalTitle = document.getElementById('confirmModalTitle');
        const confirmModalMessage = document.getElementById('confirmModalMessage');
        
        // Block/Unblock buttons
        const blockButtons = document.querySelectorAll('.block-user-btn');
        const unblockButtons = document.querySelectorAll('.unblock-user-btn');
        const deleteButtons = document.querySelectorAll('.delete-user-btn');
        
        let currentAction = null;
        let currentUserId = null;

        // Open modal for adding user
        addUserBtn.addEventListener('click', () => {
            modalTitle.textContent = 'Add New User';
            modal.classList.remove('hidden');
        });

        // Close modal
        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
            if (event.target === confirmModal) {
                confirmModal.classList.add('hidden');
            }
        });
</script>
@endpush