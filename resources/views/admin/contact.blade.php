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
  [x-cloak] { display: none !important; }
</style>
@endpush

@section("content")


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
                        <h2 class="text-xl font-semibold text-gray-800"> Contact Message Management</h2>
                        <nav class="text-sm text-gray-500 hidden sm:block">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">Contact  Management</span>
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
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sender
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subject
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Message
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($messages as $message)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $message->first_name }} {{ $message->last_name}}</div>
                                            <div class="text-sm text-gray-500">{{ $message->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::limit($message->subject, 50) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 max-w-xs truncate">
                                        {{ Str::limit($message->message, 70) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $message->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($message->is_read)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Read
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Unread
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          
                                    
                                    <form action="{{ route('admin.contact.destroy', $message->id) }}"  class="inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this message?')" title="Delete Message">
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
                        
                        </div>
                        <div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Message Detail Modal -->
<div id="messageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Message Details</h3>
                <button id="closeMessageModal" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="mt-4 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">From</label>
                        <p class="mt-1 text-sm text-gray-900" id="modalSenderName"></p>
                        <p class="text-sm text-gray-500" id="modalSenderEmail"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <p class="mt-1 text-sm text-gray-900" id="modalDate"></p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subject</label>
                    <p class="mt-1 text-sm text-gray-900" id="modalSubject"></p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-700 whitespace-pre-wrap" id="modalMessage"></p>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button id="closeModalBtn" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Close
                    </button>
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
   const messageModal = document.getElementById('messageModal');
    const closeMessageModal = document.getElementById('closeMessageModal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    function openMessageModal(message) {
        document.getElementById('modalSenderName').textContent = message.name;
        document.getElementById('modalSenderEmail').textContent = message.email;
        document.getElementById('modalDate').textContent = message.date;
        document.getElementById('modalSubject').textContent = message.subject;
        document.getElementById('modalMessage').textContent = message.fullMessage;
        
        messageModal.classList.remove('hidden');
    }

    // Close modal functions
    closeMessageModal.addEventListener('click', () => {
        messageModal.classList.add('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        messageModal.classList.add('hidden');
    });

    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === messageModal) {
            messageModal.classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('click', function() {

                const cells = this.cells;
                const messageData = {
                    name: cells[0].querySelector('.text-sm.font-medium').textContent,
                    email: cells[0].querySelector('.text-sm.text-gray-500').textContent,
                    subject: cells[1].textContent.trim(),
                    date: cells[3].textContent.trim(),
                    fullMessage: "This is the full message content that would be loaded from your database. In a real implementation, you would fetch the complete message content via AJAX or have it preloaded in a data attribute."
                };
                openMessageModal(messageData);
            });
        });
    });
</script>
@endpush