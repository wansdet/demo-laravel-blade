<form action="/blog/my-posts">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
               placeholder="Search Blog posts..." />
        <div class="absolute -top-4 right-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-s mt-7 mb-5 py-1 px-4 rounded">
                Search
            </button>
        </div>
    </div>
</form>
