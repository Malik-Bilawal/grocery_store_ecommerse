<div class="h-full flex flex-col">
  <div class="p-4 border-b border-gray-700">
      <h1 class="text-xl font-bold flex items-center">
          <i class="fas fa-store mr-2 text-secondary"></i>
          GroceryStore Admin
      </h1>

      <button 
        @click="$dispatch('close-sidebar')" 
        class="lg:hidden text-gray-400 hover:text-white text-xl focus:outline-none"
        aria-label="Close sidebar">
        <i class="fas fa-times"></i>
    </button>
  </div>
  <nav class="flex-1 p-4 overflow-y-auto">
  <ul class="space-y-2 text-sm">


<li>
    <a href="{{ route('admin.products.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.products.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-shopping-basket mr-3"></i>
        Products
    </a>
</li>

<li>
    <a href="{{ route('admin.categories.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.categories.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-tags mr-3"></i>
        Categories
    </a>
</li>

<li>
    <a href="{{ route('admin.subcategories.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.subcategories.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-users mr-3"></i>
        Sub Categories
    </a>
</li>

<li>
    <a href="{{ route('admin.users.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.users.*') ? 'bg-green-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-user mr-3"></i>
        Users
    </a>
</li>

<li>
    <a href="{{ route('admin.sliders.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.sliders.*') ? 'bg-green-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-sliders-h mr-3"></i>
        Sliders
    </a>
</li>

<li>
    <a href="{{ route('admin.sales.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.sales.*') ? 'bg-green-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-sliders-h mr-3"></i>
        Sales
    </a>
</li>


<li>
    <a href="{{ route('admin.contact.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.contact.*') ? 'bg-green-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-sliders-h mr-3"></i>
        Contacts
    </a>
</li>

<li>
    <a href="{{ route('admin.orders.index') }}"
       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.orders.*') ? 'bg-green-600 text-white' : 'hover:bg-gray-700' }}">
        <i class="fas fa-shopping-cart mr-3"></i>
        Orders
    </a>
</li>


                </ul>
            </nav>
            
            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Admin User</p>
                        <p class="text-xs text-gray-400">admin@grocerystationone.com</p>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button 
    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 ease-in-out"
>Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Category Management</h2>
                        <nav class="text-sm text-gray-500">
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
                    <div class="p-4 border-t border-gray-700">
      <div class="flex items-center">
          <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
              <i class="fas fa-user"></i>
          </div>
          <div class="ml-3">
              <p class="text-sm font-medium">Admin User</p>
              <p class="text-xs text-gray-400">admin@grocerystationone.com.com</p>
          </div>
      </div>
  </div>
</div>
                </div>
            </header>