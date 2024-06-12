<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function main()
    {
        return view('report.main');
    }

    public function save_report(Request $request)
    {
        dd($request->all());
        // Validate the request data
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'quantitystock' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'product_image' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'g-recaptcha-response' => 'required|captcha',
            // Add other validation rules as needed
        ]);

        if ($request->hasFile('product_image')) {
        // Get the file from the request
        $image = $request->file('product_image');
        // Generate a unique name for the file
        $imageName = time() . '_' . $image->getClientOriginalName();
        // Store the file in the storage/app/public directory
        $image->storeAs('public/products_image', $imageName);
    } else {
        // Handle if no file is uploaded
        return redirect()->back()->with('error', 'No image uploaded.');
    }

        $prodcts = new Products;
        // Set the attributes with the validated data
        $prodcts->product_name = $request->input('product_name');
        $prodcts->price = $request->input('price');
        $prodcts->quantitystock = $request->input('quantitystock');
        $prodcts->category = $request->input('category');
        $prodcts->discount = $request->input('discount');
        $prodcts->product_image = $imageName;
        // Set other attributes as needed
        // Save the enrollee to the database
        $prodcts->save();
        // Redirect to the dashboard
        return redirect('/add_products')->with('success', 'Product Added Successfully!');
    }

}
