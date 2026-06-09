<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Halal Product</h2>

        <!-- Notice the method="POST" and action pointing to our route -->
        <form action="/products/store" method="POST" class="space-y-4">
            <!-- CSRF Token: Laravel requires this for security to prevent hacking -->
            @csrf 

            <div>
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FF7900] focus:border-[#FF7900]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                    <option value="Burgers">Burgers</option>
                    <option value="Sides">Sides</option>
                    <option value="Wraps">Wraps</option>
                    <option value="Beverages">Beverages</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                    <input type="number" step="0.01" name="price" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="/" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-[#FF7900] text-white rounded-lg hover:bg-orange-600 font-medium">Save Product</button>
            </div>
        </form>
    </div>

</body>
</html>