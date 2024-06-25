<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\ProductAttachment;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:products,sku',
            'symbology' => 'nullable|string',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'unit_id' => 'nullable|exists:units,id',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'alert_qty' => 'required|integer|min:0',
            'tax_method' => 'nullable|string',
            'tax_id' => 'nullable|exists:taxes,id',
            'has_stock' => 'required|boolean',
            'has_expired_date' => 'required|boolean',
            'expired_date' => 'nullable|date',
            'details' => 'nullable|string',
            'is_active' => 'required|boolean',
            'warehouse_id' => 'required|exists:warehouses,id',
            'attachments' => 'nullable|array',
            'attachments.*.uploaded_user_id' => 'required|exists:users,id',
            'attachments.*.url' => 'required|url',
            'attachments.*.state' => 'nullable|string',
            'attachments.*.label' => 'nullable|string',
            'attachments.*.file' => 'nullable|string',
            'attachments.*.content_type' => 'nullable|string',
            'attachments.*.user' => 'nullable|string',
        ], [
            'brand_id.exists' => 'The selected brand does not exist.',
            'category_id.exists' => 'The selected category does not exist.',
            'unit_id.exists' => 'The selected unit does not exist.',
            'tax_id.exists' => 'The selected tax does not exist.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
        ]);

        // Create a new product with the validated data
        $product = Product::create($validatedData);

        // Create a new product quantity entry
        ProductQuantity::create([
            'product_id' => $product->id,
            'warehouse_id' => $validatedData['warehouse_id'],
            'qty' => $validatedData['qty']
        ]);

        // If attachments are provided, create them
        if (isset($validatedData['attachments'])) {
            foreach ($validatedData['attachments'] as $attachment) {
                ProductAttachment::create([
                    'uploaded_user_id' => $attachment['uploaded_user_id'],
                    'attachmentable_id' => $product->id,
                    'attachmentable_type' => Product::class,
                    'url' => $attachment['url'],
                    'state' => $attachment['state'] ?? null,
                    'label' => $attachment['label'] ?? null,
                    'file' => $attachment['file'] ?? null,
                    'content_type' => $attachment['content_type'] ?? null,
                    'user' => $attachment['user'] ?? null,
                ]);
            }
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    public function index()
    {
        $products = Product::where('is_active', true)
        ->orderBy('id', 'DESC')
        ->with([
            'brand', 
            'category', 
            'unit', 
            'tax', 
            'quantities.warehouse',
            'productAttachments'
        ])
        ->get();
    

        return response()->json(['message' => 'Products fetch successfully', 'products' => $products], 201);
    }

    public function show($id)
    {
        try {
            // Fetch the product by its ID, ensuring it is active and loading all necessary relationships
            $product = Product::where('is_active', true)
                ->with([
                    'brand', 
                    'category', 
                    'unit', 
                    'tax', 
                    'quantities.warehouse',
                    'productAttachments'
                ])
                ->findOrFail($id);
    
            // Return the product data with a 200 OK status code
            return response()->json(['message' => 'Product fetched successfully', 'product' => $product], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch product'], 500);
        }
    }
        
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'symbology' => 'nullable|string',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'unit_id' => 'nullable|exists:units,id',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'alert_qty' => 'required|integer|min:0',
            'tax_method' => 'nullable|string',
            'tax_id' => 'nullable|exists:taxes,id',
            'has_stock' => 'required|boolean',
            'has_expired_date' => 'required|boolean',
            'expired_date' => 'nullable|date',
            'details' => 'nullable|string',
            'is_active' => 'required|boolean',
            'warehouse_id' => 'required|exists:warehouses,id',
            'attachments' => 'nullable|array',
            'attachments.*.id' => 'nullable|integer', // ID of existing attachment
            'attachments.*.uploaded_user_id' => 'required|exists:users,id',
            'attachments.*.url' => 'required|url',
            'attachments.*.state' => 'nullable|string',
            'attachments.*.label' => 'nullable|string',
            'attachments.*.file' => 'nullable|string',
            'attachments.*.content_type' => 'nullable|string',
            'attachments.*.user' => 'nullable|string',
        ], [
            'brand_id.exists' => 'The selected brand does not exist.',
            'category_id.exists' => 'The selected category does not exist.',
            'unit_id.exists' => 'The selected unit does not exist.',
            'tax_id.exists' => 'The selected tax does not exist.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
        ]);
    
        // Find the product by its ID
        $product = Product::findOrFail($id);
    
        // Update the product with the validated data
        $product->update($validatedData);
    
        // Update or create product quantity entry
        ProductQuantity::updateOrCreate(
            ['product_id' => $product->id, 'warehouse_id' => $validatedData['warehouse_id']],
            ['qty' => $validatedData['qty']]
        );
    
        // Process attachments
        if (isset($validatedData['attachments'])) {
            foreach ($validatedData['attachments'] as $attachmentData) {
                if (isset($attachmentData['id'])) {
                    // Update existing attachment
                    $existingAttachment = ProductAttachment::findOrFail($attachmentData['id']);
                    $existingAttachment->update([
                        'uploaded_user_id' => $attachmentData['uploaded_user_id'],
                        'url' => $attachmentData['url'],
                        'state' => $attachmentData['state'] ?? null,
                        'label' => $attachmentData['label'] ?? null,
                        'file' => $attachmentData['file'] ?? null,
                        'content_type' => $attachmentData['content_type'] ?? null,
                        'user' => $attachmentData['user'] ?? null,
                    ]);
                } else {
                    // Create new attachment
                    $newAttachment = new ProductAttachment([
                        'uploaded_user_id' => $attachmentData['uploaded_user_id'],
                        'url' => $attachmentData['url'],
                        'state' => $attachmentData['state'] ?? null,
                        'label' => $attachmentData['label'] ?? null,
                        'file' => $attachmentData['file'] ?? null,
                        'content_type' => $attachmentData['content_type'] ?? null,
                        'user' => $attachmentData['user'] ?? null,
                    ]);
                    $product->productAttachments()->save($newAttachment);
                }
            }
        }
    
        // Return a response indicating success
        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }
    
    
    

    public function destroy($id)
{
    try {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Product not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete product'], 500);
    }
}

}
