@extends('layouts.app')
@section('content')
<div class="p-8">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h1 class="text-2xl font-medium">Products</h1>
      <p class="text-sm text-gray-500 mt-1">All products in your catalogue</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Add product</a>
  </div>

  <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
    <table class="w-full">
      <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
          <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Image</th>
          <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Name</th>
          <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Restaurant</th>
          <!-- <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Vendor</th> -->
          <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Category</th>
          <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Price</th>
          <th class="text-left px-4 py-3 text-xs uppercase tracking-wide text-gray-400 font-medium">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
          <td class="px-4 py-3">
            <img src="{{ asset('storage/'.$product->image) }}" class="w-11 h-11 object-cover rounded-lg border border-gray-100">
          </td>
          <td class="px-4 py-3 font-medium text-sm">{{ $product->name }}</td>
          <td class="px-4 py-3 text-sm text-gray-500">{{ $product->restaurant->name ?? '—' }}</td>
          <!-- <td class="px-4 py-3 text-sm text-gray-500">{{ $product->vendor->name ?? '—' }}</td> -->
          <td class="px-4 py-3">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              {{ $product->category->name ?? '—' }}
            </span>
          </td>
          <td class="px-4 py-3 text-sm font-medium">£{{ $product->price }}</td>
          <td class="px-4 py-3">
            <a href="{{ route('admin.products.edit',$product->id) }}" class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg text-xs font-medium mr-1">Edit</a>
            <form method="POST" action="{{ route('admin.products.destroy',$product->id) }}" class="inline">
              @csrf @method('DELETE')
              <button class="inline-flex items-center gap-1 bg-red-100 text-red-800 px-3 py-1 rounded-lg text-xs font-medium" onclick="return confirm('Delete this product?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection