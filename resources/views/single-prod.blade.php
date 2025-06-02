<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN (Optional) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto py-10 px-4">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row">
            
            <!-- Product Image -->
            <div class="md:w-1/2">
                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->prod_name }}" class="w-full h-auto object-cover">
            </div>

            <!-- Product Details -->
            <div class="md:w-1/2 p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $product->prod_name }}</h1>
                <p class="text-gray-700 text-lg mb-4">{{ $product->meta_description }}</p>
                <p class="text-xl font-semibold text-green-600 mb-4">₹{{ $product->selling_price }}</p>
                
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Add to Cart
                </button>
            </div>

        </div>
    </div>

</body>
</html>
